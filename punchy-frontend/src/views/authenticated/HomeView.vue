<script lang="ts" setup>
import axiosInstance from '@/axiosInstance'
import CalendarDay from '@/components/CalendarDay.vue'
import router from '@/router'
import { useAuthStore } from '@/stores/auth'
import VueDatePicker from '@vuepic/vue-datepicker'
import { onMounted, ref } from 'vue'

const auth = useAuthStore()
const user: User = auth.user ?? ({} as User)
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

onMounted(() => {
  getClockTimes()
})
</script>

<template>
  <main>
    <h1>Welkom {{ user.first_name }}</h1>
    <div class="divider"></div>
    <h2>Weekoverzicht</h2>
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
      <div class="edit-button" @click="router.replace('edit-week')">
        <p>Aanpassen</p>
      </div>
    </div>
    <div v-if="!loading" class="calendar-container">
      <CalendarDay v-for="day in weekDates" :day="day" />
    </div>
    <div v-else>
      <p>Loading...</p>
    </div>

    <button @click="auth.logout">Logout</button>
  </main>
</template>

<style scoped>
main {
  margin: 0;
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

h2 {
  font-family: 'Bodoni Moda SC', serif;
  font-size: 1.5rem;
  font-weight: 1000;
  margin: 1rem;
}

.divider {
  border: 2px solid #a87676;
  border-radius: 2rem;
  margin: 1rem;
}

.calendar-container {
  display: flex;
  justify-content: space-between;
  gap: 5px;
  margin: 1rem;
}

.calendar-picker-container {
  display: flex;
  justify-content: space-between;
  margin-left: 1rem;
  margin-right: 1rem;
  margin-bottom: 1rem;
  gap: 0.5rem;
}

.week-selector {
  width: 130px;
}

.edit-button {
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
</style>
