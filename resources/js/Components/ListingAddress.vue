<template>
  <span>
    {{ listing.street }} {{ listing.street_num }}, {{ listing.city }}
  </span>
</template>

<script setup>
defineProps({
  listing: Object,
})
</script>
