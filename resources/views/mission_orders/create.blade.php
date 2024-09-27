@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-6 text-blue-700">Demander une mission</h2>
    <form action="{{ route('mission_orders.store') }}" method="POST" class="w-full">
        @if ($errors->any())
            <div class="text-danger text-pink-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @csrf
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-1/2 px-3 mb-6 md:mb-0">
                <x-label>
                    Mission #
                </x-label>
                <x-readonly-text-input name="order_number" />
            </div>
            <div class="w-1/2 px-3">
                <x-label>
                    Etat de la demande
                </x-label>
                <x-disabled-select-input name="status" required>
                    @switch(Auth::user()->employee->role)
                        @case('employee')
                            <option value="draft">Brouillon</option>
                        @break
                        @case('supervisor')
                            <option value="sup_aprove">Validée SH</option>
                        @break
                        @case('hr')
                            <option value="hr_approve">Validée RH</option>
                        @break
                        @case('sg')
                            <option value="sg_approve">Validée SG/direction</option>
                        @break
                    @endswitch
                </x-disabled-select-input>
            </div>
        </div>
        <x-form-divider>Missionaire</x-form-divider>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-1/2 px-3">
                <x-label>
                    Nom, Prénom
                </x-label>
                <input type="hidden" name="employee_id" value="{{ auth()->user()->employee->id }}">
                <x-readonly-text-input name="full_name" value="{{ auth()->user()->employee->full_name }}" />
            </div>
            <div class="w-1/2 px-3">
                <x-label>
                    Fonction
                </x-label>
                <x-readonly-text-input name="position" value="{{ auth()->user()->employee->position }}" />
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-1/3 px-3">
                <x-label>
                    Residence Administrative
                </x-label>
                <x-readonly-text-input name="administrativ_residence"
                    value="{{ auth()->user()->employee->administrativ_residence }}" />
            </div>
            <div class="w-1/3 px-3">
                <x-label>
                    Dép / Antenne
                </x-label>
                <input type="hidden" name="department_id" value="{{ auth()->user()->employee->department_id }}">
                <x-readonly-text-input name="department_name" value="{{ auth()->user()->employee->department->name }}" />
            </div>
            <div class="w-1/3 px-3">
                <x-label>
                    Service
                </x-label>
                <x-readonly-text-input name="service" value="{{ auth()->user()->employee->service }}" />
            </div>
        </div>
        <x-form-divider>Mission</x-form-divider>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <x-label>
                    Objet *
                </x-label>
                <x-text-input name="purpose" value="{{ old('purpose') }}" />
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-1/2 px-3">
                <x-label>
                    Lieu de départ
                </x-label>
                <x-text-input name="departure_location" value="{{ old('departure_location') }}" />
            </div>
            <div class="w-1/2 px-3">
                <x-label>
                    Lieu d'arrivée
                </x-label>
                <x-text-input name="arrive_location" value="{{ old('arrive_location') }}" />
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <x-label>
                    Pays de Mission*
                </x-label>
                <x-select-input name="bareme_id" required>
                    @foreach ($baremes as $bareme)
                        <option {{ old('bareme_id') == $bareme->id ? 'selected' : '' }} value="{{ $bareme->id }}">
                            {{ $bareme->pays }}</option>
                    @endforeach
                </x-select-input>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-2/3 px-3">
                <x-label>
                    Débute le : Date & Heure :
                </x-label>
                <x-date-time-input name="start_date" value="{{ old('start_date') }}" type="date">
                </x-date-time-input>
                <x-date-time-input name="start_time" value="{{ old('start_time') }}" type="time">
                </x-date-time-input>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-2/3 px-3">
                <x-label>
                    S'achève le : Date & Heure :
                </x-label>
                <x-date-time-input name="end_date" value="{{ old('end_date') }}" type="date">
                </x-date-time-input>
                <x-date-time-input name="end_time" value="{{ old('end_time') }}" type="time">
                </x-date-time-input>
            </div>
        </div>
        <x-form-divider>Frais Mission</x-form-divider>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <x-label class="inline">
                    Prise en charge des frais de transport *
                </x-label>
                <input @checked(old('charge') == 1) type="radio" value="1" name="charge"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">OUI</label>
                <input @checked(old('charge') == 0) type="radio" value="0" name="charge"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">NON</label>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <x-label class="inline">
                    Prise en charge des indemnités journalières de mission *
                </x-label>
                <input @checked(old('ijm') == 1) type="radio" value="1" name="ijm"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">OUI</label>
                <input @checked(old('ijm') == 0) type="radio" value="0" name="ijm"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">NON</label>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <x-label>
                    Imputation budgétaire : 625-11 et 625-61
                </x-label>
            </div>
        </div>
        <x-form-divider>Observations</x-form-divider>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <x-label>
                    Observations
                </x-label>
                <textarea name="description"
                    class="appearance-none h-40 block w-full bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">{{ old('description') }}</textarea>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <x-primary-button>Soumettre</x-primary-button>
            </div>
        </div>
    </form>
@endsection
