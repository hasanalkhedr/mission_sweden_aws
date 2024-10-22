<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') </title>
    <link rel="icon" type="image/x-icon" href="{{ Vite::asset('resources/images/favicon32.png') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css"
        integrity="sha512-MQXduO8IQnJVq1qmySpN87QQkiR1bZHtorbJBD0tzy7/0U9+YIC93QWHeGTEoojMVHWWNkoCp8V6OzVSYrX0oQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head')
</head>

<body>
    <div>
        <div class="lg:flex h-full min-h-screen">
            <!-- Menu Sidebar -->
            <div class="lg:flex-col w-1/5 border-blue-200 blue-bg no-print">
                <div class="logo-container w-full sm:w-full">
                    <x-application-logo />
                </div>
                <div class="flex flex-row items-center place-content-between">
                    <div class="lg:pt-6">
                        <button data-collapse-toggle="aside-default"
                            class="inline-flex items-center mx-2 p-2 text-sm text-white rounded-lg lg:hidden"
                            aria-controls="navbar-default" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="lg:mt-2">
                    <aside class="hidden w-full lg:inline blue-bg" style="margin-top: 1%;" id="aside-default">
                        <ul class="content-between space-y-2">
                            <!-- Mission Menu -->
                            <li>
                                {{-- <a href="{{ route('mission_orders.index') }}"> --}}
                                    <button type="button"
                                        class="flex items-center mx-2 p-2 w-full text-2xl font-normal text-white rounded-lg transition duration-75 group hover:bg-blue-500"
                                        style="width: -webkit-fill-available;" aria-controls="dropdown-missions"
                                        data-collapse-toggle="dropdown-missions">
                                        <span class="flex-1 mx-2 text-left font-medium text-white"
                                            sidebar-toggle-item>{{ __('Missions') }}</span>
                                        {{-- <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg> --}}
                                    </button>
                                {{-- </a> --}}
                                <ul id="dropdown-missions-" class="py-2 space-y-2 mx-2">
                                    <li>
                                        <a class="flex items-center mx-2 px-2 py-2 text-white rounded-lg transition duration-75 group hover:bg-blue-500"
                                            href="{{ route('mission_orders.create') }}">
                                            <span class="mx-2 font-medium">{{ __('Nouvelle demande') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center mx-2 px-2 py-2 text-white rounded-lg transition duration-75 group hover:bg-blue-500"
                                            href="{{ route('mission_orders.index') }}">
                                            <span class="mx-2 font-medium">{{ __('Ordres de missions') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center mx-2 px-2 py-2 text-white rounded-lg transition duration-75 group hover:bg-blue-500"
                                            href="{{ route('mission_orders.m_index') }}">
                                            <span class="mx-2 font-medium">{{ __('Mémoires de Frais') }}</span>
                                        </a>
                                    </li>
                                    {{-- <li>
                                        <a class="flex items-center mx-2 px-2 py-2 text-white rounded-lg transition duration-75 group hover:bg-blue-500"
                                            href="#">
                                            <span class="mx-2 font-medium">{{ __('Signatures') }}</span>
                                        </a>
                                    </li> --}}
                                </ul>
                            </li>
                            <hr />
                            <!-- Tournees Menu -->
                            <li>
                                {{-- <a href="{{ route('tournees.index') }}"> --}}
                                    <button type="button"
                                        class="flex items-center mx-2 p-2 w-full text-2xl font-bold  text-white rounded-lg transition duration-75 group hover:bg-blue-500"
                                        style="width: -webkit-fill-available;" aria-controls="dropdown-tournees"
                                        data-collapse-toggle="dropdown-tournees">
                                        <span class="flex-1 mx-2 text-left font-medium text-white"
                                            sidebar-toggle-item>{{ __('Tournées') }}</span>
                                        {{-- <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg> --}}
                                    </button>
                                {{-- </a> --}}
                                <ul id="dropdown-tournees-" class=" py-2 space-y-2 mx-2">
                                    <li>
                                        <a class="flex items-center mx-2 px-2 py-2 text-white rounded-lg transition duration-75 group hover:bg-blue-500"
                                            href="{{ route('tournees.create') }}">
                                            <span class="mx-2 font-medium">{{ __('Nouvelle demande') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center mx-2 px-2 py-2 text-white rounded-lg transition duration-75 group hover:bg-blue-500"
                                            href="{{ route('tournees.index') }}">
                                            <span class="mx-2 font-medium">{{ __('Ordres de missions') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center mx-2 px-2 py-2 text-white rounded-lg transition duration-75 group hover:bg-blue-500"
                                            href="{{ route('tournees.m_index') }}">
                                            <span class="mx-2 font-medium">{{ __('Mémoires de Frais/Tournee') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <hr />
                            <!-- My Profile Item -->
                            <li>
                                <a href="{{ route('employees.show', auth()->user()->employee) }}"
                                    class="flex items-center mx-2 px-2 py-2 text-white rounded-lg transition duration-75 group hover:bg-blue-500">
                                    <span class="mx-2 font-medium">{{ __('Mon Profil') }}</span>
                                </a>
                            </li>
                            <hr />
                            @if (auth()->user()->employee->role !== 'employee')
                                <!-- Calender Item -->
                                <li>
                                    <a href="#"
                                        class="flex items-center mx-2 px-2 py-2 text-white rounded-lg transition duration-75 group hover:bg-blue-500">
                                        <span class="mx-2 font-medium">{{ __('Calendrier') }}</span>
                                    </a>
                                </li>
                                <hr />
                                <!-- Reports Item -->
                                <li>
                                    <a href="#"
                                        class="flex items-center mx-2 px-2 py-2 text-white rounded-lg transition duration-75 group hover:bg-blue-500">
                                        <span class="mx-2 font-medium">{{ __('Rapports') }}</span>
                                    </a>
                                </li>
                                <hr />
                            @endif
                            <!-- Settings Menu -->
                            @if (auth()->user()->employee->role != 'employee')
                                <li>
                                    <button type="button"
                                        class="flex items-center mx-2 p-2 w-full text-base font-normal text-white rounded-lg transition duration-75 group hover:bg-blue-500"
                                        style="width: -webkit-fill-available;" aria-controls="dropdown-settings"
                                        data-collapse-toggle="dropdown-settings">
                                        <span class="flex-1 mx-2 text-left font-medium text-white"
                                            sidebar-toggle-item>{{ __('Settings') }}</span>
                                        {{-- <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg> --}}
                                    </button>
                                    <ul id="dropdown-settings-" class="py-2 space-y-2 mx-2">
                                        <li>
                                            <a class="flex items-center mx-2 px-2 py-2 text-white rounded-lg transition duration-75 group hover:bg-blue-500"
                                                href="{{ route('baremes.index') }}">
                                                <span class="mx-2 font-medium">{{ __('Baremes') }}</span>
                                            </a>
                                        </li>
                                        {{-- @unless (auth()->user()->hasExactRoles('employee')) --}}
                                        <li>
                                            <a class="flex items-center mx-2 px-2 py-2 text-white rounded-lg transition duration-75 group hover:bg-blue-500"
                                                href="{{ route('departments.index') }}">
                                                <span class="mx-2 font-medium">{{ __('Departments') }}</span>
                                            </a>

                                        </li>
                                        {{-- @endunless --}}
                                        {{-- @unless (auth()->user()->hasExactRoles('employee') && auth()->user()->is_supervisor == false) --}}
                                        <li>
                                            <a class="flex items-center mx-2 px-2 py-2 text-white rounded-lg transition duration-75 group hover:bg-blue-500"
                                                href="{{ route('employees.index') }}">
                                                <span class="mx-2 font-medium">{{ __('Users') }}</span>
                                            </a>
                                        </li>
                                        {{-- @endunless --}}
                                        {{-- <li>
                                        <a class="flex items-center mx-2 px-2 py-2 text-white rounded-lg transition duration-75 group hover:bg-blue-500"
                                            href="#">
                                            <span class="mx-2 font-medium">{{ __('Signatures') }}</span>
                                        </a>
                                    </li> --}}
                                    </ul>
                                </li>
                                <hr />
                            @endif
                        </ul>
                    </aside>
                </div>
            </div>
            <!-- Header and Body -->
            <div class="lg:pt-8 w-full h-full overflow-y-auto sm:pt-0 lg:mx-4 sm:mx-0">
                <div class="no-print">
                    <nav class="w-full bg-white border-b-2 border-indigo-600 flex justify-between no-print">
                        <div class="flex flex-col py-2">
                            <div class="px-2 text-xl font-bold text-black">
                                {{ auth()->user()->employee->first_name }} {{ auth()->user()->employee->last_name }}
                            </div>
                            <div class="px-2  text-md italic text-black">
                                {{-- (implode(' | ', auth()->user()->getRoleNamesCustom())) --}}
                                {{ config('globals.roles.' . auth()->user()->employee->role) }}
                            </div>
                        </div>
                        <div class="flex mx-2">
                            <div class="py-3 pr-6 text-xl font-bold">
                                <livewire:megaphone />
                            </div>

                            <div class="py-6 text-xl font-bold text-black">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit">
                                        <i class="fa-solid fa-right-from-bracket"></i> {{ __('Logout') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </nav>
                </div>
                @include('flash-messages.error-flash-message')
                <div class="w-full">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"
        integrity="sha512-K/oyQtMXpxI4+K0W7H25UopjM8pzq0yrVdFdG21Fh5dBe91I40pDd9A4lzNlHPHBIP2cwZuoxaUSX0GJSObvGA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/fr.js"></script>
    {{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
</body>

</html>
