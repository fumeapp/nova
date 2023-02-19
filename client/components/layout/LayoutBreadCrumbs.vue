<script lang="ts" setup>
import { PushButton } from 'tailvue'
const { list, actions } = useCrumbs()
defineProps({nopadding: {type: Boolean, default: false}})
</script>

<template>
  <div class="flex flex-col flex-1">
    <client-only>
      <nav
        class="md:flex justify-between px-4 sm:px-6 border-b border-gray-300 dark:border-gray-700 lg:border-0"
        aria-label="Breadcrumb"
        :class="{'hidden': list.length === 0}"
      >
        <ol class="flex items-center space-x-4 py-3">
          <transition-group
            enter-active-class="transition ease-out duration-200 delay-200"
            enter-from-class="transform -translate-x-2 opacity-0"
            enter-to-class="transform translate-x-0 opacity-100"
            leave-active-class="ease-in duration-200"
            leave-from-class="transform translate-x-0 opacity-100"
            leave-to-class="transform -translate-x-2 opacity-0"
          >
            <li key="home">
              <div>
                <router-link to="/home" class="text-gray-400 hover:text-gray-500">
                  <icon name="fa-solid:home" class="w-5 h-5" />
                  <span class="sr-only">Home</span>
                </router-link>
              </div>
            </li>

            <li v-for="crumb in list" :key="crumb.name">
              <div v-if="crumb" class="flex items-center">
                <icon name="mdi-chevron-right" class="w-5 h-5" />
                <router-link v-if="crumb && crumb.to" :to="crumb.to" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">
                  <div class="flex items-center space-x-2">
                    <icon v-if="crumb.icon" :name="crumb.icon" class="w-5 h-5" />
                    <img v-if="crumb.image" :src="crumb.image" class="w-5 h-5 rounded-full">
                    <span class="whitespace-nowrap"> {{ crumb.name }} </span>
                  </div>
                </router-link>
                <span v-else class="ml-4 text-sm font-medium text-gray-500">
                  <div class="flex items-center space-x-2">
                    <icon v-if="crumb.icon" :name="crumb.icon" class="w-5 h-5" />
                    <img v-if="crumb.image" :src="crumb.image" class="w-5 h-5 rounded-full">
                    <span> {{ crumb.name }} </span>
                  </div>
                </span>
              </div>
            </li>
          </transition-group>
        </ol>
        <div v-if="actions.length > 0" class="space-y-2 md:space-y-0 py-2 lg:pt-4 md:flex md:space-x-4">
          <nuxt-link
            v-for="action in actions"
            :key="action.name"
            :to="action.to"
            class="flex text-xs"
          >
            <push-button size="xs" class="w-full">
              <div class="flex flex-1 items-center justify-center space-x-2">
                <icon :name="action.icon" class="w-4 h-4" />
                <span> {{ action.name }} </span>
              </div>
            </push-button>
          </nuxt-link>
        </div>
      </nav>
    </client-only>
    <div :class="{'my-12 sm:px-6': !nopadding}" class="flex-1">
      <slot />
    </div>
  </div>
</template>
