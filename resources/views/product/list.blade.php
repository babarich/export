<?php
/** @var \Illuminate\Database\Eloquent\Collection $products */
$categoryList = \App\Models\Category::getActiveAsTree();

?>

<x-app-layout>

        <x-category-list :category-list="$categoryList" class="-ml-5 -mt-5 -mr-5 px-4"/>

        <section id="hero" class="mt-4 py-5">
      <!-- Flex Container -->
      
       <div
        class="container flex flex-col-reverse items-center px-4 mx-auto mt-4 space-y-0 md:space-y-0 md:flex-row"
      >
        <!-- Left item -->
        <div class="flex flex-col mb-32 space-y-12 md:w-1/2">
          <h1
            class="max-w-md text-4xl font-bold text-center md:text-5xl md:text-left"
          >
            Bring everyone together to get better products
          </h1>
          <p class="max-w-sm text-center text-darkGrayishBlue md:text-left">
            Mikese Export make it easy  for business and other customers to order and get their products within early as possible
          </p>
         <div class="mt-12">
                <a href="#" class="bg-primary border border-primary text-white px-8 py-3 font-medium 
                    rounded-md hover:bg-transparent hover:text-primary">Shop Now</a>
            </div>
        </div>
        <!-- Image -->
        <div class="md:w-1/2">
          <img class="object-contain h-5/6" src="{{asset('assets/images/ecom.png')}}" alt="" />
        </div>
      </div>
    </section>

        <!-- features -->
    <div class="container py-16">
        <div class="w-11/12 grid grid-cols-1 md:grid-cols-3 gap-6 mx-auto justify-center">
            <div class="border border-primary rounded-sm px-3 py-6 flex justify-center items-center gap-5">
                <img src="assets/images/icons/delivery-van.svg" alt="Delivery" class="w-12 h-12 object-contain">
                <div>
                    <h4 class="font-medium capitalize text-lg">Fast Delivery</h4>
                    <p class="text-gray-500 text-sm">Order now to deliver</p>
                </div>
            </div>
            <div class="border border-primary rounded-sm px-3 py-6 flex justify-center items-center gap-5">
                <img src="assets/images/icons/money-back.svg" alt="Delivery" class="w-12 h-12 object-contain">
                <div>
                    <h4 class="font-medium capitalize text-lg">Sell Products</h4>
                    <p class="text-gray-500 text-sm">Easily sell products</p>
                </div>
            </div>
            <div class="border border-primary rounded-sm px-3 py-6 flex justify-center items-center gap-5">
                <img src="assets/images/icons/service-hours.svg" alt="Delivery" class="w-12 h-12 object-contain">
                <div>
                    <h4 class="font-medium capitalize text-lg">24/7 Support</h4>
                    <p class="text-gray-500 text-sm">Customer support</p>
                </div>
            </div>
        </div>
    </div>
    <!-- ./features -->

    <section class="w-11/12 container">
    <div class="flex flex-col md:w-1/2">
        <div>

        </div>
        <div class="md:w-1/2">
       <div class="flex gap-2 items-center p-3 pb-0" x-data="{
            selectedSort: '{{ request()->get('sort', '-updated_at') }}',
            searchKeyword: '{{ request()->get('search') }}',
            updateUrl() {
                const params = new URLSearchParams(window.location.search)
                if (this.selectedSort && this.selectedSort !== '-updated_at') {
                    params.set('sort', this.selectedSort)
                } else {
                    params.delete('sort')
                }

                if (this.searchKeyword) {
                    params.set('search', this.searchKeyword)
                } else {
                    params.delete('search')
                }
                window.location.href = window.location.origin + window.location.pathname + '?'
                + params.toString();
            }
        }">
        <form action="" method="GET" class="flex-1" @submit.prevent="updateUrl">
            <x-input class="w-full" type="text" name="search" placeholder="Search for the products"
                     x-model="searchKeyword"/>
        </form>
        <x-input
            x-model="selectedSort"
            @change="updateUrl"
            type="select"
            name="sort"
            class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded">
            <option value="price">Price (ASC)</option>
            <option value="-price">Price (DESC)</option>
            <option value="title">Title (ASC)</option>
            <option value="-title">Title (DESC)</option>
            <option value="-updated_at">Last Modified at the top</option>
            <option value="updated_at">Last Modified at the bottom</option>
        </x-input>

    </div>
        </div>

    </div>
    </section>
    
    <section class="w-11/12 container">
<?php if ( $products->count() === 0 ): ?>
    <div class="text-center text-gray-600 py-16 text-xl">
        There are no products published
    </div>
    <?php else: ?>
        <div class="px-4 xl:px-0">
            <div class="w-full pt-4 pb-20 lg:py-6">
            <div class="grid gap-4 grig-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 p-3">
                @foreach($products as $product)
            <article class="h-full transform overflow-hidden rounded border border-border-200 bg-white shadow-sm transition-all
            duration-200 hover:-translate-y-0.5 hover:shadow"
                x-data="productItem({{ json_encode([
                                    'id' => $product->id,
                                    'slug' => $product->slug,
                                    'image' => $product->image ?: '/img/noimage.png',
                                    'title' => $product->title,
                                    'price' => $product->price,
                                    'addToCartUrl' => route('cart.add', $product)
                                ]) }})">
                                            <div
                                    class="relative flex h-48 w-auto cursor-pointer items-center justify-center sm:h-64">
                                    <span class="sr-only">Product Image</span>
                                      <a href="{{ route('product.view', $product->slug) }}"
                                     class="aspect-w-3 aspect-h-2 block overflow-hidden">
                                    <img alt="Razero Wolverine"
                                     class="object-cover rounded-lg hover:scale-105 hover:rotate-1 transition-transform"
                                        :src="product.image"
                                        style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
                                      </a>
                                </div>
                                <header class="p-3 md:p-6">
                                    <div class="mb-2 flex items-center"><span
                                            class="text-sm font-semibold text-heading md:text-base">{{$product->price}}</span></div>
                                    <h3 class="mb-4 cursor-pointer truncate text-xs text-body md:text-sm">{{$product->title}}</h3>
                                    <div><button
                                          @click="addToCart()"
                                            class="group flex h-7 w-full items-center justify-between rounded bg-gray-100 
                                            text-xs text-body-dark transition-colors hover:border-accent hover:bg-primary hover:text-white 
                                            focus:border-accent focus:bg-primary focus:text-white focus:outline-0 md:h-9 md:text-sm"><span
                                                class="flex-1">Add to cart</span>
                                                <span class="grid h-7 w-7 place-items-center bg-gray-200 transition-colors
                                                duration-200 group-hover:bg-primary group-focus:bg-primary
                                                ltr:rounded-tr ltr:rounded-br rtl:rounded-tl rtl:rounded-bl md:h-9 md:w-9">
                                                <i class="fa-solid fa-plus h-4 w-4 stroke-2"></i>
                                                
                                                </span>
                                                </button>
                                                </div>
                                </header>
                            </article>
                              @endforeach
</div>

        {{$products->appends(['sort' => request('sort'), 'search' => request('search')])->links()}}
</div>
</div>
    <?php endif; ?>


    </section>

    
</x-app-layout>
