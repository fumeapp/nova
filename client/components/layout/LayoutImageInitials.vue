<script lang="ts" setup>
const props = defineProps({
  image: String,
  initials: String,
  cls: String,
})

const colors = [
  ['from-pink-400', 'to-pink-500'], ['from-rose-400', 'to-rose-500'], ['from-red-400', 'to-red-500'],
  ['from-orange-400', 'to-orange-500'], ['from-yellow-400', 'to-yellow-500'], ['from-amber-400', 'to-amber-500'],
  ['from-lime-400', 'to-lime-500'], ['from-green-400', 'to-green-500'], ['from-teal-400', 'to-teal-500'],
  ['from-cyan-400', 'to-cyan-500'], ['from-light-blue-400', 'to-light-blue-500'], ['from-blue-400', 'to-blue-500'],
  ['from-indigo-400', 'to-indigo-500'], ['from-purple-400', 'to-purple-500'], ['from-violet-400', 'to-violet-500'],
  ['from-fuchsia-400', 'to-fuchsia-500'],
]

const color = (pos: number): string => {
  if (props.initials === undefined) return ['from-gray-400', 'to-gray-500'][pos]
  const index = Math.abs(Math.round((props.initials[pos].charCodeAt(0) - 65) * colors.length / 26))
  return colors[index][pos]
}
</script>

<template>
  <div class="rounded-full overflow-hidden">
    <img
      v-if="image" class="object-cover w-full h-full bg-gray-100 dark:bg-gray-600"
      :src="image" alt="Avatar or Logo"
    >
    <div
      v-else
      class="text-white flex items-center justify-center font-medium bg-gradient-to-r w-full h-full"
      :class="[color(0), color(1)]"
    >
      <span class="p-1" :class="cls"> {{ initials }} </span>
    </div>
  </div>
</template>

