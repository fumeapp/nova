<script lang="ts" setup>
import { useDark, useToggle } from '@vueuse/core'
import { AnimationItem } from 'lottie-web'
const isDark = useDark()
const toggleDark = useToggle((isDark))
const props = defineProps({
  id: {
    type: String,
    required: false,
    default: 'darkModeIcon',
  },
})
let animation: undefined | AnimationItem = undefined
if (getCurrentInstance())
  onMounted(() => {
    if (!process.client || !window.lottie) return
    animation = window.lottie.loadAnimation({
      container: document.getElementById(props.id) as Element,
      path: '/json/darkMode.json',
      loop: false,
      autoplay: false,
    })
    if (isDark.value === true) animation.goToAndStop(114, true)
    else animation.goToAndStop(0, true)
  })
const toggle = () => {
  if (!animation) return
  if (isDark.value === true) animation.playSegments([160, 228], true)
  else animation.playSegments([0, 114], true)
  setTimeout(toggleDark, 200)
}
defineExpose({ toggle })
</script>

<template>
  <button
    type="button" class="flex items-center justify-center rounded-full focus:outline-none" aria-label="Dark Mode Toggle"
    @click="toggle"
  >
    <span
      :id="id"
      class="w-8 h-8 -mr-1.5"
    />
  </button>
</template>
