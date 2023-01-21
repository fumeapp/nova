<template>
  <div class="shadow">
    <div class="px-4 py-5 bg-white dark:bg-gray-800 sm:p-6 md:rounded-t-md">
      <slot />
    </div>
    <div class="md:rounded-b-md md:overflow-hidden">
      <slot name="submit" />
    </div>
  </div>
</template>
