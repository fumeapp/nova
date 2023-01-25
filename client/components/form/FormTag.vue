<script lang="ts" setup>
import { emit } from 'process'
import { PropType } from 'vue'
const props = defineProps({
  label: String,
  long: Boolean,
  optional: Boolean,
  required: Boolean,
  tags: Array as PropType<string[]>,
})
const emit = defineEmits(['update'])

const input = ref('')

// remove a tag from the props.tags array and emit the new tag list
const remove = (tag: string) => {
  const tags = props?.tags?.filter((t) => t !== tag)
  emit('update', tags)
}


const add = () => {
  if (input.value === '') return
  const tags = props?.tags?.concat(input.value).filter((v, i, a) => a.indexOf(v) === i)
  emit('update', tags)
  input.value = ''
}
</script>

<template>
  <form-row
    :label="label" :long="long" :optional="optional"
    :required="required"
  >
    <div class="mt-2 flex flex-wrap form-input rounded-md block w-full sm:text-sm sm:leading-5 dark:bg-gray-700 p-2">
      <span
        v-for="tag in tags"
        :key="tag"
        class="inline-flex items-center rounded-full m-1
          bg-indigo-100 py-0.5 pl-2.5 pr-1 text-sm font-medium text-indigo-700"
      >
        {{ tag }}
        <button
          type="button"
          class="ml-0.5 inline-flex h-4 w-4 flex-shrink-0 items-center justify-center rounded-full
            text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500
            focus:bg-indigo-500 focus:text-white focus:outline-none border-red-300 outline-red-300 ring-red-400"
          @click="remove(tag)"
        >
          <span class="sr-only">Remove Tag</span>
          <icon name="mdi:close-bold" class="w-3 h-3" />
        </button>
      </span>
      <input
        v-model="input" type="text" placeholder="Add a tag"
        class="inline bg-transparent border-0 py-0 focus:outline-0 focus:ring-0"
        @keydown.enter="add"
      >
    </div>
  </form-row>
</template>

<style scoped></style>
