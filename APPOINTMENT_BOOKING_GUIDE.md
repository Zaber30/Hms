# Appointment Booking System - Complete Implementation Guide

## 📋 Overview

This is a complete Hospital Management System (HMS) appointment booking system with beautiful UI, proper authentication, and database management for Bangladeshi medical colleges.

## 🏥 Features

- ✅ **Patient Authentication** - Secure login/registration for patients
- ✅ **Doctor Profiles** - Browse 100+ realistic Bangladeshi doctors from 7 division medical colleges
- ✅ **Appointment Scheduling** - Doctors can create available time slots
- ✅ **Beautiful Booking Interface** - Modern, responsive Vue.js UI
- ✅ **Appointment Management** - View, confirm, and cancel appointments
- ✅ **Real-time Availability** - Live slot availability tracking
- ✅ **Doctor Approval System** - Doctors review and approve bookings
- ✅ **Medical Notes** - Patients can share symptoms and medical history

## 🗂️ Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   └── Patient/
│   │       └── BookingController.php          # Main booking logic
│   └── Requests/
│       └── StoreAppointmentBookingRequest.php # Form validation
├── Models/
│   ├── User.php                              # Patient/Doctor user model
│   ├── Doctor.php                            # Doctor details
│   ├── AppointmentSchedule.php              # Doctor's available time slots
│   └── AppointmentBooking.php               # Patient bookings
│
resources/
├── js/
│   ├── Layouts/
│   │   └── AppLayout.vue                     # Main layout component
│   └── Pages/
│       └── Patient/
│           └── Bookings/
│               ├── AvailableSchedules.vue    # Browse & filter schedules
│               ├── BookSchedule.vue          # Booking confirmation form
│               └── MyBookings.vue            # View patient's appointments
│
database/
├── migrations/
│   ├── 2026_04_18_000002_create_appointment_schedules_table.php
│   └── 2026_04_18_000003_create_appointment_bookings_table.php
└── seeders/
    └── BangladeshiDoctorSeeder.php           # 100 realistic Bangladeshi doctors

routes/
└── web.php                                   # Patient booking routes
```

## 🚀 Getting Started

### 1. **Install Dependencies**
```bash
composer install
npm install
```

### 2. **Environment Setup**
```bash
cp .env.example .env
php artisan key:generate
```

### 3. **Database Setup**
```bash
php artisan migrate --force
php artisan db:seed --class=BangladeshiDoctorSeeder
```

### 4. **Build Frontend**
```bash
npm run build  # Production
# or
npm run dev    # Development (with hot reload)
```

### 5. **Start Application**
```bash
php artisan serve
```

Visit: `http://localhost:8000`

## 📱 User Flows

### Patient Registration & Login
1. Go to `/register`
2. Select **Patient** role
3. Create account with email and password
4. Login at `/login`

### Book an Appointment
1. After login, click **"Book Appointment"**
2. View all available doctor schedules
3. Filter by specialty, date, or location
4. Click **"Book Appointment"** on desired schedule
5. Add medical notes (optional)
6. Confirm booking
7. Wait for doctor approval

### Manage Appointments
1. Go to **"My Appointments"**
2. View all bookings with status:
   - 🟡 **Pending** - Awaiting doctor approval
   - 🟢 **Approved** - Doctor confirmed
   - 🔵 **Completed** - Appointment finished
   - 🔴 **Cancelled** - Appointment cancelled
3. Cancel bookings (if not approved)
4. View doctor notes and consultation details

## 🔧 API Routes

### Patient Booking Routes
All routes require `auth` middleware and `role:patient`

```
GET    /patient/available-schedules      # View all schedules
       Parameters: specialty, date, doctor_id
       
GET    /patient/schedules/{schedule}/book   # Show booking form

POST   /patient/schedules/{schedule}/book   # Submit booking
       Data: patient_notes (optional)
       
GET    /patient/my-bookings              # View patient's bookings
       Parameters: status (pending|approved|completed|cancelled)
       
POST   /patient/bookings/{booking}/cancel   # Cancel booking
```

## 📊 Database Schema

### users
```sql
id (PK)
name
email
password
role (doctor|patient|admin)
status (approved|pending|rejected)
created_at
updated_at
```

### doctors
```sql
id (PK)
user_id (FK -> users)
bmdc_registration_number
phone
gender
qualification (MBBS|MD|FCPS)
specialist
experience_years
clinic_address
consultation_fee
profile_image
created_at
updated_at
```

### appointment_schedules
```sql
id (PK)
doctor_id (FK -> users)  # Doctor's user ID
schedule_date
start_time
end_time
max_patients_per_day (default: 10)
current_bookings (default: 0)
consultation_fee
status (available|fully_booked|cancelled)
notes (nullable)
created_at
updated_at
```

### appointment_bookings
```sql
id (PK)
schedule_id (FK -> appointment_schedules)
patient_id (FK -> users)
status (pending|approved|rejected|cancelled|completed)
patient_notes
doctor_notes
approved_at (nullable)
rejected_at (nullable)
completed_at (nullable)
created_at
updated_at
```

## 🛠️ Key Classes & Methods

### BookingController

```php
// View available schedules
public function availableSchedules(Request $request): InertiaResponse

// Show booking form for specific schedule
public function show(AppointmentSchedule $schedule): InertiaResponse

// Submit appointment booking
public function book(StoreAppointmentBookingRequest $request, 
                     AppointmentSchedule $schedule): RedirectResponse

// View patient's bookings
public function myBookings(Request $request): InertiaResponse

// Cancel appointment booking
public function cancel(AppointmentBooking $booking): RedirectResponse
```

### Models

```php
// AppointmentSchedule
$schedule->doctor();          // Get Doctor model
$schedule->doctorUser();      // Get User model (doctor)
$schedule->bookings();        // Get all bookings
$schedule->approvedBookings(); // Get approved bookings
$schedule->pendingBookings(); // Get pending bookings
$schedule->isAvailable();     // Check if slots available

// AppointmentBooking
$booking->schedule();         // Get AppointmentSchedule
$booking->patient();          // Get User (patient)
$booking->doctor();           // Get doctor info

// Doctor
$doctor->user();              // Get associated User
$doctor->schedules();         // Get doctor's schedules
```

## 🎨 Vue Components

### AvailableSchedules.vue
- Display all available appointment schedules
- Filter by specialty, date
- Pagination support
- Schedule cards with doctor info, time, location, fee

### BookSchedule.vue
- Show detailed doctor and appointment information
- Patient notes input
- Confirmation checkbox
- Submit booking form

### MyBookings.vue
- List all patient bookings
- Status-based filtering
- Cancel appointment functionality
- View doctor notes and medical history
- Statistics dashboard

### AppLayout.vue
- Navigation bar with logo
- User menu with logout
- Footer with links
- Responsive mobile design

## 📝 Validation Rules

### StoreAppointmentBookingRequest
```php
patient_notes: nullable|string|max:500
```

## 🔐 Authentication & Authorization

- All booking routes require `auth` middleware
- Patient role check: `role:patient`
- Doctor role check: `role:doctor`
- Admin role check: `role:admin`

## 🌐 Bangladeshi Doctor Data

The system is pre-seeded with **100 realistic Bangladeshi doctors** from all 7 divisions:

1. **Dhaka Division** - Dhaka Medical College, Apollo Hospitals, Evercare Hospital, BSMMU
2. **Chittagong Division** - Chittagong Medical College, CMU Hospital
3. **Khulna Division** - Khulna Medical College
4. **Rajshahi Division** - Rajshahi Medical College
5. **Barishal Division** - Sher-e-Bangla Medical College
6. **Sylhet Division** - Sylhet Medical College
7. **Rangpur Division** - Rangpur Medical College

## 🎓 Doctor Qualifications
- MBBS (Bachelor of Medicine)
- MD (Doctor of Medicine)
- FCPS (Fellow of College of Physicians & Surgeons)
- MRCP (Member of Royal College of Physicians)
- FRCP (Fellow of Royal College of Physicians)
- BDS (Bachelor of Dental Surgery)
- DDS (Doctor of Dental Surgery)

## 💼 Consultation Fees
Fees range from ৳300 to ৳1500 based on doctor experience and specialization.

## 🧪 Testing the System

### 1. Create Test Patient
```bash
php artisan tinker

// Create a patient user
$user = \App\Models\User::create([
    'name' => 'Test Patient',
    'email' => 'patient@example.com',
    'password' => Hash::make('password'),
    'role' => 'patient',
    'status' => 'approved',
]);
```

### 2. Get Doctor for Scheduling
```bash
php artisan tinker

// Get a doctor
$doctor = \App\Models\Doctor::with('user')->first();
```

### 3. Create Appointment Schedule
```bash
// In doctor panel or via tinker
$schedule = \App\Models\AppointmentSchedule::create([
    'doctor_id' => $doctor->user_id,
    'schedule_date' => now()->addDay(),
    'start_time' => '10:00:00',
    'end_time' => '11:00:00',
    'max_patients_per_day' => 10,
    'consultation_fee' => $doctor->consultation_fee,
    'status' => 'available',
]);
```

### 4. Book Appointment (As Patient)
```bash
// Navigate to /patient/available-schedules in browser
// Select a schedule and fill the form
// Submit booking
```

## 🐛 Troubleshooting

### "No schedules available"
- Ensure doctors have created schedules
- Check schedule dates are in future
- Verify doctor status is 'approved'

### "You already have a booking for this schedule"
- Unique constraint on (schedule_id, patient_id)
- Cancel existing booking first

### Frontend not updating
```bash
npm run build  # Or npm run dev
```

### Database errors
```bash
php artisan migrate:fresh --seed  # WARNING: Clears all data!
```

## 📈 Future Enhancements

- Real-time appointment notifications
- Video consultation integration
- Prescription management
- Appointment reminders (SMS/Email)
- Rating and reviews system
- Insurance integration
- Online payment gateway
- Appointment history export
- Doctor availability calendar

## 📞 Support

For issues or questions:
- Email: support@hms.com
- Phone: +880 1700-000-000
- Address: Dhaka, Bangladesh

---

**Version**: 1.0.0  
**Last Updated**: April 26, 2026  
**License**: MIT
