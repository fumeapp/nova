<script lang="ts" setup>
useCrumbs().set([
  { name: 'Inventory', to: '/inventory', icon: 'mdi:archive' },
  { name: 'Add an Item', icon: 'mdi:archive-plus' },
])
</script>

<template>
  <form-two-column title="Upload Images" description="Start by uploading some pictures of the item">
    <div class="flex flex-col border border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-xl w-full h-32 flex items-center justify-center">
      <icon icon="mdi:cloud-upload" class="w-8 h-8 text-gray-300 dark:text-gray-500" />
      <span>Upload Images</span>
    </div>
  </form-two-column>
</template>
