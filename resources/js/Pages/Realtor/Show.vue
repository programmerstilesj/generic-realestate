<template>
  <div class="mb-4">
    <Link :href="route('realtor.listing.index')">&lt;- Go back to Listings</Link>
  </div>

  <section class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
    <Box v-if="!hasOffers" class="flex md:col-span-7 items-center">
      <div class="w-full text-center fond-medium text-gray-500">
        No offers
      </div>
    </Box>
    <div v-else class="md:col-span-7 flex flex-col gap-4">
      <Offer
        v-for="offer in listing.offers"
        :key="offer.id"
        :offer="offer"
        :listing-price="listing.price"
        :is-sold="listing.sold_at != null"
      />
    </div>
    <div class="md:col-span-5">
      <Box>
        <template #header>Basic Info</template>
        <Price :price="listing.price" class="text-2xl font-bold" />
        <ListingOptions :listing="listing" class="text-lg" />
        <listing-address :listing="listing" class="text-gray-500" />
      </box>
    </div>
  </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import Box from '@/Components/UI/Box.vue'
import Price from '@/Components/Price.vue'
import ListingOptions from '@/Components/ListingOptions.vue'
import ListingAddress from '@/Components/ListingAddress.vue'
import Offer from '@/Pages/Realtor/Show/Components/Offer.vue'
import {computed} from 'vue'

const props = defineProps({listing: Object})

const hasOffers = computed(
  () => props.listing.offers.length,
)
</script>
