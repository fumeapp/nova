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
      <form-tag
        v-for="tag in tags"
        :key="tag"
        :tag="tag"
        :remove="remove"
      />
      <input
        v-model="input" type="text" placeholder="Add a tag"
        class="inline bg-transparent border-0 py-0 focus:outline-0 focus:ring-0"
        @keydown.enter="add"
      >
    </div>
  </form-row>
</template>

<style scoped></style>
