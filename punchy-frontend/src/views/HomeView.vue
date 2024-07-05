<script lang="ts" setup>
import { useAuthStore } from '@/stores/auth'

const auth = useAuthStore()
const user: User = auth.user ?? ({} as User)
</script>

<template>
  <main>
    <p>Welkom {{ user.first_name }}</p>
    <button @click="auth.logout">Logout</button>
  </main>
</template>

<style scoped>
p {
  font-family: 'Bodoni Moda SC', serif;
  font-size: 2rem;
  font-weight: 1000;
  line-height: 1;
  margin: 0;
  padding: 1rem;
  overflow-wrap: break-word;
}
</style>
