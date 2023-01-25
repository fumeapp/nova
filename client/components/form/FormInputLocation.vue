<script lang="ts" setup>
const apiKey = 'AIzaSyCA07GS1boV0NCnZHFUjCNZEdiVQnYJ1aE'

const load = () => {
  if (process.client) {
    // Create the script tag, set the appropriate attributes
    const script = document.createElement('script')
    script.src = `https://maps.googleapis.com/maps/api/js?libraries=places&key=${apiKey}&callback=initMap`
    script.async = true

    // Attach your callback function to the `window` object
    window.initMap = function() {
      init()
    }

    // Append the 'script' element to 'head'
    document.head.appendChild(script);
  }
}

defineProps({
  label: String,
  tip: String,
  modelValue: Object,
  optional: Boolean,
  required: Boolean,
})

const emit = defineEmits(['update:modelValue'])

const search = ref(undefined)
const place = ref<undefined|google.maps.places.PlaceResult>(undefined)
const input = ref<HTMLInputElement|undefined>(undefined)

const fields = ['name', 'formatted_address', 'adr_address', 'place_id', 'geometry']
let autocomplete = undefined as undefined|google.maps.places.Autocomplete

const placeMap = computed((): undefined|string => {
  if (!place.value || !place.value.geometry || !place.value.geometry.location) return undefined
    return 'https://maps.googleapis.com/maps/api/staticmap?center=' +
      `${place.value.geometry.location.lat()},${place.value.geometry.location.lng()}&zoom=14&size=600x200` +
      `&markers=color:0x009ee9|${place.value.geometry.location.lat()},${place.value.geometry.location.lng()}` +
      `&key=${apiKey}`
})

const init = (): void => {
  if(input.value) {
    autocomplete = new google.maps.places.Autocomplete(input.value, {
      componentRestrictions: { country: 'us' },
      // types: ['establishment'],
      fields,
    })
    autocomplete.addListener('place_changed', select)
  }
}

const select = () => {
  place.value = autocomplete?.getPlace()
  emit('update:modelValue', place.value)
}

const focus = () => {
  if (input.value && input.value) input.value.focus()
}
const clear = (): void => {
  search.value = undefined
  place.value = undefined
  input.value = undefined
  emit('update:modelValue', null)
}

if (getCurrentInstance())
  onMounted(load)
</script>

<template>
  <div>
    <div class="flex items-center justify-between w-full lg:w-3/4">
      <label class="flex flex-1 justify-between text-sm font-medium leading-5">
        <span> {{ label }} </span>
        <span v-if="optional" class="text-gray-300 dark:text-gray-500 text-xs italic ml-4"> Optional </span>
        <span v-if="required" class="text-gray-600 dark:text-gray-300 font-semibold text-xs italic ml-4"> Required </span>
      </label>
    </div>
    <div class="mt-1 relative rounded-md shadow-sm w-full lg:w-3/4">
      <input
        id="search"
        ref="input"
        type="text"
        class="form-input rounded-md block pr-10 w-full sm:text-sm sm:leading-5 dark:bg-gray-700"
        autocomplete="off"
        @focus="focus"
      >
      <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
        <button>
          <icon
            v-if="place === undefined" key="search" name="mdi-magnify"
            class="w-4 h-4 pointer-events-none"
          />
          <icon
            v-else
            key="clear"
            name="mdi-close"
            class="w-4 h-4 text-gray-300"
            @click="clear"
          />
        </button>
      </div>
    </div>
    <p v-if="tip" class="mt-2 text-sm text-gray-500">
      {{ tip }}
    </p>
  </div>
  <div v-if="place" class="my-6 flex flex-col space-y-2">
    <div>
      <img v-if="placeMap" :src="placeMap" alt="map of location">
    </div>
  </div>
  <div id="map" />
</template>


<style>
.pac-container {
  @apply rounded-lg border border-2;
}
.pac-item:first-child {
  @apply border-t-0;
}
.pac-item {
  @apply p-2;
}
.pac-container:after {
  background-image: none !important;
  height: 0px;
}
</style>
