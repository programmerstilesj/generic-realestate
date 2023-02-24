<template>
  <form @submit.prevent="login">
    <div class="w-1/2 mx-auto">
      <div>
        <label for="email" class="label">Email</label>
        <input id="email" v-model="form.email" type="text" class="input" />
        <FormError :error="form.errors.email" />
      </div>
      <div class="mt-4">
        <label for="password" class="label">Password</label>
        <input id="password" v-model="form.password" type="password" class="input" />
        <FormError :error="form.errors.password" />
      </div>
      <div class="mt-4">
        <button class="btn-main w-full" type="submit">Login</button>
        <div class="mt-2 text-center">
          <Link :href="route('user-account.create')" class="text-sm text-gray-500">
            Create an account
          </Link>
        </div>
      </div>
    </div>
  </form>
</template>

<script setup>
import {useForm, Link} from '@inertiajs/vue3'
import FormError from '@/Components/FormError.vue'

const form = useForm({
  email: null,
  password: null,
})
const login = () => form.post(route('login.store'))

</script>
