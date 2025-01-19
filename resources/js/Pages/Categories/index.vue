<template>
   <AppLayout>
    
    <div class="flex justify-between mb-6">
        <div class="mt-2">
            <h3 class="text-xl text-primary text-semibold">Categories</h3>
        </div>
        <div>
            <NButton @click="showModal()">
            <PlusIcon class="w-4 h-4  mr-2"/>  Add Category
            </NButton>
          
        </div>
    </div>
    <div class="mt-4 mb-3 flex flex-col md:flex-row items-center justify-between">
        <div>
         <search-filter
         v-model="search"
         class="mr-4 w-full max-w-md mb-3">
         </search-filter>
        </div>

        <div class="flex items-center space-x-2 divide-x">
            <a :href="route('product.products')" class="px-4 text-sm flex text-gray-700">
              <ClipboardDocumentCheckIcon class="w-4 h-4 mr-2"/>  products
            </a>
            <button class="px-4 text-sm flex text-gray-700">
              <ArrowUpTrayIcon class="w-4 h-4 mr-2"/>  Export
            </button>
            <button class="px-4 text-sm flex text-gray-700">
               <FunnelIcon class="w-4 h-4 mr-2"/> Filter
            </button>
        </div>
    </div>

    <div class="bg-white relative overflow-x-auto mt-4">
        <table class="w-full text-sm whitespace-nowrap">
            <thead class="sticky top-0">
                <tr>
               <th
                scope="col"
                class="py-4 px-4 border text-xs text-left whitespacenowrap font-semibold">
                   S/N
                </th>     
               <th
                scope="col"
                class="py-4 px-4 border text-xs text-left whitespacenowrap font-semibold">
                   Name
                </th>     
               <th
                scope="col"
                class="py-4 px-4 border text-xs text-left whitespacenowrap font-semibold">
                     Action
                </th>     
                
                </tr>
                
            </thead>
            <tbody>
                <tr class="odd:bg-gray-100 focus-within:bg-gray-100" v-for="(cat, index) in categories.data" :key="cat.id">
                  <td class="py-4 px-4 text-sm text-left border">
                    {{index + 1}}
                  </td>
                  <td class="py-4 px-4 text-sm text-left border">
                    {{cat.name}}
                  </td>
                  <td class="py-4 px-4 text-sm text-left border">
                     edit
                  </td>
                 
                </tr>
                <tr>
                  <td class="py-4 px-4 text-sm text-center border"
                  colspan="3" v-if="categories.data.length === 0">
                    No categories found
                  </td>
                </tr>
            </tbody>
        </table>
    </div>



    <TransitionRoot appear as="template" :show="show">
    <Dialog as="div" class="relative z-40" @close="show = false">
      <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100"
                       leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-black bg-opacity-70 transition-opacity"/>
      </TransitionChild>

      <div class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
          <TransitionChild as="template" enter="ease-out duration-300"
                           enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                           enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200"
                           leave-from="opacity-100 translate-y-0 sm:scale-100"
                           leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <DialogPanel
              class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-[700px] sm:w-full">

              <header class="py-3 px-4 flex justify-between items-center">
                <DialogTitle as="h3" class="text-lg leading-6 font-medium text-primary">
                 Create New Category
                </DialogTitle>
                <button
                  @click="closeModal()"
                  class="w-8 h-8 flex items-center justify-center rounded-full transition-colors cursor-pointer hover:bg-[rgba(0,0,0,0.2)]"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"
                    />
                  </svg>
                </button>
              </header>
              <form  @submit.prevent="onSubmit">
                <div class="bg-white px-4 pt-5 pb-4">
                  <div>
                    <CustomInput class="mb-2" label="Category Name" v-model="category.name"/>
                    <span class="text-sm text-red-500" v-if="errors.name">{{errors.name[0]}}</span>
                  </div>
                  
                 
                
                </div>
                <footer class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                   <NButtonLoading :loading="loading" class="mt-3 w-full inline-flex justify-center  shadow-sm px-4 py-2  text-base font-medium text-gray-700 
                    focus:outline-none focus:ring-2 
                    focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Submit
                   </NButtonLoading>
                  <button type="button"
                          class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white 
                          text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none
                           focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                          @click="closeModal" ref="cancelButtonRef">
                    Cancel
                  </button>
                </footer>
              </form>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
  </AppLayout>
</template>

<script setup>
import {computed, onMounted, onUpdated, ref} from 'vue'
import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot} from '@headlessui/vue'
import AppLayout from '@/Layouts/AppLayout.vue';
import CustomInput from '@/Shared/CustomInput.vue'
import {PlusIcon, FolderIcon, FunnelIcon, ArrowUpTrayIcon, ClipboardDocumentCheckIcon} from '@heroicons/vue/24/outline'
import SearchFilter  from '@/Shared/SearchFilter.vue'
import NButton from '@/Shared/NButton.vue'
import NButtonLoading from '@/Shared/NButtonLoading.vue'
import { useForm } from '@inertiajs/vue3';

const show = ref(false)




const category = useForm({
  name: null,
  business_unit_id:1
})

const errors = ref({})
const loading = ref(false)

function showModal(){
    show.value = true
}

onMounted(()=>{
    
})

function closeModal(){
    show.value = false
}

function clearInput(){
  category.reset()
}
const props = defineProps({
    categories:Object,
    errors:Object
})

const search = ref('')

function onSubmit(){
loading.value = true

category.post(route('product.categoryStore'),{
  onSuccess:()=>{
    loading.value= false
    closeModal();
    clearInput()
  },
  onError:()=>{
    loading.value= false
  }
})

}

</script>

<style>

</style>