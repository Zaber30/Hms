<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: true }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-white font-sans h-screen">

<!-- Top Navigation (Fixed) -->
@include('partials.admin_navigation')

<div class="flex h-full pt-16">

    
    <!-- Sidebar -->
    @include('partials.admin_sidebar')
    

    <!-- Main content -->
    <div :class="sidebarOpen ? 'md:pl-64' : 'md:pl-16'" class="flex-1 flex flex-col h-full transition-all duration-300">

        <!-- Page content -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8 overflow-auto bg-white">
            @yield('content')
        </main>

    </div>
</div>
     <div>
         
     </div>
</body>
</html>
