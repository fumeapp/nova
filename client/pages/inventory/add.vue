<script lang="ts" setup>
import { PushButtonState, ToastProps } from 'tailvue'

useCrumbs().set([
  { name: 'Inventory', to: '/inventory', icon: 'mdi:archive' },
  { name: 'Add an Item', icon: 'mdi:archive-plus' },
])

const state = ref<PushButtonState>('active')

const item = ref<models.Item>({} as models.Item)

const loading = ref(0)
const setLoading = (num: number) => {
  state.value = 'loading'
  loading.value = num
}

const tags = ref<string[]>([])

const images = ref<models.Image[]>([])
const addImage = (image: models.Image ): void => {
  images.value.push(image)
  loading.value--
  if (loading.value === 0) state.value = 'active'
  // update tags.value with a unique list from key name inside mage.labels array
  tags.value = Array.from(new Set(images.value.flatMap(i => i.labels.map(l => l.name))))
}

const destroyImage = async (image: models.Image): Promise<void> => {
  const response = await useApi().delete<models.ImageResponse>(`/image/${image.id}`)
  useApi().$toast.show(response.data as ToastProps)
  images.value = images.value.filter(i => i.id !== image.id)
}

const add = async() => {
  item.value.images = images.value
  const response = await useApi().store<models.ItemResponse>('/item', item.value)
}

</script>

<template>
  <form-two-column description="Add photos, a title, tags, and a description" title="Adding inventory.">
    <form-border>
      <div class="grid grid-cols-2 gap-4 md:grid-cols-3 mt-6">
        <div v-for="image in images" :key="image.id" class="h-32 border border-2 border-def overflow-hidden rounded-xl relative group">
          <img :src="image.url" alt="image" class="w-full h-full object-cover">
          <div
            class="
            absolute top-1 right-1 p-1
            bg-gray-900/20 group-hover:bg-gray-900/80 transition-colors duration-100
            w-6 h-6 flex items-center justify-center rounded-full"
            @click="destroyImage(image)"
          >
            <icon icon="mdi:close" class="w-full h-full text-gray-300" />
          </div>
        </div>
        <div v-for="i in loading" :key="i" class="border border-2 border-def h-32 rounded-lg bg-gray-800 flex-center">
          <icon icon="eos-icons:three-dots-loading" class="w-14 h-14 text-swatch3" />
        </div>
        <form-gallery-image-add @loading="setLoading" @add="addImage" />
      </div>
      <form-input
        v-model="item.title" label="Title" required
        class="mt-6"
      />
      <div class="w-full lg:w-3/4 mt-6">
        <div class="flex items-center justify-between">
          <label class="flex flex-1 justify-between text-sm font-medium leading-5">Tags</label>
        </div>
        <div class="rounded-md shadow-sm flex mt-2">
          <pre> {{ tags }}</pre>
          <!--<input type="text" class="form-input rounded-md block w-full sm:text-sm sm:leading-5 dark:bg-gray-700">-->
        </div>
      </div>
      <form-input
        v-model="item.description" label="Description" required
        type="textarea"
        class="mt-6"
      />
    </form-border>

    <form-submit-column
      back="/inventory"
      label="Add Item"
      :state="state"
      ico="mdi:archive-plus"
      @click="add"
    />
  </form-two-column>
</template>
