<template>
  <div class="z-40">
    <div class="flex space-x-8 items-center group p-4">
        <jet-nav-link :href="route('dashboard')"  :active="route().current('dashboard')" >
           <span class="inline-flex">
             <HomeIcon class="w-5 h-5 mr-4" /> Dashboard
           </span> 
        </jet-nav-link>
    </div>
    <div class="flex space-x-8 items-center group p-4">
        <jet-nav-link :href="route('product.pos')"  :active="route().current('product.pos')" >
           <span class="inline-flex">
             <ShoppingCartIcon class="w-5 h-5 mr-4" /> Pos
           </span> 
        </jet-nav-link>
    </div>
    <div class="flex space-x-8 items-center group p-4">
        <jet-nav-link :href="route('product.products')"  :active="route().current('product.products')" >
           <span class="inline-flex">
             <ShoppingBagIcon class="w-5 h-5 mr-4" /> Products
           </span> 
        </jet-nav-link>
    </div>
   
  
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import JetNavLink from '@/Components/NavLink.vue'
import {HomeIcon,ShoppingCartIcon, ShoppingBagIcon} from "@heroicons/vue/24/outline"



</script>
