<script lang="ts" setup>
import { PropType } from 'vue'
defineProps({items: Array as PropType<models.Items>, fresh: String})
</script>

<template>
  <list-grid>
    <item-list-item v-for="item in items" :key="item.id" :item="item" />
  </list-grid>
</template>
