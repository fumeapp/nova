<template>
  <form-row
    :label="label" :long="long" :optional="optional"
    :required="required"
  >
    <div class="rounded-md shadow-sm flex" :class="mt">
      <div v-if="loading && spinner" class="absolute right-0 top-0 bottom-0 flex items-center">
        <icon icon="gg-spinner-two" class="w-4 h-4 animate-spin mr-2.5" />
      </div>
      <input
        v-if="type === 'phone'"
        ref="input"
        v-model="local"
        data-mask="+1 (###) ###-####"
        type="text"
        class="form-input rounded-md block w-full sm:text-sm sm:leading-5 dark:bg-gray-700 masked outline-none focus:(ring-emerald-500 border-emerald-500)"
        :placeholder="placeholder"
        @keydown.enter="emit('enter')"
      >
      <input
        v-else-if="type !== 'textarea'"
        ref="input"
        v-model="local"
        :type="type"
        class="form-input rounded-md block w-full sm:text-sm sm:leading-5 dark:bg-gray-700"
        :readonly="loading || readonly"
        :class="[{'italic': loading}, inputClass]"
        :placeholder="placeholder"
        @keydown.enter="emit('enter')"
      >
      <textarea
        v-else-if="type === 'textarea'"
        ref="input"
        v-model="local"
        rows="3"
        class="form-input p-2 rounded-md block w-full sm:text-sm sm:leading-5 dark:bg-gray-700"
        :placeholder="placeholder"
      />
      <slot />
    </div>
    <p v-if="tip" class="mt-2 text-sm text-gray-500">
      {{ tip }}
    </p>
  </form-row>
</template>

<script lang="ts" setup>
import { PropType } from 'vue'
import FormRow from '@/components/form/FormRow.vue'
import { PushButtonState } from 'tailvue'

const props = defineProps({
  label: String,
  tip: String,
  modelValue: {
    type: [String, Number],
  },
  placeholder: {
    type: String,
  },
  type: {
    type: String as PropType<'text'|'email'|'phone'|'textarea'|'date'|'time'|'datetime-local'>,
    required: false,
    default: 'text',
  },
  state: {
    type: String as PropType<PushButtonState>,
    default: 'active',
  },
  spinner: Boolean,
  focus: Boolean,
  required: Boolean,
  optional: Boolean,
  readonly: Boolean,
  long: Boolean,
  mt: {
    type: String,
    default: 'mt-2',
  },
  inputClass: String,
})

const input = ref<HTMLInputElement|null>(null)
const emit = defineEmits(['update:modelValue', 'enter', 'code'])
const local = computed({
  get (): string|number {
      return props.modelValue || ''
  },
  set (value: string|number): void {
      emit('update:modelValue', value)
  },
})

const loading = computed(() => props.state === 'loading')
const { sleep } = useUtils()

if (getCurrentInstance())
  onMounted(async () => {
    await sleep(500)
    if (props.focus && input.value) input.value.focus()
    if (input.value) checkInput(input.value)
    if (['phone', 'intphone'].includes(props.type)) window.Maska.create('.masked')
  })

const checkInput = (input: HTMLInputElement) => {
  if (props.type === 'textarea' && window)
    window.autosize(input)
}

defineExpose({ input })
</script>
