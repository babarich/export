<x-app-layout>

<div class="container grid grid-cols-2 gap-6 mt-8"
x-data="productItem({{ json_encode([
                    'id' => $product->id,
                    'slug' => $product->slug,
                    'image' => $product->image ?: '/img/noimage.png',
                    'title' => $product->title,
                    'price' => $product->price,
                    'quantity' => $product->quantity,
                    'addToCartUrl' => route('cart.add', $product)
                ]) }})">
                <div
                    x-data="{
                      images: {{$product->images->count() ?
                 $product->images->map(fn($im) => $im->url) : json_encode(['/img/noimage.png'])}},
                      activeImage: null,
                      prev() {
                          let index = this.images.indexOf(this.activeImage);
                          if (index === 0)
                              index = this.images.length;
                          this.activeImage = this.images[index - 1];
                      },
                      next() {
                          let index = this.images.indexOf(this.activeImage);
                          if (index === this.images.length - 1)
                              index = -1;
                          this.activeImage = this.images[index + 1];
                      },
                      init() {
                          this.activeImage = this.images.length > 0 ? this.images[0] : null
                      }
                    }"
                >
                    <div class="relative">
                        <template x-for="image in images">
                            <div
                                x-show="activeImage === image"
                                class="w-full h-[240px] sm:h-[400px] flex items-center justify-center"
                            >
                                <img :src="image" alt="" class="w-auto h-auto max-h-full mx-auto"/>
                            </div>
                        </template>
                        <a
                            @click.prevent="prev"
                            class="cursor-pointer bg-black/30 text-white absolute left-0 top-1/2 -translate-y-1/2"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-10"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 19l-7-7 7-7"
                                />
                            </svg>
                        </a>
                        <a
                            @click.prevent="next"
                            class="cursor-pointer bg-black/30 text-white absolute right-0 top-1/2 -translate-y-1/2"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-10"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 5l7 7-7 7"
                                />
                            </svg>
                        </a>
                    </div>
                    <div class="flex">
                        <template x-for="image in images">
                            <a
                                @click.prevent="activeImage = image"
                                class="cursor-pointer w-[80px] h-[80px] border border-gray-300 hover:border-purple-500 flex items-center justify-center"
                                :class="{'border-purple-600': activeImage === image}"
                            >
                                <img :src="image" alt="" class="w-auto max-auto max-h-full"/>
                            </a>
                        </template>
                    </div>
                </div>
        

        <div>
            <h2 class="text-3xl font-medium uppercase mb-2">{{$product->title}}</h2>
            <div class="flex items-center mb-4">
                <div class="flex gap-1 text-sm text-yellow-400">
                    <span><i class="fa-solid fa-star"></i></span>
                    <span><i class="fa-solid fa-star"></i></span>
                    <span><i class="fa-solid fa-star"></i></span>
                    <span><i class="fa-solid fa-star"></i></span>
                    <span><i class="fa-solid fa-star"></i></span>
                </div>
                <div class="text-xs text-gray-500 ml-3">(150 Reviews)</div>
            </div>
            <div class="space-y-2">
                <p class="text-gray-800 font-semibold space-x-2">
                    <span>Availability: </span>
                    @if ($product->quantity === 0)
                    <span class="text-red-600">Out Of Stock</span>
                    @else
                        <span class="text-green-600">In Stock</span>
                    @endif
                    
                </p>
                
                <p class="space-x-2">
                    <span class="text-gray-800 font-semibold">Category: </span>
                    <span class="text-gray-600">{{isset($product->categories) ? implode(',', $product->categories->pluck('name')->toArray())  : 'N/A'}}</span>
                </p>
                
            </div>
            <div class="flex items-baseline mb-1 space-x-2 font-roboto mt-4">
                <p class="text-xl text-primary font-semibold">{{$product->price}}</p>

            </div>

          

           <div x-data="{ quantity: 1 }">
    <div class="mt-4">
        <h3 class="text-sm text-gray-800 uppercase mb-1">Quantity</h3>
        <div class="flex border border-gray-300 text-gray-600 divide-x divide-gray-300 w-max">
            <div class="flex items-center space-x-2">
                <!-- Decrease Button -->
                <button 
                    type="button" 
                    @click="if (quantity > 1) quantity--" 
                    class="px-3 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                    -
                </button>

                <!-- Quantity Input -->
                <input 
                    type="number" 
                    name="quantity" 
                    x-model="quantity" 
                    min="1"
                    class="w-16 text-center border rounded focus:border-purple-500 focus:outline-none" />

                <!-- Increase Button -->
                <button 
                    type="button" 
                    @click="quantity++" 
                    class="px-3 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                    +
                </button>
            </div>
        </div>
    </div>

    <div class="mt-6 flex gap-3 border-b border-gray-200 pb-5 pt-5">
        <button 
            :disabled="product.quantity === 0"
            @click="addToCart(quantity)" 
            :class="product.quantity === 0 ? 'cursor-not-allowed' : 'cursor-pointer'"
            class="bg-primary border border-primary text-white px-8 py-2 font-medium rounded uppercase flex items-center gap-2 hover:bg-transparent hover:text-primary transition">
            <i class="fa-solid fa-bag-shopping"></i> Add to cart
        </button>
    </div>
</div>


            
        </div>
    </div>
    <!-- ./product-detail -->

    <!-- description -->
    <div class="container pb-16 mt-4">
        <h3 class="border-b border-gray-200  text-gray-800 pb-3 font-medium">Product details</h3>
        <div x-data="{activeTab: 'info'}" class="product_view_tabs">
                <div class="flex gap-2 border-b mb-4">
                    <div @click="activeTab='info'" :class="{'!border-primary !text-primary' : activeTab ==='info' }" class="border px-1 sm:px-4 py-2 rounded text-xs sm:text-base cursor-pointer rounded-b-none border-[#2B2D42] border-b-0 !border-primary !text-primary">
                        Product Info</div>
                    <div @click="activeTab='question'" :class="{'!border-primary !text-primary' : activeTab ==='question' }" class="border px-1 sm:px-4 py-2 rounded text-xs sm:text-base cursor-pointer rounded-b-none border-[#2B2D42] border-b-0">
                        Question &amp; Answer</div>
                    <div @click="activeTab='review'" :class="{'!border-primary !text-primary' : activeTab ==='review' }" class="border px-1 sm:px-4 py-2 rounded text-xs sm:text-base cursor-pointer rounded-b-none border-[#2B2D42] border-b-0">
                        Review (10)</div>
                </div>
                 <div x-show="activeTab==='info'" class="max-w-[800px]" style="">
                    <div class="w-3/5 pt-6">
                                <div class="text-gray-600">
                                    <p>{{$product->description}}</p>
                                
                                </div>

                            
                            </div>
                 </div>
                 <div x-show="activeTab==='question'" class="mt-6" style="display: none;">
                    <h4>Question about this product </h4>
                        <div class="mt-6">
                            @foreach ($questions as $question)
                               <div class="flex items-center gap-4 mb-6 border-b pb-5">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 256 256">
                                    <path fill="currentColor" d="M230.2 213a118.3 118.3 0 0 0-70.5-54.6a70 70 0 1 0-63.4 0A118.3 118.3 0 0 0 25.8 213a5.9 5.9 0 0 0 2.2 8.2a6 6 0 0 0 8.2-2.2a106 106 0 0 1 183.6 0a6 6 0 0 0 5.2 3a6.4 6.4 0 0 0 3-.8a5.9 5.9 0 0 0 2.2-8.2ZM70 96a58 58 0 1 1 58 58a58 58 0 0 1-58-58Z"></path>
                                </svg>
                            </div>
                            <div class="pbqna_content">
                                <h5>{{$question->question}}</h5>
                                <p class="text-sm">{{$question->name  }}. - {{\Carbon\Carbon::parse($question->created_at)->format('d M Y')}}</p>
                            </div>
                        </div> 
                            @endforeach
                            
                        <form action="{{route('question.store', $product->id)  }}" method="POST">
                            @csrf
                            <input class="w-full md:w-1/2 mb-3 p-3 border focus:border-primary focus:ring-0 rounded" name="name" required placeholder="Enter Name" />
                            <textarea placeholder="Type your question" name="question" class="w-full md:w-1/2 p-5 border focus:border-primary focus:ring-0 rounded" required></textarea><br/>
                            <button class="bg-primary border border-primary text-white px-8 py-3 font-medium 
                                 rounded-md hover:bg-transparent hover:text-primary">Ask Question</button>
                        </form>
                    </div>
                 </div>
                 <div x-show="activeTab==='review'" class="mt-6" style="display: none;">


                 </div>

            </div>
        
    </div>

     <!-- related product -->
    <div class="container pb-16">
        <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">Related products</h2>
        <div class="grid grid-cols-4 gap-6">
        @foreach ($products as $prod)
        
           <article class="h-full transform overflow-hidden rounded border border-border-200 bg-white shadow-sm transition-all
            duration-200 hover:-translate-y-0.5 hover:shadow"
                x-data="productItem({{ json_encode([
                                    'id' => $prod->id,
                                    'slug' => $prod->slug,
                                    'image' => $prod->image ?: '/img/noimage.png',
                                    'title' => $prod->title,
                                    'price' => $prod->price,
                                    'addToCartUrl' => route('cart.add', $prod)
                                ]) }})">
                                            <div
                                    class="relative flex h-48 w-auto cursor-pointer items-center justify-center sm:h-64">
                                    <span class="sr-only">Product Image</span>
                                      <a href="{{ route('product.view', $prod->slug) }}"
                                     class="aspect-w-3 aspect-h-2 block overflow-hidden">
                                    <img 
                                     class="object-cover rounded-lg hover:scale-105 hover:rotate-1 transition-transform"
                                        src="{{ asset($prod->image ?: '/img/noimage.png') }}" alt="{{ $prod->title }}"
                                        style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
                                      </a>
                                </div>
                                <header class="p-3 md:p-6">
                                    <div class="mb-2 flex items-center"><span
                                            class="text-sm font-semibold text-heading md:text-base">{{$prod->price}}</span></div>
                                    <h3 class="mb-4 cursor-pointer truncate text-xs text-body md:text-sm">{{$prod->title}}</h3>
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
    </div>
    <!-- ./related product -->

    
  
</x-app-layout>
