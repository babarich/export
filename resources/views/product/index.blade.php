<?php
/** @var \Illuminate\Database\Eloquent\Collection $products */
$categoryList = \App\Models\Category::getActiveAsTree();

?>

<x-app-layout>

        <x-category-list :category-list="$categoryList" class="-ml-5 -mt-5 -mr-5 px-4"/>

        <section id="hero" class="mt-4 py-5">
      <!-- Flex Container -->
      
<!-- Slider main container -->
            <div class="swiper banner-swiper">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    @foreach ($banners as $banner)
                        <div class="swiper-slide flex items-center bg-no-repeat bg-cover bg-center min-h-[520px]"
                       style="background-image: url('{{ $banner->url }}');">

                        <div class="container">
                            <div class="lg:flex flex-wrap">
                                <div class="w-full lg:w-1/2">
                                   <div>
                                        <h1
                                            class="text-[38px] md:text-[56px] lg:text-5xl xl:text-[56px] leading-[42px] md:leading-[64px] lg:leading-[48px] xl:leading-[64px] font-medium mb-2 sm:mb-4 text-gray-800">
                                        Bring everyone together to get better products
                                        </h1>
                                        <p class="text-gray-700 text-base mb-2 sm:mb-4">
                                            Mikese Export make it easy  for business and other customers to order and get their products within early as possible
                                        </p>
                                        <div class="mt-[30px] md:mt-[40px]">
                                            <a href="{{route('product.list')  }}" class="bg-primary border border-primary text-white px-8 py-3 font-medium 
                                                rounded-md hover:bg-transparent hover:text-primary">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    

                    
                </div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev hidden xl:block collection-banner"></div>
                <div class="swiper-button-next hidden xl:block collection-banner"></div>

                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>
            </div>
      <!-- End swiper -->
    
    </section>

     
    <div class="container py-16">
        <div class="w-11/12 grid grid-cols-1 md:grid-cols-3 gap-6 mx-auto justify-center">
            <div class="border border-primary rounded-sm px-3 py-6 flex justify-center items-center gap-5">
                <img src="assets/images/icons/fast.svg" alt="Delivery" class="w-12 h-12 object-contain">
                <div>
                    <h4 class="font-medium capitalize text-lg">Fast Delivery</h4>
                    <p class="text-gray-500 text-sm">Order now to deliver</p>
                </div>
            </div>
            <div class="border border-primary rounded-sm px-3 py-6 flex justify-center items-center gap-5">
                <img src="assets/images/icons/sell.svg" alt="Delivery" class="w-12 h-12 object-contain">
                <div>
                    <h4 class="font-medium capitalize text-lg">Sell Products</h4>
                    <p class="text-gray-500 text-sm">Easily sell products</p>
                </div>
            </div>
            <div class="border border-primary rounded-sm px-3 py-6 flex justify-center items-center gap-5">
                <img src="assets/images/icons/support.svg" alt="Delivery" class="w-12 h-12 object-contain">
                <div>
                    <h4 class="font-medium capitalize text-lg">24/7 Support</h4>
                    <p class="text-gray-500 text-sm">Customer support</p>
                </div>
            </div>
        </div>
    </div>
    

    <div class="container pb-14">
        <h2 class="text-[28px] text-primary font-semibold mb-6">SHOP BY CATEGORY</h2>
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-2">
            @foreach ($cats as $cat)
                <div class="col-span-1 overflow-hidden">
                <a href="{{ route('byCategory', $cat) }}"
                    class="group h-[150px] sm:h-[250px] flex items-center justify-center relative bg-cover bg-no-repeat 
                    bg-center after:absolute after:inset-0 after:bg-[#00000060] after:content-['']"
                    style="background-image: url({{ $cat->url }});">
                    <div class="flex items-center relative z-10">
                        <h4 class="text-xl leading-6 text-white font-medium">{{$cat->name}}</h4>
                        <div
                            class="text-white opacity-0 group-hover:opacity-100 group-hover:ml-2 transition-all duration-300">
                            <svg width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M13.3 17.275q-.3-.3-.288-.725q.013-.425.313-.725L16.15 13H5q-.425 0-.713-.288Q4 12.425 4 12t.287-.713Q4.575 11 5 11h11.15L13.3 8.15q-.3-.3-.3-.713q0-.412.3-.712t.713-.3q.412 0 .712.3L19.3 11.3q.15.15.213.325q.062.175.062.375t-.062.375q-.063.175-.213.325l-4.6 4.6q-.275.275-.687.275q-.413 0-.713-.3Z" />
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            

           
        </div>
    </div>

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
            
            <p class="text-primary text-lg font-semibold">RECOMENDED FOR YOU</p>

        </div>
        </div>

    </div>
    </section>
    
    <section class="w-11/12 container">
      <?php if ($products->count() === 0 ): ?>
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
<div class="flex justify-center mt-8 mb-4 sm:mb-6 lg:mb-2 lg:mt-12">
    <a href="{{route('product.list')}}" class="inline-flex items-center justify-center shrink-0  
    leading-none rounded outline-none transition duration-300 ease-in-out focus:outline-0 focus:shadow 
    ocus:ring-1 focus:ring-yellow-600 bg-secondary text-white border border-transparent hover:bg-yellow-600 px-5 py-0 
    h-12 text-sm font-semibold  md:text-base">View All Products <i class="fa fa-arrow-right ml-2"></i></a>
</div>
</div>
</div>
    <?php endif; ?>


    </section>

    
</x-app-layout>
