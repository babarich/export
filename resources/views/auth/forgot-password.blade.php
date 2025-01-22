<x-app-layout>
    <div class="bg-white w-[500px] mx-auto p-6 my-16 sm:rounded-lg">

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
            <p class="text-center text-gray-500 mb-6">
                        or
                        <a
                            href="{{ route('login') }}"
                            class="text-red-600 hover:text-red-500"
                        >
                            login with existing account
                        </a>
                    </p>
                    <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center  mt-4">
            <button
            class="btn-primary bg-red-500 p-4 text-white hover:bg-red-600 active:bg-red-700 w-full"
        >
             {{ __('Email Password Reset Link') }}
        </button>
           
        </div>
    </form>
    </div>
</x-app-layout>
