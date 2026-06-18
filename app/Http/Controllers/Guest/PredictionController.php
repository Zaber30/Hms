<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PredictionController extends Controller
{
    public function predict(Request $request)
    {
        // Validate input
        $validated = $request->validate(
            [
                'symptoms' => 'required|array|min:1',
                'symptoms.*' => 'required|string',
                'age' => 'required|integer|min:1|max:150',
                'gender' => 'required|string|in:Male,Female,Other',
            ],
            [
                'symptoms.required' => 'Please select at least one symptom.',
                'symptoms.min' => 'Please select at least one symptom.',
                'age.required' => 'Age is required.',
                'age.integer' => 'Age must be a valid number.',
                'age.min' => 'Age must be at least 1.',
                'age.max' => 'Age cannot exceed 150.',
                'gender.required' => 'Please select a gender.',
                'gender.in' => 'Invalid gender selection.',
            ]
        );

        try {
            // Call external API to get prediction
            $response = Http::timeout(30)->post('http://127.0.0.1:5000/predict', [
                'symptoms' => $validated['symptoms'],
                'age' => (int) $validated['age'],
                'gender' => $validated['gender'],
            ]);

            if (! $response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to get prediction from the AI service. Please try again.',
                ], 500);
            }

            $data = $response->json();

            // Transform recommendations to predictions format
            $predictions = [];
            if (isset($data['recommendations']) && is_array($data['recommendations'])) {
                foreach ($data['recommendations'] as $rec) {
                    $predictions[] = [
                        'disease' => $rec['specialist'] ?? 'Unknown',
                        'specialist' => $rec['specialist'] ?? 'General Physician',
                        'disease_confidence' => $rec['model_confidence'] ?? 0,
                        'urgency' => $rec['urgency'] ?? 'LOW',
                        'shap_symptoms' => $rec['shap_symptoms'] ?? [],
                    ];
                }
            }

            $specialist = $predictions[0]['specialist'] ?? $data['top_specialist'] ?? 'General Physician';

            // Fetch matching specialists from database
            $matchingSpecialists = $this->fetchMatchingSpecialists($specialist);

            return response()->json([
                'success' => true,
                'patient' => $data['patient'] ?? null,
                'matched' => $data['matched'] ?? [],
                'model_used' => $data['model_used'] ?? 'AI Model',
                'predictions' => $predictions,
                'top_specialist' => $specialist,
                'matching_specialists' => $matchingSpecialists,
                'message' => 'Prediction successful',
            ]);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to connect to prediction service. Please ensure the AI service is running.',
            ], 503);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while getting your prediction. Please try again.',
            ], 500);
        }
    }

    private function fetchMatchingSpecialists(string $specialtyName): array
    {
        // Query doctors by specialist field
        $doctors = Doctor::with('user')
            ->whereHas('user', function ($query) {
                $query->where('role', 'doctor')
                    ->where('status', 'approved');
            })
            ->where('specialist', $specialtyName)
            ->orderBy('experience_years', 'desc')
            ->limit(5)
            ->get();

        // If no exact match, get top experienced doctors
        if ($doctors->isEmpty()) {
            $doctors = Doctor::with('user')
                ->whereHas('user', function ($query) {
                    $query->where('role', 'doctor')
                        ->where('status', 'approved');
                })
                ->orderBy('experience_years', 'desc')
                ->limit(5)
                ->get();
        }

        return $doctors->map(function ($doctor) {
            return [
                'id' => $doctor->id,
                'user_id' => $doctor->user_id,
                'name' => $doctor->user->name,
                'specialist' => $doctor->specialist,
                'qualification' => $doctor->qualification,
                'experience_years' => $doctor->experience_years,
                'consultation_fee' => $doctor->consultation_fee,
                'bio' => $doctor->bio,
                'phone' => $doctor->phone,
                'clinic_address' => $doctor->clinic_address,
                'profile_image' => $doctor->profile_image,
            ];
        })->toArray();
    }
}
