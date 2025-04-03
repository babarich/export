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
        <div class="col-span-9 grid grid-cols-1 gap-4 bg-white">
             <p class="text-primary text-lg font-semibold">Order Details</p>
             <div class="box_shadow px-6 py-4">
                <div class="flex gap-5 sm:gap-0 flex-wrap sm:flex-nowrap justify-between items-center">
                   
                    <div>
                        <h5>Order Date:</h5>
                        <p>{{$order->created_at}}</p>
                    </div>
                    <div>
                        <h5>Order Status:</h5>
                        <p>
                             <span
                            class="text-white py-1 px-2 rounded {{$order->isPaid() ? 'bg-emerald-500' : 'bg-gray-400'}}">
                            {{$order->status}}
                        </span>
                        </p>
                    </div>
                    <div>
                        <h5>Total Price:</h5>
                        <p>{{number_format($order->total_price)}}</p>
                    </div>
                    <div>
                        <a href="review-details.html" class="border border-primary text-primary
                         hover:bg-primary hover:text-white transition duration-300 px-6 py-2 rounded">Write
                            A Review
                        </a>
                    </div>
                </div>

             
                <!-- product details -->
                @foreach($order->items()->with('product')->get() as $item)
                
                <div class="md:flex gap-8 sm:gap-16 lg:gap-20 xl:gap-28 items-center mt-8">
                    <div class="flex gap-5">
                        <div class="w-16 h-16">
                             <a href="{{ route('product.view', $item->product) }}"
                            class="flex items-center justify-center overflow-hidden">
                                <img src="{{$item->product->image}}" class="object-cover" alt=""/>
                            </a>
                        </div>
                        <div>
                            <h5>{{$item->product->title}}</h5>
                            <p>No warranty </p>
                            
                        </div>
                    </div>
                    <div class="flex items-center gap-4 sm:gap-16 lg:gap-16 xl:gap-28 mt-3 md:mt-0">
                        <div>
                            <p>Price</p>
                            <h5>{{number_format($item->unit_price)}} </h5>
                        </div>
                        <div>
                            <p>Quantity</p>
                            <h5>Qty: {{$item->quantity}}</h5>
                        </div>
                        
                    </div>
                </div>
            @endforeach
              

            </div>

            <div class="grid grid-cols-12 gap-6 mt-6">
                <div class="col-span-12 lg:col-span-4 box_shadow px-8 py-6">
                    <div>
                        <div>
                            <h4 class="text-lg">Shipping Address</h4>
                        </div>
                        <div class="mt-4">
                            <p class="text-semibold">Ralph Bohner</p>
                            <p>3891 Ranchview Dr.</p>
                            <p>Richardson, Califora</p>
                            <p>(123) 456-789</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 lg:col-span-4 box_shadow px-8 py-6">
                    <div>
                        <div>
                            <h4 class="text-lg">Billing Address</h4>
                        </div>
                        <div class="mt-4">
                            <p class="text-semibold">Ralph Bohner</p>
                            <p>3891 Ranchview Dr.</p>
                            <p>Richardson, Califora</p>
                            <p>(123) 456-789</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 lg:col-span-4 box_shadow px-8 py-6">
                    <div>
                        <div>
                            <h4 class="text-lg">Total Summary</h4>
                        </div>
                        <div class="mt-4">
                            <div class="flex justify-between">
                                <p>Subtotal</p>
                                <p class="font-medium">$50</p>
                            </div>
                            <div class="flex justify-between">
                                <p>Shipping Fee</p>
                                <p class="font-medium">$30</p>
                            </div>
                            <hr class="my-2">
                            <div class="flex justify-between">
                                <p class="font-medium">Total</p>
                                <p class="font-medium">$80</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p>Paid by Cash on Delivery</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
                   
      

        </div>
        <!-- ./info -->

    </div>

  
</x-app-layout>
