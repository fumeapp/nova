<script lang="ts" setup>
import { PushButton, PushButtonState } from 'tailvue'

interface SignedUrl {
  signed: string
  key: string
  url: string
}

const { $api, $modal } = useNuxtApp()

const props = defineProps({
  label: String,
  ico: String,
  modelValue: String,
  optional: Boolean,
  large: Boolean,
  removable: Boolean,
})

const url = ref<string|undefined>(props.modelValue)
const state = ref<PushButtonState>('active')
const emit = defineEmits(['update:modelValue', 'state', 'uploaded'])
const input = ref<undefined|HTMLInputElement>(undefined)
const progress = ref(0)
const noUrlTrigger = () => {
  if (!url.value) trigger()
}
const trigger = () => {
  if (input.value) input.value.click()
}
const change =  async (event: Event & { target: EventTarget & { files: FileList }}): Promise<void> =>
  await upload(event.target.files[0])

const upload = async (file: File): Promise<void> => {

  const result = (await $api.get<SignedUrl>('/signed-url', {type: file.type})).data
  stateUpdate('loading')
  progress.value = 1
  const xhr = new XMLHttpRequest()
  xhr.open('PUT', result.signed, true)
  xhr.upload.onprogress = (event: ProgressEvent) =>
      progress.value = Math.round(event.loaded / event.total * 100)
  xhr.onload = () => {
    if (xhr.status === 200) {
      url.value = result.url
      emit('update:modelValue', result.url)
      emit('uploaded', true)
      stateUpdate('active')
      progress.value = 0
    }
  }
  xhr.send(file)
}

const stateUpdate = (update: PushButtonState) => {
  state.value = update
  emit('state', update)
}

const remove = (): void => {
  $modal.show({
    type: 'danger',
    title: 'Remove image',
    body: 'Are you sure you want to remove this image?',
    primary: {
      label: 'Remove',
      theme: 'red',
      action: () => {
        url.value = ''
        emit('update:modelValue', '')
      },
    },
    secondary: {
      label: 'Cancel',
    },
  })
}
</script>


<template>
  <div class="w-full lg:w-3/4">
    <label class="block text-sm leading-5 font-medium">
      {{ label }}
      <span v-if="optional" class="text-gray-500 text-xs italic ml-4"> Optional </span>
    </label>
    <div class="mt-2 flex items-center" :class="{'flex-col': props.large}">
      <div
        v-if="props.large"
        class="w-32 h-32 overflow-hidden bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center"
        @click="noUrlTrigger"
      >
        <icon
          v-if="!url"
          :icon="ico"
          class="w-12 h-12 p-3 text-gray-400"
        />
        <img
          v-else :src="url" :alt="label"
          class="object-cover w-full h-full"
        >
      </div>
      <div v-else class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100 dark:bg-gray-700">
        <div v-if="state !== 'active'" class="w-12 h-12" />
        <icon
          v-else-if="!url"
          :icon="ico"
          class="w-12 h-12 p-3 text-gray-400"
        />
        <img
          v-else :src="url" :alt="label"
          class="w-12 h-12 object-cover"
        >
      </div>
      <div class="flex items-center justify-center" :class="{'py-4': props.large}">
        <push-button
          :state="state"
          @click="trigger"
        >
          <icon
            :icon="state === 'loading' ? 'gg:spinner' : 'bx:bx-cloud-upload'"
            class="w-4 h-4 mr-1.5"
            :class="{'animate-spin text-emerald-400': state === 'loading', 'text-gray-400': state !== 'loading'}"
          />
          Upload
        </push-button>
        <button v-if="props.removable" @click="remove">
          <icon icon="mdi-close" class="w-4 h-4" />
        </button>
        <input
          ref="input" type="file" class="hidden"
          accept="image/*" @change="change"
        >
      </div>
    </div>
    <p
      class="mt-2 text-sm leading-5 relative transition-all duration-100 overflow-hidden"
      :class="{'skeleton rounded-full': progress > 0}"
    >
      <transition-fade-in>
        <span v-if="progress === 0" key="text"> Square images look best; PNG, JPEG, or GIF up to 10MB </span>
        <span v-else key="blank">&nbsp;</span>
      </transition-fade-in>
      <span
        v-if="progress > 0"
        class="absolute inset-0 bg-gradient-to-r from-logo-a to-logo-b transition-all duration-200 rounded-full"
        :style="`width: ${progress}%`"
      />
    </p>
  </div>
</template>
