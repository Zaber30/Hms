<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Doctor;
use App\Models\AppointmentSchedule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Laravolt\Avatar\Facade as Avatar;
use Carbon\Carbon;

class BangladeshiDoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        AppointmentSchedule::truncate();
        Doctor::truncate();
        User::where('role', 'doctor')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Comprehensive doctor data with specialist, degree, description, and price
        $doctors = [
            // CARDIOLOGISTS
            ['name' => 'Dr. Mohammad Rafique Ahmed', 'specialist' => 'Cardiologist', 'qualification' => 'MBBS, MD (Cardiology)', 'experience' => 18, 'fee' => 1200, 'bio' => 'Senior Cardiologist with 18 years of experience in managing complex heart conditions, arrhythmias, and coronary interventions. Specialist in echocardiography and stress testing.'],
            ['name' => 'Dr. Farhana Banu Khan', 'specialist' => 'Cardiologist', 'qualification' => 'MBBS, FCPS (Cardiology)', 'experience' => 14, 'fee' => 1000, 'bio' => 'Expert in preventive cardiology and cardiac rehabilitation. Focuses on lifestyle modification and disease prevention in high-risk patients.'],

            // ENT SPECIALISTS
            ['name' => 'Dr. Kadir Hossain', 'specialist' => 'ENT Specialist', 'qualification' => 'MBBS, DLO, FCPS (ENT)', 'experience' => 16, 'fee' => 800, 'bio' => 'Experienced ENT surgeon with expertise in endoscopic sinus surgery, hearing loss management, and laryngeal disorders. Performs microlaryngeal surgery.'],
            ['name' => 'Dr. Nusrat Zaman', 'specialist' => 'ENT Specialist', 'qualification' => 'MBBS, FCPS (ENT)', 'experience' => 12, 'fee' => 700, 'bio' => 'Specialist in tonsillitis, sinusitis, and hearing problems. Provides comprehensive audiological assessments and hearing aid consultations.'],

            // GENERAL PHYSICIANS
            ['name' => 'Dr. Abdullah Al Mamun', 'specialist' => 'General Physician', 'qualification' => 'MBBS, MD (Internal Medicine)', 'experience' => 20, 'fee' => 600, 'bio' => 'Senior General Physician with two decades of experience in diagnosis and management of acute and chronic diseases. Specialist in diabetes and hypertension management.'],
            ['name' => 'Dr. Sheema Rahman', 'specialist' => 'General Physician', 'qualification' => 'MBBS, FCPS (Medicine)', 'experience' => 15, 'fee' => 550, 'bio' => 'Compassionate physician specializing in infectious diseases and tropical medicine. Expert in managing tuberculosis and respiratory infections.'],
            ['name' => 'Dr. Amin Uddin Ahmed', 'specialist' => 'General Physician', 'qualification' => 'MBBS', 'experience' => 8, 'fee' => 400, 'bio' => 'General practitioner providing comprehensive primary healthcare and preventive medicine. Manages acute illnesses and chronic disease monitoring.'],

            // DENTISTS
            ['name' => 'Dr. Taskeen Akhter', 'specialist' => 'Dentist', 'qualification' => 'BDS, FCPS (Prosthodontics)', 'experience' => 14, 'fee' => 600, 'bio' => 'Expert prosthodontist with advanced training in dental implants, crowns, and bridges. Provides complete smile makeover services.'],
            ['name' => 'Dr. Shiraz Ahmed Khan', 'specialist' => 'Dentist', 'qualification' => 'BDS, MSc (Orthodontics)', 'experience' => 11, 'fee' => 700, 'bio' => 'Specialist orthodontist providing braces, aligners, and corrective dental procedures. Uses modern digital imaging for treatment planning.'],

            // PULMONOLOGISTS
            ['name' => 'Dr. Rahul Kumar Das', 'specialist' => 'Pulmonologist', 'qualification' => 'MBBS, MD (Respiratory Medicine)', 'experience' => 17, 'fee' => 900, 'bio' => 'Specialist in respiratory diseases including asthma, COPD, and pulmonary tuberculosis. Performs bronchoscopy and pulmonary function tests.'],
            ['name' => 'Dr. Salma Begum', 'specialist' => 'Pulmonologist', 'qualification' => 'MBBS, FCPS (Chest Diseases)', 'experience' => 13, 'fee' => 850, 'bio' => 'Expert in managing chronic lung diseases and acute respiratory infections. Specialist in sleep apnea diagnosis and CPAP therapy.'],

            // PEDIATRICIANS
            ['name' => 'Dr. Tasnim Iqbal', 'specialist' => 'Pediatrician', 'qualification' => 'MBBS, MD (Pediatrics)', 'experience' => 16, 'fee' => 700, 'bio' => 'Experienced pediatrician providing comprehensive child healthcare from newborn to adolescent. Expert in childhood immunization and developmental delays.'],
            ['name' => 'Dr. Riasat Hossain', 'specialist' => 'Pediatrician', 'qualification' => 'MBBS, FCPS (Pediatrics)', 'experience' => 12, 'fee' => 600, 'bio' => 'Neonatologist and pediatrician with expertise in premature infant care and neonatal resuscitation. Provides lactation counseling and nutrition guidance.'],

            // OPHTHALMOLOGISTS
            ['name' => 'Dr. Mahbubur Rahman', 'specialist' => 'Ophthalmologist', 'qualification' => 'MBBS, DO, FCPS (Ophthalmology)', 'experience' => 19, 'fee' => 900, 'bio' => 'Senior eye specialist with expertise in cataract surgery, glaucoma management, and refractive corrections. Performs laser-assisted procedures.'],
            ['name' => 'Dr. Shusmita Roy', 'specialist' => 'Ophthalmologist', 'qualification' => 'MBBS, MS (Ophthalmology)', 'experience' => 10, 'fee' => 750, 'bio' => 'Ophthalmologist specializing in corneal diseases, contact lens fitting, and dry eye management. Provides comprehensive eye examinations.'],

            // GYNECOLOGISTS
            ['name' => 'Dr. Nasrin Jahan', 'specialist' => 'Gynecologist', 'qualification' => 'MBBS, MD (Obstetrics & Gynecology)', 'experience' => 18, 'fee' => 1000, 'bio' => 'Senior obstetrician-gynecologist with experience in high-risk pregnancies, cesarean sections, and gynecological surgeries. Specialist in infertility treatment.'],
            ['name' => 'Dr. Fatema Sultana', 'specialist' => 'Gynecologist', 'qualification' => 'MBBS, FCPS (Gynecology)', 'experience' => 14, 'fee' => 850, 'bio' => 'Gynecologist providing comprehensive women\'s health services including contraception counseling and menopausal symptom management.'],

            // DERMATOLOGISTS
            ['name' => 'Dr. Nasiruddin Ahmed', 'specialist' => 'Dermatologist', 'qualification' => 'MBBS, MD (Dermatology)', 'experience' => 15, 'fee' => 750, 'bio' => 'Dermatologist with expertise in skin diseases, acne treatment, and cosmetic procedures. Offers chemical peeling and laser treatments.'],
            ['name' => 'Dr. Rubaiya Khatun', 'specialist' => 'Dermatologist', 'qualification' => 'MBBS, FCPS (Dermatology)', 'experience' => 11, 'fee' => 650, 'bio' => 'Specialist in eczema, psoriasis, and fungal infections. Provides patch testing for allergic contact dermatitis diagnosis.'],

            // NEUROLOGISTS
            ['name' => 'Dr. Ashfaque Ahmed', 'specialist' => 'Neurologist', 'qualification' => 'MBBS, MD (Neurology)', 'experience' => 16, 'fee' => 1100, 'bio' => 'Neurologist with expertise in stroke management, epilepsy control, and Parkinsonian disorders. Performs EEG and EMG studies.'],
            ['name' => 'Dr. Afroza Khan', 'specialist' => 'Neurologist', 'qualification' => 'MBBS, FCPS (Neurology)', 'experience' => 12, 'fee' => 950, 'bio' => 'Specialist in headaches, migraines, and peripheral neuropathy. Provides comprehensive neurological assessments and pain management.'],

            // ORTHOPEDIC SURGEONS
            ['name' => 'Dr. Quazi Mohamad Khan', 'specialist' => 'Orthopedic Surgeon', 'qualification' => 'MBBS, MS (Orthopedics)', 'experience' => 17, 'fee' => 1000, 'bio' => 'Senior orthopedic surgeon specializing in joint replacement surgeries, arthroscopic procedures, and sports medicine.'],
            ['name' => 'Dr. Sumaiya Islam', 'specialist' => 'Orthopedic Surgeon', 'qualification' => 'MBBS, FCPS (Orthopedics)', 'experience' => 13, 'fee' => 850, 'bio' => 'Orthopedic specialist in fracture management, spine disorders, and physiotherapy guidance for post-operative rehabilitation.'],

            // PSYCHIATRISTS
            ['name' => 'Dr. Kamrul Hasan', 'specialist' => 'Psychiatrist', 'qualification' => 'MBBS, MD (Psychiatry)', 'experience' => 14, 'fee' => 900, 'bio' => 'Psychiatrist specializing in depression, anxiety disorders, and schizophrenia management. Provides psychotherapy and medication management.'],
            ['name' => 'Dr. Raisa Begum', 'specialist' => 'Psychiatrist', 'qualification' => 'MBBS, FCPS (Psychiatry)', 'experience' => 10, 'fee' => 800, 'bio' => 'Mental health specialist offering counseling for stress management and behavioral disorders. Expert in addiction rehabilitation programs.'],
        ];

        // Seed doctors with schedules
        foreach ($doctors as $index => $doctorData) {
            $email = strtolower(str_replace(' ', '.', $doctorData['name'])) . '@hms-doctor.com';
            $phone = '+8801' . str_pad(rand(1, 999999999), 9, '0', STR_PAD_LEFT);

            // Create User
            $user = User::create([
                'name' => $doctorData['name'],
                'email' => $email,
                'password' => Hash::make('password'),
                'role' => 'doctor',
                'status' => 'approved',
            ]);

            // Generate avatar
            $filename = 'doctor_' . $user->id . '_' . uniqid() . '.png';
            $path = storage_path('app/public/doctor_profiles/' . $filename);

            if (!file_exists(dirname($path))) {
                mkdir(dirname($path), 0755, true);
            }

            Avatar::create($doctorData['name'])->save($path);

            // Create Doctor
            $doctor = Doctor::create([
                'user_id' => $user->id,
                'bmdc_registration_number' => 'BMDC-' . str_pad($index + 1000, 6, '0', STR_PAD_LEFT),
                'phone' => $phone,
                'gender' => $index % 2 === 0 ? 'male' : 'female',
                'specialist' => $doctorData['specialist'],
                'qualification' => $doctorData['qualification'],
                'experience_years' => $doctorData['experience'],
                'bio' => $doctorData['bio'],
                'clinic_address' => ['Dhaka Medical College, Dhaka', 'Square Hospital, Panthapath, Dhaka', 'National Hospital, Gulshan, Dhaka', 'United Hospital, Gulshan, Dhaka'][array_rand(['Dhaka Medical College, Dhaka', 'Square Hospital, Panthapath, Dhaka', 'National Hospital, Gulshan, Dhaka', 'United Hospital, Gulshan, Dhaka'])],
                'consultation_fee' => $doctorData['fee'],
                'profile_image' => 'doctor_profiles/' . $filename,
            ]);

            // Create appointment schedules for next 30 days
            for ($day = 1; $day <= 30; $day++) {
                $scheduleDate = Carbon::now()->addDays($day);

                // Skip Sundays (general weekend in Bangladesh)
                if ($scheduleDate->dayOfWeek === 0) {
                    continue;
                }

                // Morning shift (9 AM - 1 PM)
                AppointmentSchedule::create([
                    'doctor_id' => $user->id,
                    'schedule_date' => $scheduleDate,
                    'start_time' => '09:00',
                    'end_time' => '13:00',
                    'max_patients_per_day' => 10,
                    'current_bookings' => 0,
                    'consultation_fee' => $doctorData['fee'],
                    'status' => 'available',
                    'notes' => 'Morning consultation slot'
                ]);

                // Afternoon shift (3 PM - 7 PM)
                AppointmentSchedule::create([
                    'doctor_id' => $user->id,
                    'schedule_date' => $scheduleDate,
                    'start_time' => '15:00',
                    'end_time' => '19:00',
                    'max_patients_per_day' => 10,
                    'current_bookings' => 0,
                    'consultation_fee' => $doctorData['fee'],
                    'status' => 'available',
                    'notes' => 'Afternoon consultation slot'
                ]);
            }

            $this->command->info("Created: {$doctorData['name']} ({$doctorData['specialist']}) with 30-day schedules");
        }

        $this->command->info('✓ Successfully seeded ' . count($doctors) . ' authentic Bangladeshi doctors with complete schedule data!');
    }
}
