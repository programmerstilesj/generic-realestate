<template>
  <form @submit.prevent="filter">
    <div class="mb-8 mt-4 flex flex-wrap gap-2">
      <div class="flex flex-nowrap items-center">
        <input
          v-model.number="filterForm.minPrice"
          type="text" placeholder="Min Price"
          class="input-filter-l w-28"
        />
        <input
          v-model.number="filterForm.maxPrice"
          type="text" placeholder="Max Price"
          class="input-filter-r w-28"
        />
      </div>
      <div class="flex flex-nowrap items-center">
        <select
          v-model="filterForm.beds"
          class="input-filter-l  w-24"
        >
          <option :value="null">Beds</option>
          <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
          <option>6+</option>
        </select>
        <select
          v-model="filterForm.baths"
          class="input-filter-r  w-24"
        >
          <option :value="null">Baths</option>
          <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
          <option>6+</option>
        </select>
      </div>
      <div class="flex flex-nowrap items-center">
        <input
          v-model.number="filterForm.minArea" type="text" placeholder="Min Area"
          class="input-filter-l w-28"
        />
        <input
          v-model.number="filterForm.maxArea" type="text" placeholder="Max Area"
          class="input-filter-r w-28"
        />
      </div>

      <button type="submit" class="btn-normal">Filter</button>
      <button type="reset" @click="clear">Clear</button>
    </div>
  </form>
</template>

<script setup>
import {useForm} from '@inertiajs/vue3'

const props = defineProps({filters: Object})

const filterForm = useForm({
  minPrice: props.filters.minPrice ?? null,
  maxPrice: props.filters.maxPrice ?? null,
  beds: props.filters.beds ?? null,
  baths: props.filters.baths ?? null,
  minArea: props.filters.minArea ?? null,
  maxArea: props.filters.maxArea ?? null,
})
const filter = () => {
  filterForm.get(
    route('listing.index'),
    {
      preserveState:true,
      preserveScroll: true,
    },
  )
}

const clear = () => {
  filterForm.minPrice= null
  filterForm.maxPrice= null
  filterForm.beds= null
  filterForm.baths= null
  filterForm.minArea= null
  filterForm.maxArea= null
  filter()
}
</script>
