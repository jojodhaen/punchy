<script lang="ts" setup>
import { useAuthStore } from '@/stores/auth'

const user: User = useAuthStore().user ?? ({} as User)
</script>

<template>
  <main>
    <h1>Welcome {{ user.first_name }}</h1>
  </main>
</template>
