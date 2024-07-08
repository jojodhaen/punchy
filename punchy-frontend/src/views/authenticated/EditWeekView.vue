<script lang="ts" setup>
import VueDatePicker from '@vuepic/vue-datepicker'
import { ref } from 'vue'
import '@vuepic/vue-datepicker/dist/main.css'

function getWeekday(d: Date, weekday: number) {
  d = new Date(d)
  let day = d.getDay(),
    diff = d.getDate() - day + (day == 0 ? -6 : weekday)
  return new Date(d.setDate(diff))
}

const date = ref<[Date, Date]>([getWeekday(new Date(), 1), getWeekday(new Date(), 7)])
</script>

<template>
  <h1>Werktijden</h1>
  <div class="divider"></div>
  <VueDatePicker v-model="date" :enable-time-picker="false" class="week-picker" week-picker />
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

.week-picker {
  width: 150px;
  margin-left: 1rem;

  --dp-background-color: #ffd0d0;
  --dp-primary-color: #a87676;
  --dp-icon-color: #a87676;
  --dp-border-color: #a87676;
  --dp-border-color-focus: #a87676;
  --dp-border-radius: 10px;

  --dp-menu-background-color: #ffd0d0;
  --dp-menu-border-color: #a87676;
}
</style>
