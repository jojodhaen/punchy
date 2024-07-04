<script lang="ts" setup>
import { RouterView } from 'vue-router'

function onTouchmove(e: TouchEvent) {
  e.preventDefault()
}
</script>

<template>
  <div class="main-container" @touchmove="onTouchmove">
    <RouterView />
  </div>
</template>

<style scoped>
.main-container {
  min-height: 100dvh;
}
</style>
