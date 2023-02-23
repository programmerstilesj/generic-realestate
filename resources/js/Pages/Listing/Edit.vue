<template>
  <form @submit.prevent="update">
    <div class="grid grid-cols-6 gap-4">
      <div class="col-span-2">
        <label class="label">Beds</label>
        <input v-model.number="form.beds" type="text" class="input" />
        <FormError :error="form.errors.beds" />
      </div>

      <div class="col-span-2">
        <label class="label">Baths</label>
        <input v-model.number="form.baths" type="text" class="input" />
        <FormError :error="form.errors.baths" />
      </div>

      <div class="col-span-2">
        <label class="label">Area</label>
        <input v-model.number="form.area" type="text" class="input" />
        <FormError :error="form.errors.area" />
      </div>

      <div class="col-span-4">
        <label class="label">City</label>
        <input v-model="form.city" type="text" class="input" />
        <FormError :error="form.errors.city" />
      </div>

      <div class="col-span-2">
        <label class="label">Post Code</label>
        <input v-model="form.code" type="text" class="input" />
        <FormError :error="form.errors.code" />
      </div>

      <div class="col-span-4">
        <label class="label">Street</label>
        <input v-model="form.street" type="text" class="input" />
        <FormError :error="form.errors.street" />
      </div>

      <div class="col-span-2">
        <label class="label">Street Number</label>
        <input v-model.number="form.street_num" type="text" class="input" />
        <FormError :error="form.errors.street_num" />
      </div>

      <div class="col-span-6">
        <label class="label">Price</label>
        <input v-model.number="form.price" type="text" class="input" />
        <FormError :error="form.errors.price" />
      </div>

      <div class="col-span-6">
        <button type="submit" class="btn-main">Edit</button>
      </div>
    </div>
  </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  listing: Object,
})
const form = useForm({
  beds:props.listing.beds,
  baths:props.listing.baths,
  area:props.listing.area,
  city:props.listing.city,
  street:props.listing.street,
  code:props.listing.code,
  street_num:props.listing.street_num,
  price:props.listing.price,
})
const update = () => form.put(route('listing.update', {listing: props.listing.id}))
import FormError from '@/Components/FormError.vue'

</script>

<style scoped>
label {
    margin-right: 2em;
}

div {
    padding: 2px
}
</style>
