<script lang="ts" setup>
import { PropType } from 'vue'
defineProps({item: { type: Object as PropType<models.Item>, required: true  }, fresh: String})
</script>

<template>
  <list-grid-item :to="`/inventory/${item.id}`">
    <img :src="item.images[0]?.url" alt="Cover Image" class="w-full h-64 object-cover">
    <nuxt-link :to="`/inventory/${item.id}`" class="flex flex-col p-4">
      <div class="flex items-center justify-between mb-2">
        <div class="font-semibold"> {{ item.title }}</div>
        <span class="px-3 py-0.5 text-xs uppercase rounded-full bg-gray-100 dark:bg-gray-700"> {{ item.status }}</span>
      </div>
      <p class="text-gray-500 text-xs" v-html="item.location.payload.adr_address" />
      <div class="mt-2">
        <form-tag v-for="tag in item.tags" :key="tag.id" :tag="tag.name" />
      </div>
    </nuxt-link>
  </list-grid-item>
</template>
