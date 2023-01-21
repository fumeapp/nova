<script lang="ts" setup>
const props = defineProps({ mobile: Boolean })
const { mainMenu } = useMenu(useApi())
const emit = defineEmits(['click'])
</script>

<template>
  <div class="relative flex flex-col p-0 lg:p-3" :class="{'w-20 space-y-3': !props.mobile}">
    <client-only>
      <header-main-menu-item
        v-for="item in mainMenu"
        :key="item.name"
        :mobile="mobile"
        :item="item"
        @click="emit('click')"
      />
      <div
        v-if="isEmployee" class="flex flex-col lg:space-y-3"
      >
        <div class="flex bg-gray-300 dark:bg-gray-600 w-full h-px lg:rounded-full my-3" />
        <header-main-menu-item
          v-for="item in employeeMenu"
          :key="item.name"
          :mobile="mobile"
          :item="item"
          @click="emit('click')"
        />
      </div>
    </client-only>
  </div>
</template>
