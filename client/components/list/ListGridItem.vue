<template>
  <router-link v-if="props.to" :to="props.to" :class="linkClass">
    <slot />
  </router-link>
  <div v-else :class="linkClass">
    <slot />
  </div>
</template>


<script lang="ts" setup>
const props = defineProps({ to: String })
const linkClass = 'relative md:rounded-lg overflow-hidden border-t border-b sm:border-l sm:border-r border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-sm hover:border-gray-400 dark:hover:border-gray-600'
</script>
