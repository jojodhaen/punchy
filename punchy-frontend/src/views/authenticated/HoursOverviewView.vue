<script lang="ts" setup>
import axiosInstance from '@/axiosInstance'
import { onMounted, ref } from 'vue'

const now = new Date().setHours(0, 0, 0, 0)
const startEndDate = ref<[Date, Date]>([getWeekday(new Date(now), 1), getWeekday(new Date(now), 7)])

function getWeekday(d: Date, weekday: number) {
  d = new Date(d)
  let day = d.getDay(),
    diff = d.getDate() - day + (day == 0 ? -6 : weekday)
  return new Date(d.setDate(diff))
}

async function getWeeklyWorkedHours() {
  await axiosInstance
    .get(`api/workedhours/week/${startEndDate.value[0].toISOString()}`)
    .then((response) => {
      console.log(response.data)
    })
}

onMounted(() => {
  getWeeklyWorkedHours()
})
</script>

<template>Hours</template>

<style scoped></style>
