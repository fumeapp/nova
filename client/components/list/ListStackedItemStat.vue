<template>
  <div class="flex" :title="stat.label">
    <icon :icon="stat.icon" class="mr-1.5 w-4 h-4 text-gray-600 dark:text-gray-300" />
    <span class="truncate">
      <strong v-if="stat.strong" class="text-gray-700 dark:text-gray-200">{{ stat.value }}</strong>
      <span v-else-if="stat.value === null">..</span>
      <span v-else>{{ stat.value }}</span>
    </span>
  </div>
</template>

<script lang="ts" setup>
import { PropType } from 'vue'

export interface ItemStat {
  label: string
  icon: string
  value: string|number
  strong: boolean
}

defineProps({ stat: Object as PropType<ItemStat> })
</script>
