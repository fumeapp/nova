<script lang="ts" setup>
import { PropType } from 'vue'
const props = defineProps({
  destroyed: {
    type: Function as PropType<() => void>,
    required: true,
  },
})
</script>


<template>
  <modal-base :destroyed="props.destroyed">
    <login-form :destroyed="props.destroyed" />
  </modal-base>
</template>
