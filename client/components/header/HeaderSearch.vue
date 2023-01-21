<script lang="ts" setup>
import { PushButton } from 'tailvue'
const { $toast }  = useNuxtApp()
const uc = () => $toast.info('Feature is currently under construction')
</script>

<template>
  <div class="ml-4">
    <push-button size="s" @click="uc">
      <icon icon="mdi:magnify" class="w-6 h-6 -my-1 mr-2.5" />
      <span class="mr-2.5">Search</span>
      <span class="text-gray-300 dark:text-gray-500">
        ⌘K
      </span>
    </push-button>
  </div>
</template>

<style scoped></style>
