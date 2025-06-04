@extends('layouts.app')
@section('title', __('Add Memoire'))
@section('content')
    <h2 class="text-2xl font-bold mb-2 text-blue-700">MÉMOIRE DE FRAIS / TOURNEE</h2>
    <form action="{{ route('tournees.m_update', $tournee->id) }}" method="POST" class="w-11/12 items-center">
        @csrf
        @method('PUT')
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-1/3 px-3">
                <x-label>
                    Tournee #
                </x-label>
                <x-readonly-text-input value="{{ $tournee->order_number }}" />
            </div>
            <div class="w-1/3 px-3">
                <x-label>
                    Date le Ordre:<span class="text-red-500">*</span>
                </x-label>
                <x-date-time-input
                    class="appearance-none block h-12 w-full bg-white text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    name="memor_date" value="{{ old('memor_date', $tournee->end_date->format('Y-m-d')) }}" type="date" required>
                </x-date-time-input>
            </div>
            <div class="w-1/3 px-3">
                <x-label>
                    Etat de la demande
                </x-label>
                <x-disabled-select-input>
                    <option value="draft">Brouillon</option>
                </x-disabled-select-input>
            </div>
        </div>
        <x-form-divider>Tourneeaire</x-form-divider>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-1/2 px-3">
                <x-label>
                    Nom, Prénom
                </x-label>
                <x-readonly-text-input
                    value="{{ $tournee->employee->first_name }} {{ $tournee->employee->last_name }}" />
            </div>
            <div class="w-1/2 px-3">
                <x-label>
                    Fonction
                </x-label>
                <x-readonly-text-input value="{{ $tournee->employee->position }}" />
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-1/2 px-3">
                <x-label>
                    Residence Administrative
                </x-label>
                <x-readonly-text-input value="{{ $tournee->employee->administrativ_residence }}" />
            </div>
            <div class="w-1/2 px-3">
                <x-label>
                    Dép / Antenne
                </x-label>
                <x-readonly-text-input value="{{ $tournee->employee->department->name }}" />
            </div>
        </div>
        <x-form-divider>Tournee</x-form-divider>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full px-3">
                <x-label>
                    Objet
                </x-label>
                <textarea rows="2" readonly
                    class="appearance-none block w-full bg-white text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none border border-blue-700 focus:bg-white focus:border-blue-900">{{ $tournee->purpose }}</textarea>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-1/2 px-3">
                <x-label>
                    Lieu de la Tournee
                </x-label>
                <x-readonly-text-input value="{{ $tournee->arrive_location }}" />
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-2/3 px-3">
                <x-label>
                    Date d’arrivé : Date & Heure :<span class="text-red-500">*</span>
                </x-label>
                <x-date-time-input disabled name="start_date" value="{{ $tournee->start_date->format('Y-m-d') }}"
                    type="date">
                </x-date-time-input>
                <x-date-time-input disabled name="start_time" value="{{ $tournee->start_time }}" type="time">
                </x-date-time-input>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-2/3 px-3">
                <x-label>
                    Date de départ : Date & Heure :<span class="text-red-500">*</span>
                </x-label>
                <x-date-time-input readonly name="end_date" value="{{ $tournee->end_date->format('Y-m-d') }}"
                    type="date">
                </x-date-time-input>
                <x-date-time-input disabled name="end_time" value="{{ $tournee->end_time }}" type="time">
                </x-date-time-input>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full px-3">
                <x-label>
                    Pays de Tournee<span class="text-red-500">*</span>
                </x-label>
                <x-disabled-select-input>
                    <option value="{{ $tournee->bareme->id }}">
                            {{ $tournee->bareme->pays }}
                            (Montant:{{ $tournee->bareme->pays_per_day . ' ' . $tournee->bareme->currency }} /
                            Repas:{{ $tournee->bareme->meal_cost }} /
                            Hebergement:{{ $tournee->bareme->accomodation_cost }})
                        </option>
                </x-disabled-select-input>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-1/2 px-3">
                <x-label>
                    Nuitées à déduire des IJM<span class="text-red-500">*</span>
                </x-label>
                <x-text-input type="number" name="no_ded_accomodation" id="no_ded_accomodation"
                    value="{{old('no_ded_accomodation', $tournee->no_ded_accomodation) }}" />
            </div>
            <div class="w-1/2 px-3">
                <x-label>
                    Repas à déduire<span class="text-red-500">*</span>
                </x-label>
                <x-text-input type="number" name="no_ded_meals" id="no_ded_meals"
                    value="{{ old('no_ded_meals', $tournee->no_ded_meals) }}" />
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-1/2 px-3">
                <x-label>
                    Avance sur IJM (EURO ou USD)<span class="text-red-500">*</span>
                </x-label>
                <x-text-input type="number" step="any" name="advance" value="{{ old('advance',$tournee->advance) }}" />
            </div>
            <div class="w-1/2 px-3">
                <x-label>{{__('Submit Values before add expenses')}}</x-label>
                <x-primary-button name="action" value="partialSubmit" class="h-11">Soumettre des valeurs</x-primary-button>
            </div>
        </div>
        <x-form-divider>Frais Tournee</x-form-divider>
        @include('partials.modals._tournee-expensestable')
        <x-form-divider>Hebergement</x-form-divider>
        @include('partials.modals._tournee-ijmtable')
        <div class="-mx-3 mb-2">
            <div class="w-full px-3 text-end">
                <x-primary-button data-modal-toggle="draftOrSubmitModal" type="button">Soumettre</x-primary-button>
                <div id="draftOrSubmitModal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow">
                            <!-- Modal header -->
                            <div class="flex justify-between items-center p-4 rounded-t border-b">
                                <div class="text-base font-bold mt-3 sm:mt-0 sm:ml-4 sm:text-left">
                                    {{ __('Save Tournee as Draft or Submit it') }}
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
                                <div class="text-base leading-relaxed text-gray-500 text-start">
                                    <ul>
                                        <li>{{__('When save the tournee as draft, you can edit or delete it later.')}}</li>
                                        <li>{{__('When submit the tournee, you can not edit or delete it, and the tournee will go to the approve process.')}}</li>
                                    </ul>
                                </div>
                                <div class="flex justify-end items-center p-6 space-x-2 rounded-b border-t border-gray-200">
                                    <div>
                                        <button data-modal-toggle="draftOrSubmitModal" name="action" value="draft"
                                            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                                            {{ __('Save as Draft') }}
                                        </button>
                                    </div>
                                    <div>
                                        <button name="action" value="submit"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
                                            data-modal-toggle="draftOrSubmitModal">{{ __('Submit Tournee') }}
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
    @include('partials.modals._tournee-create-expense')

@endsection
