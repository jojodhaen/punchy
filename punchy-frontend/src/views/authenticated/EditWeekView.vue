<script lang="ts" setup>
import axiosInstance from '@/axiosInstance'
import WeekdayClockTime from '@/components/WeekdayClockTime.vue'
import VueDatePicker from '@vuepic/vue-datepicker'
import { ref } from 'vue'
import '@vuepic/vue-datepicker/dist/main.css'

const now = new Date().setHours(0, 0, 0, 0)

const startEndDate = ref<[Date, Date]>([getWeekday(new Date(now), 1), getWeekday(new Date(now), 7)])
const weekDates = ref()
const loading = ref(false)

function getWeekday(d: Date, weekday: number) {
  d = new Date(d)
  let day = d.getDay(),
    diff = d.getDate() - day + (day == 0 ? -6 : weekday)
  return new Date(d.setDate(diff))
}

async function getClockTimes() {
  weekDates.value = []
  loading.value = true

  await axiosInstance
    .get(`api/clocktimes/${startEndDate.value[0].toISOString()}`)
    .then((response) => {
      weekDates.value = response.data.map((day: Day) => {
        return [
          new Date(day.date),
          day.start_time ?? new Date(day.date).toTimeString().slice(0, 8),
          day.end_time ?? new Date(day.date).toTimeString().slice(0, 8)
        ]
      })
    })
    .finally(() => {
      loading.value = false
    })
}

getClockTimes()
</script>

<template>
  <main>
    <h1>Werktijden</h1>
    <div class="divider"></div>
    <div class="calendar-picker-container">
      <VueDatePicker
        v-model="startEndDate"
        :clearable="false"
        :enable-time-picker="false"
        auto-apply
        auto-close
        cancelText="annuleren"
        class="week-selector"
        locale="nl-BE"
        selectText="selecteren"
        timezone="Europe/Brussels"
        week-picker
        @update:model-value="getClockTimes"
      />
      <div class="save-button">
        <p>Opslaan</p>
      </div>
    </div>
    <div v-if="!loading" class="weekdays">
      <WeekdayClockTime v-for="day in weekDates" :day="day" />
    </div>
    <div v-if="loading">Loading</div>
  </main>
</template>

<style>
main {
  min-height: 100dvh;
  display: flex;
  flex-direction: column;
}

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

.calendar-picker-container {
  display: flex;
  justify-content: space-between;
  margin-left: 1rem;
  margin-right: 1rem;
  margin-bottom: 1rem;
  gap: 1rem;
}

.week-selector {
  width: 150px;
}

.save-button {
  flex-grow: 1;
  border: 1px solid #a87676;
  border-radius: 10px;
  display: flex;
  justify-content: center;
  align-content: center;

  p {
    padding: 0;
    margin: auto 0;
    font-family: 'Montserrat', serif;
    font-weight: 400;
  }
}

.weekdays {
  flex-grow: 1;
  display: flex;
  justify-content: space-between;
  height: 100%;
  flex-direction: column;
  padding: 1rem;
  gap: 1rem;
}

.dp__theme_light {
  --dp-background-color: #ffd0d0;
  --dp-primary-color: #a87676;
  --dp-icon-color: #a87676;
  --dp-border-color: #a87676;
  --dp-border-color-focus: #a87676;
  --dp-border-radius: 10px;
  --dp-menu-border-color: #a87676;
  --dp-hover-color: transparent;
  --dp-secondary-color: #ca8787;
}
</style>
