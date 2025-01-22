<x-app-layout>
    <!-- Session Status -->
   
 <div class="bg-white w-[500px] mx-auto p-6 my-16 sm:rounded-lg">
    <form method="POST" action="{{ route('login') }}">
        @csrf

         <h2 class="text-2xl font-semibold text-center mb-5">
            Login to your account
        </h2>
        <p class="text-center text-gray-500 mb-6">
            or
            <a
                href="{{ route('register') }}"
                class="text-sm text-red-700 hover:text-red-600"
            >
                create new account
            </a>
        </p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')"/>
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        

        <div class="flex items-center justify-between  mt-4 mb-6">
            <div class="">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
          </div>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>
        <button
            class="btn-primary bg-red-500 p-4 text-white hover:bg-red-600 active:bg-red-700 w-full"
        >
             {{ __('Log in') }}
        </button>
    </form>
 </div>
</x-app-layout>
