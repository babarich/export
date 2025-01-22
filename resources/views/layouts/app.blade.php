<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="p-5">
                {{ $slot }}
            </main>
            <!-- Toast -->
<div
    x-data="toast"
    x-show="visible"
    x-transition
    x-cloak
    @notify.window="show($event.detail.message, $event.detail.type || 'success')"
    class="fixed w-[400px] left-1/2 -ml-[200px] top-16 py-2 px-4 pb-4 text-white"
    :class="type === 'success' ? 'bg-emerald-500' : 'bg-red-500'"
>
    <div class="font-semibold" x-text="message"></div>
    <button
        @click="close"
        class="absolute flex items-center justify-center right-2 top-2 w-[30px] h-[30px] rounded-full hover:bg-black/10 transition-colors"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M6 18L18 6M6 6l12 12"
            />
        </svg>
    </button>
    <!-- Progress -->
    <div>
        <div
            class="absolute left-0 bottom-0 right-0 h-[6px] bg-black/10"
            :style="{'width': `${percent}%`}"
        ></div>
    </div>
</div>
<!--/ Toast -->
        </div>


    <!-- Footer -->
    <footer class="bg-veryDarkBlue">
      <!-- Flex Container -->
      <div
        class="container flex flex-col-reverse justify-between px-6 py-10 mx-auto space-y-8 md:flex-row md:space-y-0"
      >
        <!-- Logo and social links container -->
        <div
          class="flex flex-col-reverse items-center justify-between space-y-12 md:flex-col md:space-y-0 md:items-start"
        >
          <div class="mx-auto my-6 text-center text-white md:hidden">
            Copyright &copy; {{ date('Y') }}, All Rights Reserved
          </div>
          <!-- Logo -->
          <div>
           <h3 class="font-bold text-2xl leading-tight  hover:text-primary">MIKESE Export</h3> 
          </div>

        </div>
        <!-- List Container -->
        <div class="flex justify-around space-x-32">
          <div class="flex flex-col space-y-3">
            <a href="#" class="hover:text-primary">Home</a>
            <a href="#" class="hover:text-primary">Pricing</a>
            <a href="#" class="hover:text-primary">Products</a>
            <a href="#" class="hover:text-primary">About</a>
          </div>
          <div class="flex flex-col space-y-3">
            <a href="#" class="hover:text-primary">Careers</a>
            <a href="#" class="hover:text-primary">Privacy Policy</a>
          </div>
        </div>

        <!-- Input Container -->
        <div class="flex flex-col justify-between">
          <form>
            <div class="flex space-x-3">
              <input
                type="text"
                class="flex-1 px-4 rounded-full focus:outline-none"
                placeholder="Updated in your inbox"
              />
              <button
                class="px-6 py-2 text-white rounded-full bg-primary hover:bg-primary focus:outline-none"
              >
                Go
              </button>
            </div>
          </form>
          <div class="hidden text-white md:block">
            Copyright &copy; {{ date('Y') }}, All Rights Reserved
          </div>
        </div>
      </div>
    </footer> 
    </body>
</html>
