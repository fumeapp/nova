<script lang="ts" setup>
defineProps({
  tag: { type: String, required: true },
  remove: { type: Function, required: false },
  })
</script>
<template>
  <span
    class="inline-flex items-center rounded-full m-1
          bg-indigo-100 py-0.5 pl-2.5 pr-1 text-sm font-medium text-indigo-700"
    :class="{'pr-2.5': !remove}"
  >
    {{ tag }}
    <button
      v-if="remove"
      type="button"
      class="ml-0.5 inline-flex h-4 w-4 flex-shrink-0 items-center justify-center rounded-full
            text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500
            focus:bg-indigo-500 focus:text-white focus:outline-none"

      @click="remove ? remove(tag) : null"
    >
      <span class="sr-only">Remove Tag</span>
      <icon icon="mdi:close-bold" class="w-3 h-3" />
    </button>
  </span>
</template>
