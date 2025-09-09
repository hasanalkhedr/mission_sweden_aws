@extends('layouts.app')
@section('title', __('Create Mission'))
@section('content')
    <h2 class="text-2xl font-bold mb-2 text-blue-700">Demander une mission</h2>
    <form action="{{ route('mission_orders.store') }}" method="POST" class="w-11/12 items-center">
        @csrf
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-1/3 px-3">
                <x-label>
                    Mission #
                </x-label>
                <x-readonly-text-input name="order_number" value="{{$mission_number }}" />
            </div>
            <div class="w-1/3 px-3">
                <x-label>
                    Date le Ordre:<span class="text-red-500">*</span>
                </x-label>
                <x-date-time-input class="appearance-none block h-12 w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none" name="order_date" value="{{(new \DateTime())->format('Y-m-d') }}" type="date" readonly>
                </x-date-time-input>
            </div>
            <div class="w-1/3 px-3">
                <x-label>
                    Etat de la demande
                </x-label>
                <x-disabled-select-input name="status" required>
                            <option value="draft">Brouillon</option>
                </x-disabled-select-input>
            </div>
        </div>
        <x-form-divider>Missionaire</x-form-divider>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-1/2 px-3">
                <x-label>
                    Nom, Prénom
                </x-label>
                <input type="hidden" name="employee_id" value="{{ auth()->user()->employee->id }}">
                <x-readonly-text-input name="full_name"
                    value="{{ auth()->user()->employee->first_name }} {{ auth()->user()->employee->last_name }}" />
            </div>
            <div class="w-1/2 px-3">
                <x-label>
                    Fonction
                </x-label>
                <x-readonly-text-input name="position" value="{{ auth()->user()->employee->position }}" />
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-1/2 px-3">
                <x-label>
                    Résidence administrative
                </x-label>
                <x-readonly-text-input name="administrativ_residence"
                    value="{{ auth()->user()->employee->administrativ_residence }}" />
            </div>
            <div class="w-1/2 px-3">
                <x-label>
                    Dép / Antenne
                </x-label>
                <input type="hidden" name="department_id" value="{{ auth()->user()->employee->department_id }}">
                <x-readonly-text-input name="department_name" value="{{ auth()->user()->employee->department->name }}" />
            </div>
        </div>
        <x-form-divider>Mission</x-form-divider>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full px-3">
                <x-label>
                    Objet<span class="text-red-500">*</span>
                </x-label>
                <textarea name="purpose" rows="2" required
                    class="appearance-none block w-full bg-white text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none border border-blue-700 focus:bg-white focus:border-blue-900">{{ old('purpose') }}</textarea>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-1/2 px-3">
                <x-label>
                    Lieu de départ<span class="text-red-500">*</span>
                </x-label>
                <x-text-input required name="departure_location" value="{{ old('departure_location') }}" />
            </div>
            <div class="w-1/2 px-3">
                <x-label>
                    Lieu d'arrivée<span class="text-red-500">*</span>
                </x-label>
                <x-text-input required name="arrive_location" value="{{ old('arrive_location') }}" />
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-2/3 px-3">
                <x-label>
                    Débute le : Date & Heure :<span class="text-red-500">*</span>
                </x-label>
                <x-date-time-input name="start_date" value="{{ old('start_date') }}" type="date" required>
                </x-date-time-input>
                <x-date-time-input name="start_time" value="{{ old('start_time') }}" type="time" required>
                </x-date-time-input>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-2/3 px-3">
                <x-label>
                    S'achève le : Date & Heure :<span class="text-red-500">*</span>
                </x-label>
                <x-date-time-input name="end_date" value="{{ old('end_date') }}" type="date" required>
                </x-date-time-input>
                <x-date-time-input name="end_time" value="{{ old('end_time') }}" type="time" required>
                </x-date-time-input>
            </div>
        </div>
        <x-form-divider>Frais Mission</x-form-divider>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full px-3">
                <x-label>
                    Pays de Mission<span class="text-red-500">*</span>
                </x-label>
                <div class="select-container">
                    <x-select-input name="bareme_id" required class="select2">
                        @foreach ($baremes as $bareme)
                            @if(str_contains($bareme->pays, 'France'))
                            <option {{ old('bareme_id', 184) == $bareme->id ? 'selected' : '' }} value="{{ $bareme->id }}">
                                {{ $bareme->pays }} ({{ $bareme->currency }})
                            </option>
                            @else
                                <option {{ old('bareme_id', 184) == $bareme->id ? 'selected' : '' }} value="{{ $bareme->id }}">
                                    {{ $bareme->pays }} (Montant:{{ $bareme->pays_per_day . ' ' . $bareme->currency }} /
                                    Repas:{{ $bareme->meal_cost }} /
                                    Hebergement:{{ $bareme->accomodation_cost }})
                                </option>
                            @endif
                        @endforeach
                    </x-select-input>
                    <script>
                        $(document).ready(function() {
                            $('.select2').select2({
                                placeholder: "Select an option", // Optional placeholder
                                allowClear: true // Optional clear button
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full px-3 py-1">
                <x-label class="w-1/3 inline-flex">
                    Prise en charge des frais de transport<span class="text-red-500">*</span>
                </x-label>
                <input required @checked(old('charge') == 1) type="radio" value="1" name="charge"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border border-blue-700 focus:ring-blue-500 dark:focus:ring-blue-600 mr-0 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label class="ms-1 text-sm font-medium text-blue-500 dark:text-gray-500 mr-5">OUI</label>
                <input required @checked(old('charge') == 0) type="radio" value="0" name="charge"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border border-blue-700 focus:ring-blue-500 dark:focus:ring-blue-600 mr-0 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label class="ms-1 text-sm font-medium text-blue-400 dark:text-gray-500 mr-10">NON</label>
            </div>
            <div class="w-full px-3 py-1">
                <x-label class="w-1/3 inline-flex">
                    Prise en charge des indemnités journalières de mission<span class="text-red-500">*</span>
                </x-label>
                <input required @checked(old('ijm') == 1) type="radio" value="1" name="ijm"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border border-blue-700 focus:ring-blue-500 dark:focus:ring-blue-600 mr-0 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label class="ms-1 text-sm font-medium mr-5 text-blue-400 dark:text-gray-500">OUI</label>
                <input required @checked(old('ijm') == 0) type="radio" value="0" name="ijm"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border border-blue-700 focus:ring-blue-500 dark:focus:ring-blue-600 mr-0 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label class="ms-1 text-sm font-medium text-blue-400 dark:text-gray-500 mr-5">NON</label>
            </div>
            <div class="w-full px-3 py-1">
                <x-label class="w-1/3 inline-flex">
                    Prise en charge d'une assurance voyage<span class="text-red-500">*</span>
                </x-label>
                <input required @checked(old('assurance') == 1) type="radio" value="1" name="assurance"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border border-blue-700 focus:ring-blue-500 dark:focus:ring-blue-600 mr-0 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label class="ms-1 text-sm font-medium mr-5 text-blue-400 dark:text-gray-500">OUI</label>
                <input required @checked(old('assurance') == 0) type="radio" value="0" name="assurance"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border border-blue-700 focus:ring-blue-500 dark:focus:ring-blue-600 mr-0 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label class="ms-1 text-sm font-medium text-blue-400 dark:text-gray-500 mr-5">NON</label>
            </div>
        </div>
        <x-form-divider>Observations</x-form-divider>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full px-3">
                <x-label>
                    Observation
                </x-label>
                <textarea name="description" rows="4"
                    class="appearance-none block w-full bg-white text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none border border-blue-700 focus:bg-white focus:border-blue-900">{{ old('description') }}</textarea>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full px-3">
                <x-primary-button data-modal-toggle="draftOrSubmitModal" type="button">Soumettre</x-primary-button>
                <div id="draftOrSubmitModal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow">
                            <!-- Modal header -->
                            <div class="flex justify-between items-center p-4 rounded-t border-b">
                                <div class="text-base font-bold mt-3 sm:mt-0 sm:ml-4 sm:text-left">
                                    {{ __('Save Mission as Draft or Submit it') }}
                                </div>
                                <div>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                        data-modal-toggle="draftOrSubmitModal">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6">
                                <div class="text-base leading-relaxed text-gray-500">
                                    <ul>
                                        <li>{{ __('When save the mission as draft, you can edit or delete it later.')}}</li>
                                        <li>{{ __('When submit the mission, you can not edit or delete it, and the mission will go to the approve process.')}}</li>
                                    </ul>
                                </div>
                                <div
                                    class="flex justify-end items-center p-6 space-x-2 rounded-b border-t border-gray-200">
                                    <div>
                                        <button data-modal-toggle="draftOrSubmitModal" name="action" value="draft"
                                            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 focus:z-10">
                                            {{ __('Save as Draft') }}
                                        </button>
                                    </div>
                                    <div>
                                        <button name="action" value="submit"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
                                            data-modal-toggle="draftOrSubmitModal">{{ __('Submit Mission') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
