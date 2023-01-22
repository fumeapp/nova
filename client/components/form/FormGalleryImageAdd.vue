<script lang="ts" setup>
import { ToastProps } from 'tailvue'

const emit = defineEmits(['loading', 'add'])
const fileInput = ref<undefined|HTMLInputElement>(undefined)
const trigger = () => fileInput?.value?.click()
const uploading = ref(0)
const handleFileUpload = async (e: Event) => {
  const files = (e.target as HTMLInputElement).files
  if (files) {
    uploading.value = files.length
    emit('loading', uploading.value)
    // loop through the files and upload them one at a time
    for (let i = 0; i < files.length; i++)
      await upload(files[i])

  }
}

const upload = async (file: File) => {
  const data = new FormData()
  data.append('file', file)
  const response = await useApi().store<models.ImageResponse>('/image', data)
  console.log(response)
  useApi().$toast.show(response.data as ToastProps)
  emit('add', response.data.data)
  uploading.value = uploading.value - 1
  emit('loading', uploading.value)
}
</script>

<template>
  <div
    class="flex flex-col border border-2 rounded-xl border-dashed
      border-gray-300 hover:border-gray-500 dark:border-gray-700
      cursor-pointer w-full h-32 flex items-center justify-center"
    @click="trigger"
  >
    <icon icon="mdi:image-plus" class="w-8 h-8" />
    <span>Add Photo</span>
    <!-- accepts only images -->
    <input
      ref="fileInput"
      type="file" class="hidden" multiple
      accept="image/*"
      @change="handleFileUpload"
    >
  </div>
</template>

<style scoped></style>
