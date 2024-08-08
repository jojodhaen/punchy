<script lang="ts" setup>
import axiosInstance from '@/axiosInstance'
import VueDatePicker from '@vuepic/vue-datepicker'
import { onMounted, ref } from 'vue'

const loading = ref<Boolean>(true)

const weeklyHours = ref(0)
const minBreak = ref()
const maxBreak = ref()
const maxBreakTurnover = ref()
const minBreakWeekend = ref()
const maxBreakWeekend = ref()
const maxBreakTurnoverWeekend = ref()

async function getSettings() {
  await axiosInstance
    .get('/api/settings')
    .then((response) => {
      weeklyHours.value = response.data.weekly_hours
      minBreak.value = response.data.min_break_hours
        ? {
            hours: Math.floor(response.data.min_break_hours),
            minutes:
              (response.data.min_break_hours - Math.floor(response.data.min_break_hours)) * 60
          }
        : null
      maxBreak.value = response.data.max_break_hours
        ? {
            hours: Math.floor(response.data.max_break_hours),
            minutes:
              (response.data.max_break_hours - Math.floor(response.data.max_break_hours)) * 60
          }
        : null
      maxBreakTurnover.value = response.data.max_break_turnover_hours
        ? {
            hours: Math.floor(response.data.max_break_turnover_hours),
            minutes:
              (response.data.max_break_turnover_hours -
                Math.floor(response.data.max_break_turnover_hours)) *
              60
          }
        : null
      minBreakWeekend.value = response.data.min_break_hours_weekend
        ? {
            hours: Math.floor(response.data.min_break_hours_weekend),
            minutes:
              (response.data.min_break_hours_weekend -
                Math.floor(response.data.min_break_hours_weekend)) *
              60
          }
        : null
      maxBreakWeekend.value = response.data.max_break_hours_weekend
        ? {
            hours: Math.floor(response.data.max_break_hours_weekend),
            minutes:
              (response.data.max_break_hours_weekend -
                Math.floor(response.data.max_break_hours_weekend)) *
              60
          }
        : null
      maxBreakTurnoverWeekend.value = response.data.max_break_turnover_hours_weekend
        ? {
            hours: Math.floor(response.data.max_break_turnover_hours_weekend),
            minutes:
              (response.data.max_break_turnover_hours_weekend -
                Math.floor(response.data.max_break_turnover_hours_weekend)) *
              60
          }
        : null

      loading.value = false
    })
    .catch((error) => {
      console.error(error)
      loading.value = false
    })
}

onMounted(() => {
  getSettings()
})
</script>

<template>
  <h1>Instellingen</h1>
  <h2>Profiel</h2>
  <h2>Tijdsinstelling</h2>
  <div v-if="!loading" class="time-settings-container">
    <label for="weekly_hours">Uren per week</label>
    <input id="weekly_hours" v-model="weeklyHours" type="number" />

    <label>Min. pauze:</label>
    <VueDatePicker
      v-model="minBreak"
      :clearable="false"
      :start-time="{ hours: 0, minutes: 0 }"
      cancel-text="annuleren"
      select-text="selecteren"
      time-picker
    ></VueDatePicker>

    <label>Shift overslag:</label>
    <VueDatePicker
      v-model="maxBreakTurnover"
      :start-time="{ hours: 0, minutes: 0 }"
      cancel-text="annuleren"
      select-text="selecteren"
      time-picker
    ></VueDatePicker>

    <label>Max. pauze:</label>
    <VueDatePicker
      v-model="maxBreak"
      :clearable="false"
      :disabled="!maxBreakTurnover"
      :start-time="{ hours: 0, minutes: 0 }"
      cancel-text="annuleren"
      select-text="selecteren"
      time-picker
    ></VueDatePicker>

    <label>Min. pauze weekend:</label>
    <VueDatePicker
      v-model="minBreakWeekend"
      :clearable="false"
      :start-time="{ hours: 0, minutes: 0 }"
      cancel-text="annuleren"
      select-text="selecteren"
      time-picker
    ></VueDatePicker>

    <label>Shift overslag weekend:</label>
    <VueDatePicker
      v-model="maxBreakTurnoverWeekend"
      :start-time="{ hours: 0, minutes: 0 }"
      cancel-text="annuleren"
      select-text="selecteren"
      time-picker
    ></VueDatePicker>

    <label>Max. pauze weekend:</label>
    <VueDatePicker
      v-model="maxBreakWeekend"
      :clearable="false"
      :disabled="!maxBreakTurnoverWeekend"
      :start-time="{ hours: 0, minutes: 0 }"
      cancel-text="annuleren"
      select-text="selecteren"
      time-picker
    ></VueDatePicker>
  </div>
</template>

<style scoped>
.time-settings-container {
  display: flex;
  flex-direction: column;
  padding: 2rem;
  gap: 0.2rem;
}
</style>
