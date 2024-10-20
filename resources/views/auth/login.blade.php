<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <section class="h-screen">
        <div class="container px-6 py-12 h-full m-auto">
            <div class="flex justify-center items-center flex-wrap h-full g-6 text-gray-800">
                <div class="md:w-8/12 lg:w-6/12 mb-12 md:mb-0">
                    <img src="{{Vite::asset('resources/images/login-image.jpg')}}" class="w-full" alt="Phone image">
                </div>
                <div class="md:w-8/12 lg:w-5/12 lg:ml-20">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Logo -->
        <div class="flex justify-center">
            <x-application-logo class="w-2/4" alt="Logo"/>
        </div>
        <div class="flex items-center my-4 before:flex-1 before:border-t before:border-gray-300 before:mt-0.5 after:flex-1 after:border-t after:border-gray-300 after:mt-0.5">
            <p class="text-center font-semibold mx-4 mb-0">Connexion</p>
        </div>
        <!-- Email Address -->
        <div class="mb-6">

            <x-text-input id="email" class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none " type="email" name="email" :value="old('email')" required autofocus autocomplete="email" placeholder="Adresse électronique"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-6">


            <x-text-input id="password" class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            type="password"
                            name="password"
                            required
                            placeholder="Mot de passe"
                            autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
     <!--   <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
            -->
            <x-primary-button class="text-center inline-block px-7 py-3 bg-blue-600 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out w-full" data-mdb-ripple="true" data-mdb-ripple-color="light">
                {{ __('Login') }}
            </x-primary-button>
        </div>
        <div class="powered-by">
            Powered By <a class="IST" href="https://isolutionleb.com/">IST</a>
        </div>
    </form>
</div>
</div>
</div>
</section>
</x-guest-layout>
