
<script lang="ts" setup>
import { PropType } from 'vue'
import { PushButtonState } from 'tailvue'
import { PushButton } from 'tailvue'
import { ThemeGradient } from '@/lib/themes'
const emit = defineEmits(['click'])
const props = defineProps({
  label: {
    type: String as PropType<string>,
    required: true,
  },
  state: {
    type: String as PropType<PushButtonState>,
    required: true,
  },
  ico: String,
  ping: String,
  back: [Function, String],
})
const isBackFunction = typeof props.back === 'function'
</script>


<template>
  <div class="px-4 py-3 bg-gray-100 dark:bg-gray-800 dark:border-t dark:border-gray-600 text-right sm:px-6 flex justify-end space-x-2">
    <push-button v-if="isBackFunction" @click="back">
      <icon
        ico="mdi-arrow-left"
        class="w-4 h-4 mr-1.5"
      />
      <span>Back</span>
    </push-button>
    <router-link v-else-if="back" :to="back">
      <push-button>
        <icon
          icon="mdi-arrow-left"
          class="w-4 h-4 mr-1.5"
        />
        <span>Back</span>
      </push-button>
    </router-link>
    <push-button
      :custom-theme="ThemeGradient"
      :state="state"
      :ping="ping"
      ping-color="bg-emerald-500"
      @click="emit('click')"
    >
      <icon
        v-if="ico && ['active', 'disabled'].includes(state)"
        :icon="ico"
        class="w-4 h-4 mr-1.5"
      />
      <icon
        v-else-if="state === 'loading'"
        icon="gg:spinner-two"
        class="w-4 h-4 mr-1.5 text-white animate-spin"
      />
      <span>{{ label }}</span>
    </push-button>
  </div>
</template>
