<template>
   <AppLayout>
    
    <div class="flex justify-between mb-6">
        <div class="mt-2">
            <h3 class="text-xl text-primary text-bold">Banners List</h3>
        </div>
        <div>
            <NButton @click="showModal()">
            <PlusIcon class="w-4 h-4  mr-2"/>  Add Banner
            </NButton>
          
        </div>
    </div>

    <div class="rounded bg-white p-5 shadow md:p-8 w-full">


            <div class="mt-4 mb-3 flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center space-x-2 divide-x">
                  
                    <button class="px-4 text-sm flex text-gray-100 bg-secondary p-2 rounded">
                        <FunnelIcon class="w-4 h-4 mr-2"/> Filter
                    </button>
                </div>
                <div>
                    <search-filter
                        v-model="search"
                        class="mr-4 w-full max-w-md mb-3">
                    </search-filter>
                </div>
            </div>

    
 <Toast />
 <ConfirmPopup group="positionDialog"></ConfirmPopup>
    <div class="bg-white relative overflow-x-auto mt-4">
        <table class="w-full text-sm whitespace-nowrap">
            <thead class="sticky top-0">
                <tr>
               <th
                scope="col"
                class="py-4 px-4 border text-xs text-left whitespacenowrap font-semibold">
                   S/N
                </th>   
                 
              <TableHeaderCell field="image" :sort-field="sortField" :sort-direction="sortDirection">
                Image
              </TableHeaderCell>
              
              <TableHeaderCell field="updated_at" :sort-field="sortField" :sort-direction="sortDirection"
                              @click="sortProducts('updated_at')">
                Last Updated At
              </TableHeaderCell>
              <TableHeaderCell field="status">
                Status
              </TableHeaderCell>
              
              <TableHeaderCell field="actions">
                Actions
              </TableHeaderCell>  
                     
                </tr>
                
            </thead>
            <tbody>
                <tr class="odd:bg-gray-100 focus-within:bg-gray-100"
                v-for="(banner, index) in banners.data" :key="banner.id">
              
                
                  <td class="py-4 px-4 text-sm text-left border">
                    {{index + 1}}
                  </td>
                  <td class="py-4 px-4 text-sm text-left border">
                     <img v-if="banner.image_url" class="w-16 h-16 object-cover" :src="banner.image_url" alt="Banner">
                     <img v-else class="w-16 h-16 object-cover" src="/assets/images/empty.svg">
                   
                  </td>
                  
                 
                  <td class="py-4 px-4 text-sm text-left border">
                    {{banner.updated_at}}
                  </td>
                 
                  <td class="py-4 px-4 text-sm text-left border">
                     <span class="bg-emerald-500 text-white p-2 rounded-md text-xs" v-if="banner.active">
                            Active
                        </span>
                        <span class="bg-red-500 text-white p-2 rounded-md text-xs" v-else>
                            In-Active
                     </span>
                    
                  </td>
                  <td class="py-4 px-4 text-sm text-left border">
                      <div class="flex justify-between flex-col md:flex-row items-center cursor-pointer">
                         <div class="flex items-center space-x-2 divide-x">
                             <a   class="px-4 text-sm flex text-gray-100 bg-emerald-600 p-2 rounded">
                                 <i class="pi pi-eye text-white"></i>
                             </a>
                             <a class="px-4 text-sm flex text-gray-100 bg-secondary p-2 rounded">
                                 <i class="pi pi-pencil text-white"></i>
                             </a>

                             <button @click.prevent="confirm2()"  class="px-4 text-sm flex text-gray-100 bg-red-500 p-2 rounded">
                                 <i class="pi pi-trash text-white"></i>
                             </button>
                         </div>



                     </div>
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
                 Create New Banner
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
                    <CustomInput type="checkbox" class="mb-2" v-model="banner.active" label="active" :errors="errors['active']"/>
                  </div>
                    
                  <div>
              <label class="block text-sm font-medium text-gray-700 mb-3 mt-4">
                  Upload Banner Images
              </label>
            
            <image-preview v-model="banner.images"
                                  :images="banner.images"
                                  v-model:deleted-images="banner.deleted_images"
                                  v-model:image-positions="banner.image_positions"/>
                            </div>
                          
                 
                
                </div>
                <footer class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                   <NButtonLoading :loading="loading" class="mt-3 w-full inline-flex justify-center 
                    shadow-sm px-4 py-2  text-base font-medium text-gray-700 
                     focus:outline-none focus:ring-2 focus:ring-offset-2
                      focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
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
    </div>

  </AppLayout>
</template>

<script setup>
import {computed, onMounted, onUpdated, ref} from 'vue'
import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot} from '@headlessui/vue'
import {Inertia} from "@inertiajs/inertia";
import AppLayout from '@/Layouts/AppLayout.vue';
import CustomInput from '@/Shared/CustomInput.vue'
import FileUpload from "primevue/fileupload";
import {PlusIcon, FolderIcon, FunnelIcon, ArrowUpTrayIcon, ClipboardDocumentCheckIcon,DocumentArrowDownIcon} from '@heroicons/vue/24/outline'
import SearchFilter  from '@/Shared/SearchFilter.vue'
import NButton from '@/Shared/NButton.vue'
import NButtonLoading from '@/Shared/NButtonLoading.vue'
import ImagePreview from '../../Components/ImagePreview.vue'
import TableHeaderCell from '../../Components/Core/Table/TableHeaderCell.vue'
import Treeselect from 'vue3-treeselect'
import 'vue3-treeselect/dist/vue3-treeselect.css'
import { useForm } from '@inertiajs/vue3';
import { useConfirm } from "primevue/useconfirm";
import { useToast } from "primevue/usetoast";

const show = ref(false)


const sortField = ref('updated_at');
const sortDirection = ref('desc');

const confirm = useConfirm();
const toast = useToast();



const banner = useForm({
  categories: [],
  images: [],
  deleted_images: [],
  image_positions: {},
  active: false
 
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
  banner.reset()
}

const props = defineProps({
    banners:Object, errors:Object
})

const search = ref('')

function onSubmit(){
loading.value = true
banner.post(route('banner.store'),{
onSuccess:()=>{
  closeModal()
  clearInput()
  loading.value = false
},
onError:()=>{
  loading.value = false
}
})
}

function sortProducts(field){
    if (field === sortField.value){
        if (sortDirection.value === 'desc'){
            sortDirection.value = 'asc';
        }else {
            sortDirection.value = 'desc'
        }
    }else {
        sortField.value = field;
        sortDirection.value = 'asc'
    }

    Inertia.get(
        route("banner.index"),
        {sort_field:sortField.value,sort_direction:sortDirection.value},{
            preserveState:true,
            replace:true
        }
    )

}
function confirmDelete(id){
    confirm.require({
        group:'positionDialog',
        message: 'Do you want to delete this record?',
        icon: 'pi pi-exclamation-triangle',
        position:'top',
        accept: () => {
            toast.add({ severity: 'info', summary: 'Confirmed', detail: 'Record deleted', life: 3000 });
        },
        reject: () => {
            toast.add({ severity: 'error', summary: 'Rejected', detail: 'You have rejected', life: 3000 });
        }
    });
}

</script>

<style>

</style>