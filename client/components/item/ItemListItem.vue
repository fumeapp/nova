<script lang="ts" setup>
import { PropType } from 'vue'
defineProps({item: { type: Object as PropType<models.Item>, required: true  }, fresh: String})
</script>

<template>
  <list-grid-item>
    <img :src="item.images[0].url" alt="Cover Image" class="w-full h-64 object-cover">
    <nuxt-link :to="`/inventory/${item.id}`" class="flex flex-col p-4">
      <h1> {{ item.title }}</h1>
      <p class="text-gray-500"> {{ item.description }}</p>
    </nuxt-link>
    <div>
      <form-tag v-for="tag in item.tags" :key="tag.id" :tag="tag.name" />
    </div>
  </list-grid-item>
</template>
