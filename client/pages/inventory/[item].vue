<script lang="ts" setup>
import { PushButtonState, ToastProps } from 'tailvue'

const adding = computed(() => useRoute().params.item === 'add')

if (process.client)  {
  const app = useNuxtApp()
  // add initMap as a global function
  app.vueApp.provide('initMap', () => console.log('fuck this'))
}
const state = ref<PushButtonState>('active')
const item = ref<models.Item>({} as models.Item)
const location = ref<undefined|google.maps.places.PlaceResult>(undefined)
const tags = ref<string[]>([])
const updateTags = (updated: string[]) => tags.value = updated
const images = ref<models.Image[]>([])

const get = async() => {
  const response = await useApi().get<models.ItemResult>(`/item/${useRoute().params.item}`)
  item.value = response.data
  tags.value = item.value.tags.map(t => t.name)
  images.value = item.value.images
}

if (!adding.value) await get()

useCrumbs().set([
  { name: 'Inventory', to: '/inventory', icon: 'mdi:archive' },
  { name: adding.value ? 'Add an Item' : item.value.title, icon: 'mdi:archive-plus' },
])

const loading = ref(0)
const setLoading = (num: number) => {
  state.value = 'loading'
  loading.value = num
}
const addImage = (image: models.Image ): void => {
  images.value.push(image)
  loading.value--
  if (loading.value === 0) state.value = 'active'
  if (adding) tags.value = Array.from(new Set(images.value.flatMap(i => i.labels.map(l => l.name))))
}

const destroyImage = async (image: models.Image): Promise<void> => {
  const response = await useApi().delete<models.ImageResponse>(`/image/${image.id}`)
  useApi().$toast.show(response.data as ToastProps)
  images.value = images.value.filter(i => i.id !== image.id)
}

const add = async() => {
  const response = await useApi().store<models.ItemResponse>('/item', {
    ...item.value,
    images: images.value.map(i => i.id),
    tags: tags.value,
    location: location.value,
  })
  useApi().$toast.show(response.data as ToastProps)

  if (response.data.success)
    useRouter().push('/inventory')
}
const update = async() => {
  const response = await useApi().update<models.ItemResponse>(`/item/${item.value.id}`, {
    ...item.value,
    images: images.value.map(i => i.id),
    tags: tags.value,
  })
  useApi().$toast.show(response.data as ToastProps)

  if (response.data.success)
    useRouter().push('/inventory')
}

const description = computed(() => adding.value ? 'Add photos, a title, tags, and a description' : 'Update photos, a title, tags, and a description')
const title = computed(() => adding.value ? 'Adding inventory.' : 'Updating inventory.')

</script>

<template>
  <form-two-column v-if="item" :description="description" :title="title">
    <div class="grid grid-cols-2 gap-4 md:grid-cols-3 mb-6 px-2 lg:px-0">
      <div v-for="image in images" :key="image.id" class="h-32 border border-2 border-def overflow-hidden rounded-xl relative group">
        <img :src="image.url" alt="image" class="w-full h-full object-cover">
        <div
          class="
            absolute top-1 right-1 p-1 cursor-pointer
            bg-gray-900/20 group-hover:bg-gray-900/80 transition-colors duration-100
            w-6 h-6 flex items-center justify-center rounded-full"
          @click="destroyImage(image)"
        >
          <icon name="mdi:close" class="w-full h-full text-gray-300" />
        </div>
      </div>
      <div v-for="i in loading" :key="i" class="border border-2 border-def h-32 rounded-lg bg-gray-800 flex-center">
        <icon name="eos-icons:three-dots-loading" class="w-14 h-14 text-swatch3" />
      </div>
      <form-gallery-image-add @loading="setLoading" @add="addImage" />
    </div>
    <form-border>
      <client-only>
        <form-input-location
          v-model="location" label="Location" required
        />
      </client-only>
      <form-input
        v-model="item.title" label="Title" required
        class="mt-6"
      />
      <form-tags
        class="mt-6" :tags="tags" label="Tags"
        @update="updateTags"
      />
      <form-input
        v-model="item.description" label="Description" required
        type="textarea"
        class="mt-6"
      />
      <template #submit>
        <form-submit-column
          back="/inventory"
          :label="`${adding ? 'Add' : 'Update'} an Item`"
          :state="state"
          ico="mdi:archive-plus"
          @click="adding ? add() : update()"
        />
      </template>
    </form-border>
  </form-two-column>
</template>
