<?php
/** @var \Illuminate\Database\Eloquent\Collection $products */
$categoryList = \App\Models\Category::getActiveAsTree();

?>

<x-app-layout>
    <x-category-list :category-list="$categoryList" class="-ml-5 -mt-5 -mr-5 px-4"/>

        <section id="hero" class="mt-4 py-5">
      <!-- Flex Container -->
      <div
        class="container flex flex-col-reverse items-center px-6 mx-auto mt-10 space-y-0 md:space-y-0 md:flex-row"
      >
        <!-- Left item -->
        <div class="flex flex-col mb-32 space-y-12 md:w-1/2">
          <h1
            class="max-w-md text-4xl font-bold text-center md:text-5xl md:text-left"
          >
            Bring everyone together to get better products
          </h1>
          <p class="max-w-sm text-center text-darkGrayishBlue md:text-left">
            Agrono Export makes it easy for business and other customers to order and get their products within early as possible
          </p>
         
        </div>
        <!-- Image -->
        <div class="md:w-1/2">
          <img src="img/illustration-intro.svg" alt="" />
        </div>
      </div>
    </section>


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
            <x-input type="text" name="search" placeholder="Search for the products"
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


    <?php if ( $products->count() === 0 ): ?>
    <div class="text-center text-gray-600 py-16 text-xl">
        There are no products published
    </div>
    <?php else: ?>
    <div
        class="grid gap-4 grig-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 p-3"
    >
        @foreach($products as $product)
            <!-- Product Item -->
            <div
                x-data="productItem({{ json_encode([
                        'id' => $product->id,
                        'slug' => $product->slug,
                        'image' => $product->image ?: '/img/noimage.png',
                        'title' => $product->title,
                        'price' => $product->price,
                        'addToCartUrl' => route('cart.add', $product)
                    ]) }})"
                    class="border border-1 border-gray-200 rounded-md hover:border-purple-600 transition-colors bg-white"
                >
                    <a href="{{ route('product.view', $product->slug) }}"
                       class="aspect-w-3 aspect-h-2 block overflow-hidden">
                        <img
                            :src="product.image"
                            alt=""
                            class="object-cover rounded-lg hover:scale-105 hover:rotate-1 transition-transform"
                        />
                    </a>
                    <div class="p-4">
                        <h3 class="text-lg">
                            <a href="{{ route('product.view', $product->slug) }}">
                                {{$product->title}}
                            </a>
                        </h3>
                        <h5 class="font-bold">${{$product->price}}</h5>
                    </div>
                    <div class="flex justify-between py-3 px-4">
                        <button class="btn-primary" @click="addToCart()">
                            Add to Cart
                        </button>
                    </div>
                </div>
                <!--/ Product Item -->
            @endforeach
        </div>
        {{$products->appends(['sort' => request('sort'), 'search' => request('search')])->links()}}
    <?php endif; ?>
</x-app-layout>
