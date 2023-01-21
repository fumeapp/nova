<script lang="ts" setup>
import { PropType } from 'vue'
defineProps({
  border: Boolean as PropType<boolean>,
  title: String as PropType<string>,
  description: String as PropType<string>,
})
</script>

<template>
  <div class="max-w-4xl flex-1 w-full">
    <div v-if="border" class="hidden sm:block">
      <div class="py-5">
        <div class="border-t border-gray-200 dark:border-gray-600" />
      </div>
    </div>
    <div :class="border ? 'mt-10 sm:mt-0' : ''">
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
          <div class="px-4">
            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-200">
              {{ title }}
            </h3>
            <p class="mt-1 text-sm leading-5 text-gray-500 dark:text-gray-400">
              {{ description }}
            </p>
          </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
          <slot />
        </div>
      </div>
    </div>
  </div>
</template>
