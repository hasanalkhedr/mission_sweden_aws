@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-6 text-blue-700">{{$employee->full_name}}</h2>


            <x-form-divider>Données personnelles</x-form-divider>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-2/3 px-3">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <x-label>
                                Adresse électronique
                            </x-label>
                            <x-readonly-text-input value="{{$employee->email}}"/>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-1/2 px-3">
                            <x-label>
                                Nom, Prénom
                            </x-label>
                            <x-readonly-text-input value="{{ $employee->full_name }}" />
                        </div>
                        <div class="w-1/2 px-3">
                            <x-label>
                                Numéro de téléphone
                            </x-label>
                            <x-readonly-text-input value="{{ $employee->phone }}" />
                        </div>

                    </div>
                </div>
                <div class="w-1/3 px-3">
                    <!-- Image upload input and preview with button on top of the image -->
                    <div class="relative w-full h-full mx-auto">
                        <!-- Image preview -->
                        <img id="profileImagePreview"
                            src="{{ Vite::asset('public/storage/' . $employee->profile_image) ?? Vite::asset('resources/images/default-avatar.jpg') }}"
                            alt="Profile Image" class="object-cover w-full h-full">
                    </div>
                </div>
            </div>
            <x-form-divider>Fonction Administrative</x-form-divider>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-1/2 px-3">
                    <x-label>
                        Fonction Administrative
                    </x-label>
                    <x-readonly-text-input value="{{ $employee->position }}" />
                </div>
                <div class="w-1/2 px-3">
                    <x-label>
                        Dép / Antenne
                    </x-label>
                    <x-disabled-select-input >
                        @foreach ($departments as $department)
                            <option @selected(old('department_id') == $department->id ? 'selected' : '') value="{{ $department->id }}">{{ $department->name }}
                            </option>
                        @endforeach
                    </x-disabled-select-input>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-1/3 px-3">
                    <x-label>
                        Residence Administrative
                    </x-label>
                    <x-readonly-text-input value="{{ $employee->administrativ_residence }}" />
                </div>
                <div class="w-1/3 px-3">
                    <x-label>
                        Service
                    </x-label>
                    <x-readonly-text-input value="{{ $employee->service }}" />
                </div>
                <div class="w-1/3 px-3">
                    <x-label>
                        Rôles
                    </x-label>
                    <x-disabled-select-input>
                        @foreach ($roles as $role)
                            <option @selected(old('role') == $role ? 'selected' : '') value="{{ $role }}">{{ $role }}
                            </option>
                        @endforeach
                    </x-disabled-select-input>
                </div>
            </div>

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-1/2 px-3">
                    <input disabled type="checkbox" value="1" @checked($employee->allow_order) />
                    <x-label class="inline">Soumettre des demandes</x-label>
                </div>
                <div class="w-1/2 px-3">
                    <input disabled type="checkbox" value="1" @checked($employee->recieve_email) />
                    <x-label class="inline">Recevoir des e-mails</x-label>
                </div>
            </div>

@endsection
