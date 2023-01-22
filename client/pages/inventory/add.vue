<script lang="ts" setup>
useCrumbs().set([
  { name: 'Inventory', to: '/inventory', icon: 'mdi:archive' },
  { name: 'Add an Item', icon: 'mdi:archive-plus' },
])

const loading = ref(0)
const setLoading = (num: number) => loading.value = num

const images = ref<models.Image[]>([])
const addImage = (image: models.Image ): void => {
  images.value.push(image)
}

</script>

<template>
  <div class="p-2 lg:p-0">
    <form-two-column title="Upload Images" description="Start by uploading some pictures of the item">
      <div class="grid grid-cols-2 gap-4 md:grid-cols-3 mt-6">
        <div v-for="i in loading" :key="i" class="border border-2 border-def h-32 rounded-lg bg-gray-800 flex-center">
          <icon icon="eos-icons:three-dots-loading" class="w-14 h-14 text-swatch3" />
        </div>
        <div v-for="image in images" :key="image.id" class="h-32 border border-2 border-def overflow-hidden rounded-xl relative group">
          <img :src="image.url" alt="image" class="w-full h-full object-cover">
          <div
            class="
            absolute top-1 right-1 p-1
            bg-gray-900/20 group-hover:bg-gray-900/80 transition-colors duration-100
            w-6 h-6 flex items-center justify-center rounded-full"
          >
            <icon icon="mdi:close" class="w-full h-full text-gray-300" />
          </div>
        </div>
        <form-gallery-image-add @loading="setLoading" @add="addImage" />
      </div>
    </form-two-column>
  </div>
</template>
