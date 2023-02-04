<script lang="ts" setup>
import { PropType } from 'vue'
defineProps({item: { type: Object as PropType<models.Item>, required: true  }, fresh: String})
</script>

<template>
  <list-grid-item :to="`/inventory/${item.id}`">
    <img :src="item.images[0].url" alt="Cover Image" class="w-full h-64 object-cover">
    <nuxt-link :to="`/inventory/${item.id}`" class="flex flex-col p-4">
      <h1> {{ item.title }}</h1>
      <p class="text-gray-500 text-xs" v-html="item.location?.adr_address" />
      <div class="mt-2">
        <form-tag v-for="tag in item.tags" :key="tag.id" :tag="tag.name" />
      </div>
    </nuxt-link>
  </list-grid-item>
</template>
