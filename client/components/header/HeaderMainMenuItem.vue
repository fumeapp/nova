<script lang="ts" setup>
import { PropType } from 'vue'
import { MenuItem } from '@/types/frontend'
defineProps({item: { type: Object as PropType<MenuItem>, required: true }, mobile: Boolean})
const emit = defineEmits(['click'])
const { isCurrent } = useMenu(useApi())
</script>

<template>
  <nuxt-link
    :key="item.name"
    :to="item.to"
    class="px-2  lg:px-0flex-shrink-0 inline-flex items-center justify-start h-14 lg:rounded-lg space-x-4 relative group"
    :class="{
      'bg-gray-300 dark:bg-gray-700 dark:text-white': isCurrent(item),
      'text-gray-400 hover:bg-gray-300 dark:hover:bg-gray-700': !isCurrent(item),
      'w-14 justify-center': !mobile
    }"
    @click="emit('click')"
  >
    <icon
      v-if="item.icon"
      :name="item.icon"
      class="w-6 h-6"
      :class="isCurrent(item) ? 'text-logo-b' : 'text-gray-400'"
    />
    <span :class="{'sr-only': !mobile}"> {{ item.name }}</span>
    <div
      class="hidden lg:flex flex-col items-start justify-center absolute left-0 transition-transform duration-200 ease-out transform-gpu opacity-0 translate-x-0 group-hover:translate-x-8 group-hover:opacity-100 z-0 group-hover:z-20 h-14 p-4 rounded-r-lg"
      :class="{
        'bg-gray-300 dark:bg-gray-700': isCurrent(item),
        'text-gray-800 dark:text-gray-200 bg-gray-300 dark:bg-gray-700': !isCurrent(item),
      }"
    >
      <span class="whitespace-nowrap"> {{ item.name }} </span>
      <span class="text-xs whitespace-nowrap text-gray-500 dark:text-gray-400"> {{ item.label }} </span>
    </div>
  </nuxt-link>
</template>

<style scoped></style>
