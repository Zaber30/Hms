<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\AppointmentSchedule;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Show dashboard with doctors and available doctors
     */
    public function dashboard()
    {
        // Get all specializations from database
        $specializations = Doctor::distinct()
            ->pluck('qualification')
            ->filter()
            ->values();

        // Get all locations from database
        $locations = Doctor::distinct()
            ->pluck('clinic_address')
            ->filter()
            ->values();

        // Get recommended doctors (all approved doctors)
        $doctors = Doctor::with('user')
            ->whereHas('user', function ($q) {
                $q->where('status', 'approved');
            })
            ->limit(6)
            ->get()
            ->map(function ($doctor) {
                return $this->formatDoctorData($doctor);
            });

        // Get available doctors (doctors with schedules)
        $availableDoctors = Doctor::with(['user', 'schedules'])
            ->whereHas('user', function ($q) {
                $q->where('status', 'approved');
            })
            ->whereHas('schedules', function ($q) {
                $q->whereDate('schedule_date', '>=', now()->toDateString());
            })
            ->get()
            ->map(function ($doctor) {
                return $this->formatDoctorData($doctor);
            })
            ->take(6);

        return view('dashboard', [
            'doctors' => $doctors,
            'availableDoctors' => $availableDoctors,
            'specializations' => $specializations,
            'locations' => $locations,
        ]);
    }

    /**
     * Format doctor data for frontend
     */
    private function formatDoctorData($doctor)
    {
        // Generate proper storage URL for profile image
        $profileImage = $doctor->profile_image
            ? asset('storage/' . $doctor->profile_image)
            : 'https://randomuser.me/api/portraits/men/32.jpg';

        return [
            'id' => $doctor->id,
            'name' => $doctor->user->name ?? 'Dr. Unknown',
            'spec' => $doctor->qualification ?? 'General',
            'status' => 'Available',
            'rating' => 4.8,
            'reviews' => 245,
            'price' => $doctor->consultation_fee ?? 50,
            'experience' => ($doctor->experience_years ?? 10) . ' years',
            'img' => $profileImage,
            'location' => $doctor->clinic_address ?? 'Not specified',
        ];
    }

    /**
     * Search doctors by specialization, location, and filters
     */
    public function search(Request $request)
    {
        $query = Doctor::with('user')
            ->whereHas('user', function ($q) {
                $q->where('status', 'approved');
            });

        // Search by query (doctor name)
        if ($request->filled('query')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('query') . '%');
            });
        }

        // Filter by specialization
        if ($request->filled('specialization')) {
            $query->where('qualification', 'like', '%' . $request->input('specialization') . '%');
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->where('clinic_address', 'like', '%' . $request->input('location') . '%');
        }

        // Filter by availability
        if ($request->filled('availability')) {
            // This can be extended based on your schedule logic
            $query->whereHas('schedules', function ($q) use ($request) {
                $q->where('date', '>=', now());
            });
        }

        // Filter by consultation type
        if ($request->filled('type')) {
            // Add logic based on your consultation type field
        }

        // Filter by max price
        if ($request->filled('maxPrice')) {
            $query->where('consultation_fee', '<=', $request->input('maxPrice'));
        }

        $doctorsQuery = $query->paginate(12);

        $doctors = collect($doctorsQuery->items())->map(function ($doctor) {
            return $this->formatDoctorData($doctor);
        })->values();

        return response()->json([
            'success' => true,
            'doctors' => $doctors,
            'total' => $doctorsQuery->total(),
            'per_page' => $doctorsQuery->perPage(),
            'current_page' => $doctorsQuery->currentPage(),
            'last_page' => $doctorsQuery->lastPage(),
        ]);
    }

    /**
     * Get all doctors with basic info
     */
    public function index()
    {
        $doctors = Doctor::with('user')
            ->whereHas('user', function ($q) {
                $q->where('status', 'approved');
            })
            ->limit(4)
            ->get()
            ->map(function ($doctor) {
                return $this->formatDoctorData($doctor);
            });

        return response()->json([
            'success' => true,
            'doctors' => $doctors,
        ]);
    }

    /**
     * Get autocomplete suggestions for doctor names
     */
    public function suggestDoctorNames(Request $request)
    {
        $query = $request->input('q', '');

        if (strlen($query) < 2) {
            return response()->json([
                'success' => true,
                'suggestions' => [],
            ]);
        }

        try {
            // Get all approved doctors
            $doctors = Doctor::with('user')
                ->whereHas('user', function ($q) use ($query) {
                    $q->where('status', 'approved')
                        ->where('name', 'like', '%' . $query . '%');
                })
                ->select('id', 'user_id', 'qualification', 'consultation_fee')
                ->limit(10)
                ->get();

            $suggestions = $doctors->map(function ($doctor) {
                return [
                    'id' => $doctor->id,
                    'name' => $doctor->user->name ?? 'Dr. Unknown',
                    'spec' => $doctor->qualification ?? 'General',
                ];
            })->values();

            return response()->json([
                'success' => true,
                'suggestions' => $suggestions,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'suggestions' => [],
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get autocomplete suggestions for locations
     */
    public function suggestLocations(Request $request)
    {
        $query = $request->input('q', '');

        if (strlen($query) < 2) {
            return response()->json([
                'success' => true,
                'suggestions' => [],
            ]);
        }

        try {
            // Get distinct locations matching the query
            $locations = Doctor::where('clinic_address', 'like', '%' . $query . '%')
                ->whereHas('user', function ($q) {
                    $q->where('status', 'approved');
                })
                ->distinct()
                ->select('clinic_address')
                ->limit(10)
                ->get()
                ->pluck('clinic_address')
                ->filter()
                ->values();

            return response()->json([
                'success' => true,
                'suggestions' => $locations,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'suggestions' => [],
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get autocomplete suggestions for specializations
     */
    public function suggestSpecializations(Request $request)
    {
        $query = $request->input('q', '');

        if (strlen($query) < 2) {
            return response()->json([
                'success' => true,
                'suggestions' => [],
            ]);
        }

        try {
            // Get distinct specializations matching the query
            $specializations = Doctor::where('qualification', 'like', '%' . $query . '%')
                ->whereHas('user', function ($q) {
                    $q->where('status', 'approved');
                })
                ->distinct()
                ->select('qualification')
                ->limit(10)
                ->get()
                ->pluck('qualification')
                ->filter()
                ->values();

            return response()->json([
                'success' => true,
                'suggestions' => $specializations,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'suggestions' => [],
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
