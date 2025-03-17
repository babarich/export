<?php
/** @var \Illuminate\Database\Eloquent\Collection $orders */
?>

<x-app-layout>
    <div class="container grid grid-cols-12 items-start gap-6 pt-4 pb-16">

        <!-- sidebar -->
        <div class="col-span-3">
            <div class="px-4 py-3 shadow flex items-center gap-4 bg-white">
                <div class="flex-shrink-0">
                   <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 mr-2"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                    />
                                </svg>
                   
                </div>
                <div class="flex-grow">
                    <p class="text-gray-600">Hello,</p>
                    <h4 class="text-primary font-medium">{{Auth::user()->name ?? '' }}</h4>
                </div>
            </div>

            <div class="mt-6 bg-white shadow rounded p-4 divide-y divide-gray-200 space-y-4 text-gray-600">
                <div class="space-y-1 pl-8">
                    <a href="#" class="relative text-primary block font-medium capitalize transition">
                        <span class="absolute -left-8 top-0 text-base">
                            <i class="fa-regular fa-address-card"></i>
                        </span>
                        Manage account
                    </a>
                    <a href="#" class="relative hover:text-primary block capitalize transition">
                        Profile information
                    </a>
                    <a href="#" class="relative hover:text-primary block capitalize transition">
                        Manage addresses
                    </a>
                    <a href="#" class="relative hover:text-primary block capitalize transition">
                        Change password
                    </a>
                </div>

                <div class="space-y-1 pl-8 pt-4">
                    <a href="#" class="relative hover:text-primary block font-medium capitalize transition">
                        <span class="absolute -left-8 top-0 text-base">
                            <i class="fa-solid fa-box-archive"></i>
                        </span>
                        My order history
                    </a>
                    <a href="#" class="relative hover:text-primary block capitalize transition">
                        My returns
                    </a>
                    <a href="#" class="relative hover:text-primary block capitalize transition">
                        My Cancellations
                    </a>
                    <a href="#" class="relative hover:text-primary block capitalize transition">
                        My reviews
                    </a>
                </div>

                
                

                <div class="space-y-1 pl-8 pt-4">
                    <form method="POST" action="{{ route('logout') }}">
                                @csrf

                    <a href="{{ route('logout') }}" 
                    onclick="event.preventDefault();
                                        this.closest('form').submit();"
                    class="relative hover:text-primary block font-medium capitalize transition">
                        <span class="absolute -left-8 top-0 text-base">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        </span>
                        Logout
                    </a>
                </form>
                </div>

            </div>
        </div>
        <!-- ./sidebar -->

        <!-- info -->
        <div class="col-span-9 grid grid-cols-1 gap-4">
             <p class="text-primary text-lg font-semibold">My Total Orders</p>
             @foreach($orders as $order)
               <div class="shadow rounded bg-white px-4 pt-6 pb-8">
                <div class="flex items-center justify-between mb-4">
                    <div class="space-y-1">
                    <h4 class="text-gray-700 font-medium">Date: {{$order->created_at}}</h4>
                    <p class="text-gray-800">Quatinty : {{$order->items_count}} item(s) </p>
                    <p class="text-gray-800">Total Price: {{$order->total_price}}</p>
                </div>
                    <div class="space-y-6">
                        <a href="{{ route('order.view', $order) }}" class="bg-primary border border-primary text-white px-8 py-3 font-medium 
                                                rounded-md hover:bg-transparent hover:text-primary mb-6">View Order</a>
                        <p class="text-gray-800 mt-4">Status: <br/>
                             <small class="text-white py-1 px-2 rounded
                                {{$order->isPaid() ? 'bg-emerald-500' : 'bg-gray-400' }}">
                                {{$order->status}}
                            </small
                            >
                        </p>
                    </div>
                    
                </div>
                
            </div>
                   
        @endforeach
          

           

          

        </div>
        <!-- ./info -->

    </div>
   
</x-app-layout>
