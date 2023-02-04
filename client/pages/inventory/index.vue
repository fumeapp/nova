<script lang="ts" setup>
useCrumbs().set([{ name: 'Inventory', to: '/inventory', icon: 'mdi:archive' }])
useCrumbs().action({ name: 'Add an Item', to: '/inventory/add', icon: 'mdi:archive-plus' })
const items = ref<models.ItemResults|undefined>(undefined)
const get = async () => items.value = await useApi().index('/item')
get()
</script>

<template>
  <div>
    <item-list :items="items?.data" />
  </div>
</template>
