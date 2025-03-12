<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { UserIcon } from "@heroicons/vue/24/outline";
import DoughnutChart from "../Components/Core/Charts/Doughnut.vue";
import Spinner from "../Components/Core/Spinner.vue";
import CustomInput from "../Components/Core/CustomInput.vue";

import {computed, onMounted, ref} from "vue";

const props = defineProps({
    customersCount:Number,productsCount:Number,
    paidOrders:Number,totalIncome:Number,ordersByCountry:Object,latestCustomers:Object,
    latestOrders:Object
})



const loading = ref({
    customersCount: true,
    productsCount: true,
    paidOrders: true,
    totalIncome: true,
    ordersByCountry: true,
    latestCustomers: true,
    latestOrders: true,
  });

 

  const dateOptions = [
    { key: "1d", text: "Last Day" },
    { key: "1w", text: "Last Week" },
    { key: "2w", text: "Last 2 Weeks" },
    { key: "1m", text: "Last Month" },
    { key: "3m", text: "Last 3 Months" },
    { key: "6m", text: "Last 6 Months" },
    { key: "all", text: "All Time" },
  ];


  const chosenDate = ref("all");



// Fetch data on component mount

</script>

<template>
  <AppLayout>
    <div class="p-6">
      <!-- Date Picker -->
      <div class="flex flex-col md:flex-row justify-between mb-6">

       <div>

       </div>
       <div class="justify-end">
        <CustomInput
        v-model="chosenDate"
        :options="dateOptions"
        @change="onDatePickerChange"
      />
       </div>
      </div>
      

      <!-- Dashboard Metrics -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
       
          <div
              class="flex h-full w-full flex-col rounded-sm border border-b-4 border-border-200 bg-white p-5 md:p-6" >
              <div class="mb-auto flex w-full items-center justify-between">
                  <div
                      class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-primary  me-3">
                      <i class="pi pi-clock  text-2xl text-white text-center"></i>
                  </div>
                  <div class="flex w-full flex-col text-end"><span
                      class="mb-1 text-base font-normal text-body">Customers</span><span
                      class="mb-2 text-2xl font-semibold text-heading">{{customersCount}}</span></div>
              </div>
          </div>
        

      
        <div
            class="flex h-full w-full flex-col rounded-sm border border-b-4 border-border-200 bg-white p-5 md:p-6" >
            <div class="mb-auto flex w-full items-center justify-between">
                <div
                    class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-red-500  me-3">
                    <i class="pi pi-calendar-minus  text-2xl text-white text-center"></i>
                </div>
                <div class="flex w-full flex-col text-end"><span
                    class="mb-1 text-base font-normal text-body">Products </span><span
                    class="mb-2 text-2xl font-semibold text-heading">{{productsCount}}</span></div>
            </div>
        </div>
       
      
                    

         <div class="flex h-full w-full flex-col rounded-sm border border-b-4 border-border-200 bg-white p-5 md:p-6 border-b-color[rgb(215, 78, 255)]">
                        <div class="mb-auto flex w-full items-center justify-between">
                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-emerald-600  me-3">
                                <i class="pi pi-calendar-plus  text-2xl text-white text-center"></i>
                            </div>
                            <div class="flex w-full flex-col text-end"><span
                                class="mb-1 text-base font-normal text-body">Paid Orders </span><span
                                class="mb-2 text-2xl font-semibold text-heading">{{paidOrders}}</span></div>
                        </div>
                    </div>
       
        
        <div
                        class="flex h-full w-full flex-col rounded-sm border border-b-4 border-border-200 bg-white p-5 md:p-6">

                        <div class="mb-auto flex w-full items-center justify-between">
                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-primary  me-3">
                                <i class="pi pi-box  text-2xl text-white text-center"></i>
                            </div>
                            <div class="flex w-full flex-col text-end"><span
                                class="mb-1 text-base font-normal text-body">Total Income</span><span
                                class="mb-2 text-2xl font-semibold text-heading">{{totalIncome}}</span></div>
                        </div>
                    </div>
        
      </div>

      <!-- Orders by Country Chart
      <div class="mt-6">
        <DoughnutChart
          
          :chart-data="ordersByCountry"
        />
        
      </div> -->

      <!-- Latest Customers -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
       <div class="rounded bg-white p-5 shadow md:p-8 w-full mt-8">
           <h3 class="text-lg text-primary mb-3">Latest Customers</h3>
            <div class="bg-white overflow-x-auto">
                <table class="w-full text-sm whitespace-nowrap">
                    <thead class="sticky top-0">
                    <tr>
                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            S/N
                        </th>


                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            Full Name
                        </th>

                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            Phone
                        </th>
                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            Email
                        </th>

                       

                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            Created At
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr  class="odd:bg-gray-100 focus-within:bg-gray-100"
                    v-for="(customer, index) in latestCustomers.data" :key="index">
                        <td class="py-4 px-4 text-sm text-left border">
                            {{index + 1}}
                        </td>
                        <td class="py-4 px-4 text-sm text-left border">{{customer.first_name + ' ' + customer.last_name}}</td>
                        <td class="py-4 px-4 text-sm text-left border">{{customer.phone}}</td>
                        <td class="py-4 px-4 text-sm text-left border text-wrap">{{customer.email}}</td>
                         
                          <td class="py-4 px-4 text-sm text-left border text-wrap">{{customer.created_at}}</td>

                        
                    </tr>
                    <tr v-if=" latestCustomers.data.length === 0">
                        <td colspan="12" class="py-4 px-4 text-sm text-left border">
                            <div class="flex flex-col items-center py-7">
                                <img src="/images/empty.svg" class="w-32 h-32"/>
                                <div class="mb-1 pt-6 text-base font-semibold text-heading">No data found</div>
                                <p class="text-[13px]">Sorry we couldn’t found any data</p>
                            </div>
                        </td>
                    </tr>
                    </tbody>

                </table>
            </div>

        </div>


      <div class="rounded bg-white p-5 shadow md:p-8 w-full mt-8">
           <h3 class="text-lg text-primary mb-3">Latest Customers</h3>
            <div class="bg-white overflow-x-auto">
                <table class="w-full text-sm whitespace-nowrap">
                    <thead class="sticky top-0">
                    <tr>
                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            S/N
                        </th>


                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            Full Name
                        </th>

                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            Phone
                        </th>

                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            Status
                        </th>

                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            Created At
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr  class="odd:bg-gray-100 focus-within:bg-gray-100"
                    v-for="(customer, index) in latestCustomers.data" :key="index">
                        <td class="py-4 px-4 text-sm text-left border">
                            {{index + 1}}
                        </td>
                        <td class="py-4 px-4 text-sm text-left border">{{customer.first_name + '' + customer.last_name}}</td>
                        <td class="py-4 px-4 text-sm text-left border">{{customer.phone_number}}</td>
                        <td class="py-4 px-4 text-sm text-left border text-wrap">{{customer.email}}</td>
                         <td class="py-4 px-4 text-sm text-left border text-wrap">{{customer.status}}</td>
                          <td class="py-4 px-4 text-sm text-left border text-wrap">{{customer.created_at}}</td>

                        
                    </tr>
                    <tr v-if=" latestCustomers.data.length === 0">
                        <td colspan="12" class="py-4 px-4 text-sm text-left border">
                            <div class="flex flex-col items-center py-7">
                                <img src="/images/empty.svg" class="w-32 h-32"/>
                                <div class="mb-1 pt-6 text-base font-semibold text-heading">No data found</div>
                                <p class="text-[13px]">Sorry we couldn’t found any data</p>
                            </div>
                        </td>
                    </tr>
                    </tbody>

                </table>
            </div>

        </div>

      </div>

     
    </div>
  </AppLayout>
</template>