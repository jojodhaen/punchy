<script lang="ts" setup>
import axiosInstance from '@/axiosInstance'
import { useAuthStore } from '@/stores/auth'
import { ref } from 'vue'

const auth = useAuthStore()

const email = ref('')
const password = ref('')

const handleSubmit = (event: Event) => {
  event.preventDefault()
  console.log('Email:', email.value)
  console.log('Password:', password.value)
  auth.login(email.value, password.value)
}

axiosInstance.get('/sanctum/csrf-cookie').then((response) => {
  console.log(response.data)
})
</script>

<template>
  <h1>LOGIN</h1>
  <form v-on:submit="handleSubmit">
    <label for="email">Email</label>
    <input id="email" v-model="email" name="email" required type="email" />
    <label for="password">Password</label>
    <input id="password" v-model="password" name="password" required type="password" />
    <button type="submit">Login</button>
  </form>
</template>

<style scoped>
h1 {
  font-family: 'Bodoni Moda SC', serif;
  font-size: 3rem;
  font-weight: 1000;
}

form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  max-width: 220px;
  margin: 0 auto;
}
</style>
