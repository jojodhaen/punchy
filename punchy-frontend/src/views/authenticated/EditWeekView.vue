<script lang="ts" setup>
import WeekdayClockTime from '@/components/WeekdayClockTime.vue'
import VueDatePicker from '@vuepic/vue-datepicker'
import { ref, watch } from 'vue'
import '@vuepic/vue-datepicker/dist/main.css'

const startEndDate = ref<[Date, Date]>([getWeekday(new Date(), 1), getWeekday(new Date(), 7)])
const weekDates = ref<[Date, Date, Date, Date, Date, Date, Date]>([
  getWeekday(startEndDate.value[0], 1),
  getWeekday(startEndDate.value[0], 2),
  getWeekday(startEndDate.value[0], 3),
  getWeekday(startEndDate.value[0], 4),
  getWeekday(startEndDate.value[0], 5),
  getWeekday(startEndDate.value[0], 6),
  getWeekday(startEndDate.value[0], 7)
])

watch(startEndDate, () => {
  weekDates.value = [
    getWeekday(startEndDate.value[0], 1),
    getWeekday(startEndDate.value[0], 2),
    getWeekday(startEndDate.value[0], 3),
    getWeekday(startEndDate.value[0], 4),
    getWeekday(startEndDate.value[0], 5),
    getWeekday(startEndDate.value[0], 6),
    getWeekday(startEndDate.value[0], 7)
  ]
})

function getWeekday(d: Date, weekday: number) {
  d = new Date(d)
  let day = d.getDay(),
    diff = d.getDate() - day + (day == 0 ? -6 : weekday)
  return new Date(d.setDate(diff))
}
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
        week-picker
      />
    </div>
    <div class="weekdays">
      <WeekdayClockTime v-for="day in weekDates" :day="day" />
    </div>
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

.week-selector {
  width: 150px;
  margin-left: 1rem;
  margin-bottom: 1rem;
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
