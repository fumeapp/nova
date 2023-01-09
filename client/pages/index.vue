<script setup lang="ts">
import { PushButton } from 'tailvue'
const { setCrumbs } = useCrumbs()
setCrumbs([ { name: 'Home', to: '/' }])
</script>

<template>
  <div class="mx-auto container p-2 lg:p-8 flex flex-col">
    this is pages/index.vue
  </div>
</template>
