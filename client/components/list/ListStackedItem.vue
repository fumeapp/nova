<template>
  <li v-if="props.to">
    <router-link :to="props.to" class="block hover:bg-gray-50 dark:hover:bg-gray-800 group">
      <div class="flex items-center px-4 py-4 sm:px-6">
        <div class="min-w-0 flex-1 flex items-center">
          <slot />
        </div>
        <div>
          <icon
            icon="mdi-chevron-right"
            class="w-6 h-6 transform transition duration-500 ease-out group-hover:translate-x-1"
          />
        </div>
      </div>
    </router-link>
  </li>
  <li v-else>
    <div class="block">
      <div class="flex items-center px-4 py-4 sm:px-6">
        <div class="min-w-0 flex-1 flex items-center">
          <slot />
        </div>
        <div>
          <icon
            icon="mdi-chevron-right"
            class="w-4 h-4"
          />
        </div>
      </div>
    </div>
  </li>
</template>

<script lang="ts" setup>
const props = defineProps({ to: String })
</script>
