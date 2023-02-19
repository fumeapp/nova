<script lang="ts" setup>
import { PropType } from 'vue'
import { FormSelectOptionInterface } from '@/types/portal'
const props = defineProps({
  choose: {
    type: Function,
    required: true,
  },
  option: {
    type: Object as PropType<FormSelectOptionInterface>,
    required: true,
  },
  value: [Number, String] as PropType<string | number>,
})
const is_current = computed((): boolean => props.value === props.option.value)
</script>
<template>
  <li
    id="listbox-option-0"
    :key="option.value"
    class="cursor-pointer text-gray-900 select-none relative py-2 pl-3 pr-9 dark:text-gray-300 hover:text-white hover:bg-emerald-600 group"
    role="option"
    @click="choose(option)"
  >
    <div>
      <span
        class="block truncate flex items-center"
        :class="{'font-semibold': is_current, 'font-normal': !is_current}"
      >
        <layout-image-initials
          v-if="option.initials" :image="option.image" :initials="option.initials"
          class="w-6 h-6 mr-2.5"
        />
        {{ option.name }}
      </span>

      <span class="text-emerald-600 absolute inset-y-0 right-0 flex items-center pr-4">
        <icon
          v-if="is_current"
          name="ic:sharp-verified"
          class="w-4 h-4 text-emerald-400 group-hover:text-white"
        />
      </span>
    </div>
    <div v-if="option.tip" class="text-xs text-gray-500 dark:text-gray-400 group-hover:text-gray-200">
      {{ option.tip }}
    </div>
  </li>
</template>
