<script lang="ts" setup>
import BottomNavBar from '@/components/BottomNavBar.vue'
import { RouterView, useRouter } from 'vue-router'

function onTouchmove(e: TouchEvent) {
  // e.preventDefault()
}
</script>

<template>
  <div class="main-container" @touchmove="onTouchmove">
    <RouterView />
    <BottomNavBar
      v-if="
        useRouter().currentRoute.value.name != 'Login' ||
        useRouter().currentRoute.value.name != 'NewUser'
      "
    />
  </div>
</template>

<style scoped></style>
