<script lang="ts" setup>
import { PropType } from 'vue'
import { onClickOutside } from '@vueuse/core'
import { FormSelectOptions, FormSelectOptionInterface } from '@/types/frontend'
const emit = defineEmits(['choose', 'update:modelValue'])

const props = defineProps({
  options: {
    type: Array as PropType<FormSelectOptions>,
    required: true,
  },
  modelValue: {
    type: [Number, String] as PropType<string|number>,
    required: false,
    default: undefined,
  },
  placeholder: {
    type: String,
    required: false,
    default: 'Please choose an option',
  },
  short: {
    type: Boolean,
    required: false,
    default: false,
  },
  discreet: {
    type: Boolean,
    required: false,
    default: false,
  },
  light: Boolean,
})

const outside = ref(null)
const active = ref(false)
const direction = ref<'up'|'down'>('down')

const current = computed((): string|undefined => {
  if (!props.modelValue) return props.placeholder
  return props.options.find((o: FormSelectOptionInterface) => o.value === props.modelValue)?.name
})

const currentOption = computed((): FormSelectOptionInterface[] => {
  return props.options.filter(o => o.value === props.modelValue)
})

const off = () => active.value = false
const toggle = () => active.value = !active.value

onClickOutside(outside, off)

const choose = (option: FormSelectOptionInterface) => {
  if (props.modelValue === undefined) direction.value = 'down'
  else {
    const prevIndex = props.options.findIndex(o => o.value === props.modelValue)
    const nextIndex = props.options.findIndex(o => o.value === option.value)
    if (prevIndex > nextIndex) direction.value = 'up'
    else direction.value = 'down'
  }
  emit('update:modelValue', option.value)
  emit('choose', option.value)
  off()
}
</script>

<template>
  <div>
    <div class="relative">
      <button
        type="button"
        aria-labelledby="listbox-label"
        aria-haspopup="listbox"
        class="cursor-pointer bg-white relative w-full border rounded-md shadow-sm pl-3 pr-10 text-left focus:outline-none focus:ring-1 focus:ring-brand-blue focus:border-brand-blue sm:text-sm"
        :class="{'py-1': short, 'py-2': !short, 'border-transparent hover:border-gray-300 dark:hover:border-gray-600 ': discreet, 'border-gray-300 dark:border-gray-600 ': !discreet, 'dark:bg-gray-700': light, 'dark:bg-gray-800': !light }"
        aria-expanded="true"
        @click="toggle"
      >
        <transition-group
          tag="ol"
          class="relative h-6 -mb-1"
          enter-active-class="transition ease-in duration-200"
          :enter-from-class="direction === 'down' ? 'translate-y-2 transform opacity-0' : '-translate-y-2 transform opacity-0'"
          enter-to-class="transform translate-y-0 opacity-100"
          leave-active-class="ease-out duration-200"
          leave-from-class="transform translate-y-0 opacity-100"
          :leave-to-class="direction === 'down' ? '-translate-y-2 transform opacity-0' : 'translate-y-2 transform opacity-0'"
        >
          <li v-if="modelValue === undefined" key="placeholder" class="absolute inset-0">
            <span class="flex items-center">
              <span class="w-6 h-6 mr-2.6">&nbsp;</span>
              {{ current }}
            </span>
          </li>
          <li v-for="option in currentOption" :key="option.name" class="absolute inset-0">
            <span class="flex items-center">
              <layout-image-initials
                v-if="option.initials" :image="option.image" :initials="option.initials"
                class="w-6 h-6 mr-2.5"
              />
              <span class="whitespace-nowrap text-ellipsis">{{ option.name }}</span>
            </span>
          </li>
        </transition-group>

        <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
          <icon
            name="mdi-chevron-right"
            class="w-4 h-4 transform transition-all"
            :class="{'rotate-90': !active, '-rotate-90': active}"
          />
        </span>
      </button>

      <transition-fade-in>
        <ul
          v-if="active"
          ref="outside"
          class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm"
          :class="{'dark:bg-gray-800': !light, 'dark:bg-gray-700': light}"
          tabindex="-1"
          role="listbox"
        >
          <form-select-option
            v-for="option in options"
            :key="option.value"
            :option="option"
            :choose="choose"
            :value="modelValue"
          />
        </ul>
      </transition-fade-in>
    </div>
  </div>
</template>
