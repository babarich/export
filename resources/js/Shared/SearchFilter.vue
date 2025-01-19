<template>
  <div class="flex items-center">
    <input type="text" class="w-50 border-gray-300 rounded-full" autocomplete="off" name="search"
    :placeholder="'Search...'"  :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"/>
  </div>
</template>

<script>
export default {
props:{
modelValue:String,
placeholder:String,
maxWidth:{
    type:Number,
    default:300
},
},
emits:['update:modelValue']   
}

</script>

<style>

</style>