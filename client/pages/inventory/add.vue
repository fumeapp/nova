<script lang="ts" setup>
useCrumbs().set([
  { name: 'Inventory', to: '/inventory', icon: 'mdi:archive' },
  { name: 'Add an Item', icon: 'mdi:archive-plus' },
])

const fileInput = ref<undefined|HTMLInputElement>(undefined)

// prompt to upload a file
const trigger = () => fileInput?.value?.click()

const handleFileUpload = (e: Event) => {
  const files = (e.target as HTMLInputElement).files
  if (files)
    // do something with the files
    console.log(files)

}
</script>

<template>
  <div class="p-2 lg:p-0">
    <form-two-column title="Upload Images" description="Start by uploading some pictures of the item">
      <div
        class="flex flex-col border border-2 rounded-xl border-dashed
      border-gray-300 hover:border-gray-500 dark:border-gray-700
      cursor-pointer w-full h-32 flex items-center justify-center"
        @click="trigger"
      >
        <icon icon="mdi:cloud-upload" class="w-8 h-8 text-gray-300 dark:text-gray-500" />
        <span>Upload Images</span>
        <!-- accepts only images -->
        <input
          ref="fileInput"
          type="file" class="hidden" multiple
          accept="image/*"
          @change="handleFileUpload"
        >
      </div>
    </form-two-column>
  </div>
</template>
