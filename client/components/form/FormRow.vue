<template>
  <div class="w-full" :class="{'lg:w-3/4': !long}">
    <div class="flex items-center justify-between">
      <label class="flex flex-1 justify-between text-sm font-medium leading-5">
        {{ label }}
        <span v-if="optional" class="text-gray-300 dark:text-gray-500 text-xs italic ml-4"> Optional </span>
        <span v-if="required" class="text-gray-600 dark:text-gray-300 font-semibold text-xs italic ml-4"> Required </span>
      </label>
      <slot v-if="inline" />
    </div>
    <slot v-if="!inline" />
  </div>
</template>

<script lang="ts" setup>
defineProps({
  label: String,
  optional: Boolean,
  required: Boolean,
  long: Boolean,
  inline: Boolean,
})
</script>
