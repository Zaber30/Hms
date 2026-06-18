@extends('layouts.doctor')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Information Form</title>
   @vite(['resources/css/app.css','resources/js/app.js'])
  {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-100 via-indigo-50 to-white flex items-center justify-center p-6">

  <div class="max-w-5xl w-full bg-white rounded-3xl shadow-2xl overflow-hidden border border-indigo-100">
    <div class="md:grid md:grid-cols-2">
      
      <!-- Left side: Illustration or background -->
      <div class="relative bg-gradient-to-br from-blue-700 via-indigo-600 to-blue-500 text-white flex flex-col justify-center items-center p-10">
        <h2 class="text-3xl font-bold mb-4 text-center">Doctor Profile</h2>
        <p class="text-lg text-center text-blue-100 mb-6">Provide your professional and clinic details below to register as a verified doctor.</p>
        <img src="https://cdn-icons-png.flaticon.com/512/3774/3774299.png" alt="Doctor Illustration" class="w-56 drop-shadow-lg opacity-90">
      </div>

      <!-- Right side: Form -->
      <div class="p-10 md:p-12">
        <h3 class="text-2xl font-bold text-gray-800 mb-8 text-center">Doctor Information</h3>

        <form class="space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-gray-700 font-semibold mb-2">Phone</label>
              <input type="text" name="phone" placeholder="+880..." class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 p-2.5">
            </div>

            <div>
              <label class="block text-gray-700 font-semibold mb-2">Gender</label>
              <select name="gender" class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 p-2.5">
                <option value="">Select Gender</option>
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
              </select>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-gray-700 font-semibold mb-2">Qualification</label>
              <input type="text" name="qualification" placeholder="MBBS, FCPS..." class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 p-2.5">
            </div>

            <div>
              <label class="block text-gray-700 font-semibold mb-2">Experience (Years)</label>
              <input type="number" name="experience_years" placeholder="5" class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 p-2.5">
            </div>
          </div>

          <div>
            <label class="block text-gray-700 font-semibold mb-2">Clinic Address</label>
            <input type="text" name="clinic_address" placeholder="Road 12, Dhanmondi, Dhaka" class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 p-2.5">
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-gray-700 font-semibold mb-2">Consultation Fee (৳)</label>
              <input type="number" name="consultation_fee" placeholder="500" class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 p-2.5">
            </div>

            <div>
              <label class="block text-gray-700 font-semibold mb-2">Profile Image</label>
              <input type="file" name="profile_image" class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 p-2.5">
            </div>
          </div>

          <div>
            <label class="block text-gray-700 font-semibold mb-2">Short Bio</label>
            <textarea name="bio" rows="4" placeholder="Write a short introduction about yourself..." class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 p-2.5"></textarea>
          </div>

          <div class="pt-4">
            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition font-semibold shadow-md">
              Submit Application
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

</body>
</html>
@endsection
