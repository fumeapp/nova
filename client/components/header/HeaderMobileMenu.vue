<script lang="ts" setup>
import { PushButton } from 'tailvue'

const api = useApi()
const { profile } = useMenu(api)

const props = defineProps({ mobile: Boolean, unread: Number })
const emit = defineEmits(['off'])
const hdm = ref<undefined|HTMLElement & { toggle: () => void }>(undefined)

const toggleDark = () => hdm?.value?.toggle()

const inner = ref(false)

const off = async () => {
  inner.value = false
  await useUtils().sleep(200)
  emit('off')
}

watchEffect(() => inner.value = props.mobile)

const on = () => {
  off()
  api.on(true)
}

</script>

<template>
  <div
    v-if="mobile" class="fixed inset-0 z-40 lg:hidden" role="dialog"
    aria-modal="true"
  >
    <transition
      appear
      enter-active-class="transition-opacity ease-linear duration-300"
      enter-from-class="opacity-0"
      enter-to-class="opacity-100"
      leave-active-class="transition-opacity ease-linear duration-300"
      leave-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div
        class="hidden sm:block sm:fixed sm:inset-0 sm:bg-gray-600 sm:bg-opacity-75"
        aria-hidden="true"
        @click="off"
      />
    </transition>

    <transition
      appear
      enter-active-class="transition ease-out duration-150 sm:ease-in-out sm:duration-300"
      enter-from-class="transform opacity-0 scale-110 sm:translate-x-full sm:scale-100 sm:opacity-100"
      enter-to-class="transform opacity-100 scale-100 sm:translate-x-0 sm:scale-100 sm:opacity-100"
      leave-active-class="transition ease-in duration-150 sm:ease-in-out sm:duration-300"
      leave-class="transform opacity-100 scale-100 sm:translate-x-0 sm:scale-100 sm:opacity-100"
      leave-to-class="transform opacity-0 scale-110 sm:translate-x-full sm:scale-100 sm:opacity-100"
    >
      <nav v-if="inner" class="fixed z-40 inset-0 h-full w-full bg-white dark:bg-gray-900 sm:inset-y-0 sm:left-auto sm:right-0 sm:max-w-sm sm:w-full sm:shadow-lg" aria-label="Global">
        <div class="h-16 flex items-center justify-between px-4 sm:px-6">
          <a href="/home" class="w-8 h-8">
            <header-logo class="w-8 h-8 text-logo-a" />
          </a>
          <button
            type="button"
            class="-mr-2 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-600"
            @click="off"
          >
            <span class="sr-only">Close main menu</span>
            <icon icon="mdi-close" class="w-6 h-6 text-gray-400" />
          </button>
        </div>
        <div v-if="api.loggedIn">
          <nav aria-label="Main Menu">
            <header-main-menu mobile @click="off" />
          </nav>
          <div class="border-t border-gray-300 dark:border-gray-700 mt-4 pt-4 pb-3">
            <div class="max-w-8xl mx-auto px-4 flex items-center sm:px-6">
              <div class="flex-shrink-0">
                <img
                  class="h-10 w-10 rounded-full"
                  :src="api.$user.Avatar"
                  alt="Avatar"
                >
              </div>
              <div class="ml-3 min-w-0 flex-1">
                <div class="text-base font-medium text-gray-400 truncate"> {{ api.$user.Name }} </div>
                <div class="text-sm font-medium text-gray-500 truncate"> {{ api.$user.Email }} </div>
              </div>
              <!--
              <router-link to="/alerts" class="relative ml-auto flex-shrink-0 p-2 text-gray-400 hover:text-gray-500" @click="off">
                <span class="sr-only">View notifications</span>
                <icon icon="mdi-bell" class="w-6 h-6" />
                <unread-alerts :unread="unread" />
              </router-link>
            -->
            </div>
            <div class="mt-3 max-w-8xl mx-auto px-2 space-y-1 sm:px-4">
              <div v-for="(items, index) in profile" :key="index">
                <div
                  v-for="item in items"
                  :key="item.name"
                  class="cursor-pointer group flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-300"
                  @click="item.action(); off()"
                >
                  <icon
                    :icon="item.icon"
                    class="w-5 h-5 mr-3 text-gray-400 group-hover:text-emerald-500 dark:group-hover:text-emerald-300"
                  />
                  {{ item.name }}
                </div>
              </div>
              <div>
                <div
                  class="cursor-pointer group flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-300"
                  @click="toggleDark"
                >
                  <header-dark-mode ref="hdm" noclick class="mr-3 -ml-2 w-6 h-6" />
                  Dark / Light Mode
                </div>
              </div>
            </div>
          </div>
        </div>
        <div v-else class="w-full h-full flex items-center justify-center flex-1">
          <push-button size="s" @click="on">
            <span>Log In</span>
          </push-button>
        </div>
      </nav>
    </transition>
  </div>
</template>


<style>
html,body {
  @apply bg-gray-100 text-gray-600;
}
</style>
