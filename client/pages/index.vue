<script lang="ts" setup>
definePageMeta({layout: 'blank'})
const loading = ref(true)
if (useApi().loggedIn.value) useRouter().push('/home')
else loading.value = false
</script>

<template>
  <div class="bg-gradient-to-br from-swatch1/20 to-swatch5/20 w-screen h-screen">
    <div class="max-w-3xl w-full mx-auto relative min-h-screen flex items-center justify-center">
      <div class="absolute top-10 right-10 z-20">
        <header-dark-mode />
      </div>
      <div class="flex flex-col items-center justify-center mx-auto max-w-md w-full mx-2 relative">
        <layout-logo class="w-32 h-32 mb-8" />
        <login-form :destroyed="() => {}" class="w-full max-w-md" />
        <div v-if="loading" class="z-10 rounded-lg absolute inset-0 bg-swatch1/60 flex items-center justify-center">
          <icon name="mdi:loading" class="animate-spin w-12 h-12" />
        </div>
      </div>
    </div>
  </div>
</template>
