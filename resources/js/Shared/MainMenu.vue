<template>
  <div class="">
    <div class="flex flex-col  pt-6 pb-3">
          <div class="pb-5 text-xs font-semibold  tracking-[0.05em]  text-gray-500">Menu
          </div>
          <div class="space-y-2">
              <jet-nav-link title="Dashboard"
                 class="group flex w-full items-center gap-2.5 rounded-md px-4
                  py-2.5 text-md text-gray-300 text-start focus:text-primary hover:bg-gray-100 font-medium"
                            :href="route('dashboard')"  :active="route().current('dashboard')"><span class="transition gray-300"></span><Square2StackIcon class="w-5 h-5"/>
                  <span>Dashboard</span>
              </jet-nav-link>
          </div>
      </div>
        <div class="flex flex-col  pt-6 pb-3">
          <div class="pb-5 text-xs font-semibold  tracking-[0.05em]  text-gray-500">Product Management
          </div>
          <div class="space-y-2 py-1.5" >
              <jet-nav-link class="group flex w-full items-center gap-2.5 rounded-md px-4
                  py-2.5 text-md text-gray-300 text-start focus:text-primary hover:bg-gray-100 font-medium" :href="route('categories.index')" :active="route().current('categories.index')">
                  <i class="pi pi-clone flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"></i>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap">Categories</span>
              </jet-nav-link>
          </div>

          <div class="space-y-2 py-1.5">
              <jet-nav-link class="group flex w-full items-center gap-2.5 rounded-md px-4
                  py-2.5 text-md text-gray-300 text-start focus:text-primary hover:bg-gray-100 font-medium" :href="route('product.index')" :active="route().current('product.index')">
                  <i class="pi pi-shopping-cart flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"></i>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap">Products</span>
              </jet-nav-link>
          </div>
           <div class="space-y-2 py-1.5">
              <jet-nav-link class="group flex w-full items-center gap-2.5 rounded-md px-4
                  py-2.5 text-md text-gray-300 text-start focus:text-primary hover:bg-gray-100 font-medium" :href="route('product.category')" :active="route().current('product.category')">
                  <i class="pi pi-box flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"></i>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap">Orders</span>
              </jet-nav-link>
          </div>
        </div>

         <div class="flex flex-col  pt-6 pb-3">
          <div class="pb-5 text-xs font-semibold  tracking-[0.05em]  text-gray-500">User Management
          </div>
          <div class="space-y-2 py-1.5" >
              <jet-nav-link class="group flex w-full items-center gap-2.5 rounded-md px-4
                  py-2.5 text-md text-gray-300 text-start focus:text-primary hover:bg-gray-100 font-medium" :href="route('product.category')" :active="route().current('product.category')">
                  <i class="pi pi-user flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"></i>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap">Users</span>
              </jet-nav-link>
          </div>

          <div class="space-y-2 py-1.5">
              <jet-nav-link class="group flex w-full items-center gap-2.5 rounded-md px-4
                  py-2.5 text-md text-gray-300 text-start focus:text-primary hover:bg-gray-100 font-medium" :href="route('product.category')" :active="route().current('product.category')">
                  <i class="pi pi-users flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"></i>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap">Customers</span>
              </jet-nav-link>
          </div>
           <div class="space-y-2 py-1.5">
              <jet-nav-link class="group flex w-full items-center gap-2.5 rounded-md px-4
                  py-2.5 text-md text-gray-300 text-start focus:text-primary hover:bg-gray-100 font-medium" :href="route('product.category')" :active="route().current('product.category')">
                  <i class="pi pi-chart-bar flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"></i>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap">Reports</span>
              </jet-nav-link>
          </div>
        </div>

        <div class="flex flex-col  pt-6 pb-3">
          <div class="pb-5 text-xs font-semibold  tracking-[0.05em]  text-gray-500">Settings
          </div>
          <div class="space-y-2 py-1.5" >
              <jet-nav-link class="group flex w-full items-center gap-2.5 rounded-md px-4
                  py-2.5 text-md text-gray-300 text-start focus:text-primary hover:bg-gray-100 font-medium" :href="route('banner.index')" :active="route().current('banner.index')">
                  <i class="pi pi-image flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"></i>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap">Banners</span>
              </jet-nav-link>
          </div>

        </div>

   
   
  
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import JetNavLink from '@/Components/NavLink.vue'
import {HomeIcon,ShoppingCartIcon, ShoppingBagIcon, Square2StackIcon} from "@heroicons/vue/24/outline"



</script>
