<script lang="ts" setup>
import BottomNavBar from '@/components/BottomNavBar.vue'
import { useAuthStore } from '@/stores/auth'
import { RouterView } from 'vue-router'

const auth = useAuthStore()

function onTouchmove(e: TouchEvent) {
  // e.preventDefault()
}
</script>

<template>
  <div class="main-container" @touchmove="onTouchmove">
    <RouterView />
    <BottomNavBar v-if="auth.authenticated" />
  </div>
</template>

<style scoped></style>
