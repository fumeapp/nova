<script lang="ts" setup>
</script>

<template>
  <header class="bg-white dark:bg-gray-800">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" aria-label="Top">
      <div class="w-full py-3 flex items-center justify-between">
        <div class="flex items-center">
          <div class="flex items-center space-x-4">
            <img src="/nova.png" class="w-8 h-8" alt="Nova Logo">
            <span class="font-semibold text-xl">nova</span>
          </div>
          <div class="hidden ml-10 space-x-8 lg:block">
            menu area
          </div>
        </div>
        <div class="flex items-center justify-center space-x-4">
          <header-dark-mode />
          <header-profile />
        </div>
      </div>
    </nav>
  </header>
</template>
