<template>
   <AppLayout>
    
      <div class="grid  grid-cols-1 md:grid-cols-[70%_30%] gap-4">
        <div>
            <div class="mt-5 flex flex-row px-4 overflow-x-auto space-x-4">
            <span
              class="px-4 py-2 bg-primary rounded-2xl text-white text-sm mr-4"
            >
              All Categories
            </span>
            <span class="px-4 py-2 rounded-2xl border cursor-pointer border-gray-200 text-gray-700 text-sm font-semibold mr-4"
            v-for="cat in categories" :key="cat.id">
              {{cat.name}}
            </span>
           
           
          </div>
          <div class="grid grid-cols-1 md:grid-cols-3  gap-4 mt-4 px-4">
            <div class="group border-gray-300 flex w-full max-w-xs flex-col self-center overflow-hidden rounded-lg
             border bg-gray-100 mt-2 h-[350px]" v-for="product in products.data" :key="product.id">
        <a class="relative mx-3 mt-3 flex h-60 overflow-hidden rounded-xl" href="#">
          <img class="peer absolute top-0 right-0 h-full w-full object-cover" 
          :src="product.image" :alt="product.name" />
          
        </a>
    <div class="mt-4 px-5 pb-5">
      <a href="#">
        <h5 class="text-md tracking-tight text-gray-600">{{product.name}}</h5>
      </a>
      <div class="mt-2 mb-5 flex items-center justify-between">
        <p>
          <span class="text-sm font-bold text-gray-500">Tsh{{product.selling_price}}</span>
        </p>
      </div>
      <a @click.prevent="addToCart(product)" class="hover:border-white/40 flex items-center justify-center rounded-md
       border border-transparent bg-primary px-5 py-2.5 text-center text-sm font-medium
        text-white focus:outline-none focus:ring-4 focus:ring-blue-300 cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        Add to cart</a
      >
    </div>
          </div>
        
          </div>
        </div>
       
        <div class="bg-white top-0 relative overflow-hidden h-full">
         <h3 class="text-xl font-semibold text-primary items-center justify-center px-2 py-2">Order Details</h3>

          <div class="px-4 py-6 sm:px-8 sm:py-10">
          <div class="flow-root">
            <ul class="-my-8">
              <li class="flex flex-col space-y-3 py-6 text-left border-gray-200 border-b sm:flex-row sm:space-x-5 sm:space-y-0"
              v-for="cart in cartProducts" :key="cart">
                <div class="shrink-0">
                  <img class="h-24 w-24 max-w-full rounded-lg object-cover" 
                  :src="cart.image" alt="" />
                </div>

                <div>
                    <div class="flex justify-between flex-col md:flex-row">
                      <div class="pr-8 sm:pr-5">
                      <p class="text-xs font-semibold text-gray-900">{{cart.name}}</p>
                    </div>
                    <div>
                      <TrashIcon class="text-red-500 w-4 h-4" />
                    </div>
                    </div>
                    
                    <div class="py-2 px-2">
                         <p class="text-sm font-semibold text-gray-700">Tsh {{cart.selling_price}}</p>
                    </div>
                    <div class="mt-4 flex items-center justify-between sm:mt-0 sm:items-start sm:justify-center">
                      <div class="sm:order-1">
                        <div class="mx-auto flex h-8 items-stretch text-gray-600">
                          <button class="flex items-center justify-center rounded-l-md bg-gray-200 px-4 transition hover:bg-black hover:text-white"
                          @click="decreaseQuantity(cart,cartItems[cart.id].quantity)">-</button>
                          <div class="flex w-full items-center justify-center bg-gray-100 px-4 text-xs uppercase transition">{{ cartItems[cart.id].quantity }}</div>
                          <button class="flex items-center justify-center 
                          rounded-r-md bg-gray-200 px-4 transition hover:bg-black hover:text-white"
                          @click="increaseQuantity(cart)">+</button>
                        </div>
                      </div>
                      
                    
                  </div>

                
                </div>
              </li>
            
            
            </ul>
          </div>

          <div class="mt-6  border-b py-2">
            <div class="flex items-center justify-between">
              <p class="text-sm text-gray-400">Subtotal:</p>
              <p class="text-lg font-semibold text-gray-600">{{cartTotal}}</p>
            </div>
            <div class="flex items-center justify-between">
              <label class="text-sm text-gray-400">Discount:</label>
              <CustomInput class="w-1/2 text-right" placeholder="0.00" v-model="discount"/>
            </div>
            <div class="mt-2 text-blue-400 mb-2 items-center">
              <p class="text-sm cursor-pointer" @click="showCustomer()">Add Customer Details</p>
            </div>
            <div class="bg-gray-50 p-4" v-if="customer">
              <form>
                <div class="text-xs text-gray-600 mb-2">
                  <CustomInput  class="w-full" label="Name"/>
                </div>
                <div class="text-xs text-gray-600">
                  <CustomInput  class="w-full" label="Phone Number"/>
                </div>
              </form>
            </div>
          </div>
          <div class="mt-2 mb-2 text-xs bg-blue-50 p-2">
            <div>
                     <CustomInput required type="select" :select-options="paymentOptions"
                      label="Choose Payment Method"/>
                    
                  </div>
          </div>
          <div class="mt-6 flex items-center justify-between">
            <p class="text-sm font-medium text-gray-600">Total</p>
            <p class="text-sm font-semibold text-gray-600"><span class="text-xs font-normal text-gray-400">Tsh</span> {{subTotal}}</p>
          </div>

          <div class="mt-6 text-center">
            <button type="button" class="group inline-flex w-full items-center justify-center rounded-md bg-primary px-2 py-2 
            text-sm font-semibold text-white transition-all duration-200 ease-in-out
             focus:shadow hover:bg-gray-800">
              Submit
              <svg xmlns="http://www.w3.org/2000/svg" class="group-hover:ml-8 ml-4 h-6 w-6 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
              </svg>
            </button>
          </div>
        </div>
        </div>
      </div>
    
  



  </AppLayout>
</template>

<script setup>
import {computed, onMounted, onUpdated, ref} from 'vue'
import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot} from '@headlessui/vue'
import AppLayout from '@/Layouts/AppLayout.vue';
import CustomInput from '@/Shared/CustomInput.vue'
import {PlusIcon, FolderIcon, FunnelIcon, ArrowUpTrayIcon, ClipboardDocumentCheckIcon,TrashIcon} from '@heroicons/vue/24/outline'
import SearchFilter  from '@/Shared/SearchFilter.vue'
import NButton from '@/Shared/NButton.vue'
import NButtonLoading from '@/Shared/NButtonLoading.vue'
import { useForm } from '@inertiajs/vue3';


const customer = ref(false)
const discount = ref(0)
const paymentOptions =  computed(() =>props.paymentMethods.map(c =>({key: c.id, text: c.name,value:c.id})))

function showCustomer(){
  customer.value = ! customer.value
}

const props = defineProps({
paymentMethods:Object, categories:Object,
cartItems:Object, products:Object,total:Number, cartProducts:Object
});


const cartTotal = computed(() => calculateCartTotal(props.cartItems, props.cartProducts));

function calculateCartTotal(cartItems, cartProducts) {
  let total = 0;
  for (const item of Object.values(cartItems)) {
    for (const prod of Object.values(cartProducts)) {
      if (prod.id === item.product_id) {
        if (prod.selling_price && item.quantity) {
          total += prod.selling_price * item.quantity;
        }
      }
    }
  }
  return total.toFixed(2);
}

const subTotal =  computed(() => {
 return cartTotal.value - discount.value; 
})
const form = useForm({
  quantity:1,

})
function addToCart(product){
  const data = useForm({
      quantity:form.quantity,
      product:product
    })
  
  data.post(route('product.addCartItem')),{
        onSuccess:()=>{
          
        },
        onError:()=>{

        }
  }  
}

  function decreaseQuantity(cart,quantity){
    if(quantity > 1){ 
     const data = useForm({
      product:cart,
      quantity:quantity - 1
     })

    data.post(route('product.updateQuantity')),{
        onSuccess:()=>{
          
        },
        onError:()=>{

        }
  }  
    }else{
      alert('Sorry quantity cannot be below 1')
    }

  }

  function increaseQuantity(cart,quantity){
 const data = useForm({
      product:cart,
      quantity:quantity + 1
     })
      data.post(route('product.updateQuantity')),{
        onSuccess:()=>{
          
        },
        onError:()=>{

        }
  }  

  }


</script>

<style>

</style>