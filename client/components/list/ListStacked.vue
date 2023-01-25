<template>
  <div class="bg-white dark:bg-gray-800 dark:border dark:border-gray-700 overflow-hidden sm:rounded-md" :class="{'shadow': !noShadow}">
    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
      <slot />
    </ul>
  </div>
</template>

<script lang="ts" setup>
defineProps({ noShadow: Boolean })
</script>
