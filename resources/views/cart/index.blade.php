<x-app-layout>
    <div class="container pb-10">
        <h1 class="text-3xl font-bold mb-6">Your Cart Items</h1>
        
        <div class="grid grid-cols-12 gap-6 bg-white shadow-sm p-4"
        x-data="{
            cartItems: {{
                json_encode(
                    $products->map(fn($product) => [
                        'id' => $product->id,
                        'slug' => $product->slug,
                        'image' => $product->image ?: '/img/noimage.png',
                        'title' => $product->title,
                        'price' => $product->price,
                        'quantity' => $cartItems[$product->id]['quantity'],
                        'href' => route('product.view', $product->slug),
                        'removeUrl' => route('cart.remove', $product),
                        'updateQuantityUrl' => route('cart.update-quantity', $product)
                    ])
                )
            }},
            get cartTotal() {
                return this.cartItems.reduce((accum, next) => accum + next.price * next.quantity, 0).toFixed(2)
            },
        }">
        
        <template x-if="cartItems.length">
                <div class="col-span-12 lg:col-span-9">
                    <!-- Product Item -->
                    <template x-for="product of cartItems" :key="product.id">
                        <div x-data="productItem(product)">
                            <div
                                class="w-full flex flex-col sm:flex-row items-center gap-4 flex-1">
                                <a :href="product.href"
                                   class="w-36 h-32 flex items-center justify-center overflow-hidden">
                                    <img :src="product.image" class="object-cover" alt=""/>
                                </a>
                                <div class="flex flex-col justify-between flex-1">
                                    <div class="flex justify-between mb-3">
                                        <h3 x-text="product.title"></h3>
                                        <span class="text-lg font-semibold">
                                            <span x-text="product.price"></span>
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center">
                                            Qty:
                                            <input
                                                type="number"
                                                min="1"
                                                x-model="product.quantity"
                                                @change="changeQuantity()"
                                                class="ml-3 py-1 border-gray-200 focus:border-purple-600 focus:ring-purple-600 w-16"
                                            />
                                        </div>
                                        <a
                                            href="#"
                                            @click.prevent="removeItemFromCart()"
                                            class="text-red-600 hover:text-red-500">
                                        <svg width="20" height="20" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M7 21q-.825 0-1.412-.587Q5 19.825 5 19V6q-.425 0-.713-.287Q4 5.425 4 5t.287-.713Q4.575 4 5 4h4q0-.425.288-.713Q9.575 3 10 3h4q.425 0 .713.287Q15 3.575 15 4h4q.425 0 .712.287Q20 4.575 20 5t-.288.713Q19.425 6 19 6v13q0 .825-.587 1.413Q17.825 21 17 21ZM7 6v13h10V6Zm2 10q0 .425.288.712Q9.575 17 10 17t.713-.288Q11 16.425 11 16V9q0-.425-.287-.713Q10.425 8 10 8t-.712.287Q9 8.575 9 9Zm4 0q0 .425.288.712q.287.288.712.288t.713-.288Q15 16.425 15 16V9q0-.425-.287-.713Q14.425 8 14 8t-.712.287Q13 8.575 13 9ZM7 6v13V6Z"></path>
                                    </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--/ Product Item -->
                            <hr class="my-5"/>
                        </div>
                    </template>
                    <!-- Product Item -->

                </div>
                <!--/ Product Items -->
            </template>
            <template x-if="!cartItems.length">
                <div class="text-center py-8 text-gray-500">
                    You don't have any items in cart
                </div>
            </template>
            

            <div class="col-span-12 lg:col-span-3 border p-4">
                <div>
                    <h4 class="uppercase text-lg">Order Summary</h4>
                    <div class="space-y-2 border-b pb-3 mt-2">
                        <div class="flex justify-between">
                            <p class="font-medium">Subtotal</p>
                            <span id="cartTotal" class="text-xl" x-text="`${cartTotal}`"></span>
                        </div>
                        
                    </div>
                   
                    <div class="mt-8">
                        <form action="{{route('cart.checkout')}}" method="post">
                            @csrf
                            <button type="submit" class="block w-full px-8 lg:px-2 xl:px-8 py-2 text-center bg-primary hover:bg-transparent text-white hover:text-primary hover:border-primary border transition duration-300 rounded-lg uppercase text-sm">
                                Proceed to Checkout
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
