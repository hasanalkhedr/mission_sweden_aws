<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Mission Order App') }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 h-screen p-6">
            <h1 class="text-white text-2xl font-bold mb-6">Mission Order App</h1>
            <ul class="text-gray-300">
                <li class="mb-2">
                    <a href="{{ route('dashboard') }}" class="hover:text-white">Dashboard</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('mission_orders.index') }}" class="hover:text-white">Mission Orders</a>
                </li>
                @if(auth()->user()->employee->role == 'hr')
                    <li class="mb-2">
                        <a href="{{ route('employees.index') }}" class="hover:text-white">Employees</a>
                    </li>
                @endif
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            @yield('content')
        </div>
    </div>

</body>
</html>
