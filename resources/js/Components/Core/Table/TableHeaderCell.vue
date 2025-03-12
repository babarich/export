<template>
  <th @click="emit('click')" class="py-4 px-4 border text-xs text-left whitespace-nowrap font-semibold cursor-pointer"
    :class="field=== sortField ? 'bg-blue-50' : ''" scope="col">
    <div class="flex justify-between">
      <slot></slot>
       <div v-if="field !== sortField">
            <i class="pi pi-sort-alt text-gray-400 ml-3"></i>
        </div>
        <div v-else>
            <div v-if="sortField === field" class="ml-2">
                <span v-if="sortDirection === 'asc'">
                    <i class="pi pi-sort-amount-up text-primary"></i>
                </span>
                <span v-else>
                    <i class="pi pi-sort-amount-down text-tertiary"></i>
                </span>
            </div>
        </div>

     
    </div>
  </th>
</template>

<script setup>

const {field, sortField, sortDirection} = defineProps({
  field: String,
  sortField: String,
  sortDirection: String
})

const emit = defineEmits(['click'])

</script>

<style scoped>

</style>
