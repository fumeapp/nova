<script lang="ts">
import { useDark } from '@vueuse/core'
definePageMeta({layout: 'blank'})
const isDark = useDark()
</script>

<template>
  <div class="flex flex-col items-center space-y-8 w-full">
    <img src="/nova.png" class="w-32 h-32 rounded-lg" alt="Nova Logo">
    <login-form :destroyed="() => {}" class="w-full max-w-md" />
  </div>
</template>
