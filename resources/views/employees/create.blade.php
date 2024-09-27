@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-6 text-blue-700">New Employee Data</h2>
    <div x-data="{ emailValue: '' }">
        <form action="{{ route('employees.store') }}" method="POST" class="w-full">
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
            <x-form-divider>Données personnelles</x-form-divider>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-2/3 px-3">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <x-label>
                                Adresse électronique
                            </x-label>
                            <x-text-input x-model="emailValue" name="email" value="{{ old('email') }}" />
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-1/2 px-3">
                            <x-label>
                                Nom, Prénom
                            </x-label>
                            <x-text-input name="full_name" value="{{ old('full_name') }}" />
                        </div>
                        <div class="w-1/2 px-3">
                            <x-label>
                                Numéro de téléphone
                            </x-label>
                            <x-text-input name="phone" value="{{ old('phone') }}" />
                        </div>

                    </div>
                </div>
                <div class="w-1/3 px-3">
                    <!-- Image upload input and preview with button on top of the image -->
                    <div class="relative w-full h-full mx-auto">
                        <!-- Image preview -->
                        <img id="profileImagePreview"
                            src="{{ Vite::asset('resources/images/default-avatar.jpg') }}"
                            alt="Profile Image" class="object-cover w-full h-full">
                        <!-- Browse Files Button positioned on top of the image -->
                        <div class="rounded-xl absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-50 hover:opacity-100 transition-opacity">
                            <input type="file" name="profile_image" id="profile_image" class="hidden"
                                onchange="previewImage(event)">
                            <button type="button" onclick="document.getElementById('profile_image').click()"
                                class="text-white bg-blue-600 hover:bg-blue-700 rounded-xl w-1/2">
                                <img src="{{ Vite::asset('resources/images/browse-image.png') }}"
                                alt="Browse Image">
                            </button>
                        </div>
                        <!-- Image Preview Script -->
                        <script>
                            function previewImage(event) {
                                const reader = new FileReader();
                                reader.onload = function() {
                                    const output = document.getElementById('profileImagePreview');
                                    output.src = reader.result;
                                };
                                reader.readAsDataURL(event.target.files[0]);
                            }
                        </script>
                    </div>
                </div>
            </div>
            <x-form-divider>Fonction Administrative</x-form-divider>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-1/3 px-3">
                    <x-label>
                        Fonction Administrative
                    </x-label>
                    <x-text-input name="position" value="{{ old('position') }}" />
                </div>
                <div class="w-1/3 px-3">
                    <x-label>
                        Dép / Antenne
                    </x-label>
                    <x-select-input name="department_name">
                        @foreach ($departments as $department)
                            <option @selected(old('department_id') == $department->id ? 'selected' : '') value="{{ $department->id }}">{{ $department->name }}
                            </option>
                        @endforeach
                    </x-select-input>
                </div>
                <div class="w-1/3 px-3">
                    <x-label>
                        Service
                    </x-label>
                    <x-text-input name="service" value="{{ old('service') }}" />
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-1/2 px-3">
                    <x-label>
                        Residence Administrative
                    </x-label>
                    <x-text-input name="administrativ_residence" value="{{ old('administrativ_residence') }}" />
                </div>
                <div class="w-1/2 px-3">
                    <x-label>
                        Service
                    </x-label>
                    <x-text-input name="service" value="{{ old('service') }}" />
                </div>
            </div>
            <x-form-divider>Le compte utilisateur du salarié</x-form-divider>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-1/2 px-3">
                    <x-label>
                        Adresse électronique
                    </x-label>
                    <x-readonly-text-input ::value="emailValue" />
                </div>
                <div class="w-1/2 px-3">
                    <x-label>
                        Rôles
                    </x-label>
                    <x-select-input name="role">
                        @foreach ($roles as $role)
                            <option @selected(old('role') == $role ? 'selected' : '') value="{{ $role }}">{{ $role }}
                            </option>
                        @endforeach
                    </x-select-input>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-1/2 px-3">
                    <x-label for="password">Password</x-label>
                    <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="w-1/2 px-3">
                    <x-label for="password_confirmation">Confirm Password</x-label>
                    <x-text-input id="password_confirmation" type="password" name="password_confirmation" required
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-1/2 px-3">
                    <input type="checkbox" @checked(old('allow_order')) name="allow_order" />
                    <x-label class="inline">Soumettre des demandes</x-label>
                </div>
                <div class="w-1/2 px-3">
                    <input type="checkbox" @checked(old('recieve_email')) name="recieve_email" />
                    <x-label class="inline">Recevoir des e-mails</x-label>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <x-primary-button>Soumettre</x-primary-button>
                </div>
            </div>
        </form>
    </div>
@endsection
