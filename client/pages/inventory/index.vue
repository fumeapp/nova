<script lang="ts" setup>
useCrumbs().set([{ name: 'Inventory', to: '/inventory', icon: 'mdi:archive' }])
useCrumbs().action({ name: 'Add an Item', to: '/inventory/add', icon: 'mdi:archive-plus' })
</script>

<template>
  <div>
    Inventory landing page
  </div>
</template>

<style scoped></style>
