<template>
  <transition
    appear
    mode="out-in"
    enter-active-class="transition ease-out duration-100"
    enter-from-class="transform opacity-0"
    enter-to-class="transform opacity-100"
    leave-active-class="ease-in duration-100"
    leave-from-class="transform opacity-100"
    leave-to-class="transform opacity-0"
  >
    <slot />
  </transition>
</template>
