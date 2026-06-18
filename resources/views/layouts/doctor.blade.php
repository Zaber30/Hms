<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="min-h-screen bg-gray-100">
        <div class="flex">
            @include('partials.doctor_sidebar')

            <div class="flex-1">
                @include('partials.doctor_navigation')

                <main class="p-6">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>

</html>
