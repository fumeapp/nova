<script lang="ts" setup>
const mobile = ref(false)
const mobileOn = () => mobile.value = true
const mobileOff = () => mobile.value = false
const color = 'repeating-linear-gradient(to right,#00c893 0%,#9c9ae3 50%,#6667ab 100%)'
defineProps({nopadding: {type: Boolean, default: false}})
</script>

<template>
  <div>
    <nuxt-loading-indicator :color="color" />
    <div class="relative min-h-screen flex flex-col">
      <!-- Top nav-->
      <header class="flex-shrink-0 relative h-16 flex items-center">
        <!-- Logo area -->
        <div class="absolute inset-y-0 left-0 lg:static lg:flex-shrink-0">
          <nuxt-link
            to="/home"
            class="block w-20 h-16 dark:border-gray-700 bg-black flex items-center justify-center"
            aria-label="Home"
          >
            <layout-logo class="w-12 h-12" />
          </nuxt-link>
        </div>

        <!-- Picker area -->
        <div class="mx-auto lg:hidden">
          <div class="relative" />
        </div>

        <!-- Menu button area -->
        <div class="absolute inset-y-0 right-0 pr-4 flex items-center sm:pr-6 lg:hidden">
          <!--<header-alerts v-if="loggedIn === true" /> -->
          <!-- Mobile menu button -->
          <button
            type="button"
            class="-mr-2 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-600"
            @click="mobileOn"
          >
            <span class="sr-only">Open main menu</span>
            <icon name="bx:bx-menu" class="w-6 h-6" />
          </button>
        </div>

        <!-- Desktop nav area -->
        <div class="hidden lg:min-w-0 lg:flex-1 lg:flex lg:items-center lg:justify-between">
          <div class="min-w-0">
            <header-search />
          </div>
          <div class="ml-10 pr-4 flex-shrink-0 flex items-end justify-end flex-1">
            <div class="flex-1 flex items-center justify-end space-x-6">
              <header-dark-mode id="darkModeIconDesktop" />
              <header-profile />
            </div>
          </div>
        </div>
        <header-mobile-menu :mobile="mobile" @off="mobileOff" />
      </header>

      <!-- Bottom section -->
      <div class="min-h-0 flex-1 flex">
        <header-sidebar />
        <div class="min-w-0 flex-1">
          <main class="relative min-w-0 flex-1 h-full border-t border-gray-300 dark:border-gray-700 flex flex-col">
            <layout-bread-crumbs :nopadding="nopadding">
              <slot />
            </layout-bread-crumbs>
          </main>
        </div>
      </div>
    </div>
  </div>
</template>
