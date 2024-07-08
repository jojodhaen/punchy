<script lang="ts" setup>
import VueDatePicker from '@vuepic/vue-datepicker'
import { ref } from 'vue'
import '@vuepic/vue-datepicker/dist/main.css'

const date = ref()
</script>

<template>
  <h1>Werktijden</h1>
  <div class="divider"></div>
  <VueDatePicker v-model="date" week-picker />
  <p>{{ date }}</p>
</template>

<style scoped>
h1 {
  font-family: 'Bodoni Moda SC', serif;
  font-size: 2rem;
  font-weight: 1000;
  line-height: 1;
  margin: 0;
  padding: 1rem 1rem 0 1rem;
  overflow-wrap: break-word;
}

.divider {
  border: 2px solid #a87676;
  border-radius: 2rem;
  margin: 1rem;
}
</style>
