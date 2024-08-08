<script lang="ts" setup>
import axiosInstance from '@/axiosInstance'
import WeekPicker from '@/components/WeekPicker.vue'
import { onMounted, ref } from 'vue'

const now = new Date().setHours(0, 0, 0, 0)
const startEndDate = ref<[Date, Date]>([getWeekday(new Date(now), 1), getWeekday(new Date(now), 7)])

const loading = ref(true)
const workedHours = ref()

function getWeekday(d: Date, weekday: number) {
  d = new Date(d)
  let day = d.getDay(),
    diff = d.getDate() - day + (day == 0 ? -6 : weekday)
  return new Date(d.setDate(diff))
}

async function getWeeklyWorkedHours() {
  loading.value = true

  await axiosInstance
    .get(`api/workedhours/week/${startEndDate.value[0].toISOString()}`)
    .then((response) => {
      console.log(response.data)
      loading.value = false
      workedHours.value = response.data
    })
    .catch((error) => {
      console.log(error)
      loading.value = false
    })
}

onMounted(() => {
  getWeeklyWorkedHours()
})
</script>

<template>
  <h1>Gewerkte uren</h1>
  <h2>Wekelijks overzicht</h2>
  <WeekPicker v-model="startEndDate" @update:model-value="getWeeklyWorkedHours" />
  <div v-if="!loading">
    <p>Betaalde uren: {{ workedHours.total_worked_hours_with_breaks }}</p>
    <p>Gewerkte uren: {{ workedHours.total_worked_hours_without_breaks }}</p>
    <p>Overuren: {{ workedHours.overtime }}</p>
  </div>
  <h2>Jaarlijks overzicht</h2>
</template>

<style scoped></style>
