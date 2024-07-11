<script lang="ts" setup>
import axiosInstance from '@/axiosInstance'
import { ref } from 'vue'

let props = defineProps(['day'])

const startTime = ref<{ hours: number; minutes: number }>({
  hours: props.day[1].slice(0, 2),
  minutes: props.day[1].slice(3, 5)
})
const endTime = ref<{ hours: number; minutes: number }>({
  hours: props.day[2].slice(0, 2),
  minutes: props.day[2].slice(3, 5)
})

function getLocaleWeekday(date: Date) {
  return date.toLocaleString('nl-BE', { weekday: 'long' })
}

function formatTime(hours: number, minutes: number) {
  const formattedMinutes = minutes.toString().padStart(2, '0')
  const formattedHours = hours.toString().padStart(2, '0')
  return `${formattedHours}:${formattedMinutes}`
}

async function postClockTime() {
  await axiosInstance
    .post('api/clocktimes', {
      date: props.day[0],
      start_time: startTime.value
        ? formatTime(startTime.value.hours, startTime.value.minutes)
        : null,
      end_time: endTime.value ? formatTime(endTime.value.hours, endTime.value.minutes) : null
    })
    .then((response) => {
      console.log(response.data)
    })
}
</script>

<template>
  <div class="day-container">
    <div>
      <h2>{{ getLocaleWeekday(new Date(day[0])) }}</h2>
      <p>{{ new Date(day[0]).toLocaleDateString() }}</p>
    </div>
    <div class="time-selector-container">
      <div>
        <p class="label">Start</p>
        <VueDatePicker
          v-model="startTime"
          :clearable="false"
          cancel-text="annuleren"
          class="time-selector"
          locale="nl-BE"
          select-text="selecteren"
          time-picker
          @update:model-value="postClockTime"
        />
      </div>
      <div>
        <p class="label">Stop</p>
        <VueDatePicker
          v-model="endTime"
          :clearable="false"
          cancel-text="annuleren"
          class="time-selector"
          locale="nl-BE"
          select-text="selecteren"
          time-picker
          @update:model-value="postClockTime"
        />
      </div>
    </div>
  </div>
</template>

<style scoped>
.day-container {
  border: 3px solid #a87676;
  flex-grow: 1;
  min-height: 65px;
  font-family: 'Bodoni Moda SC', serif;
  font-size: 0.8rem;
  border-radius: 10px;
  padding: 5px;
  display: flex;
  justify-content: space-between;
  flex-direction: row;

  h2 {
    margin: 0;
    border-bottom: 2px solid #a87676;
    width: fit-content;
    line-height: 1;
  }

  p {
    margin: 5px 0 0;
  }

  .time-selector-container {
    display: flex;
    gap: 5px;
    height: 100%;
    align-items: center;
    justify-content: flex-end;
  }

  .time-selector {
    width: 100px;
  }

  .label {
    margin: 0 0 5px;
    font-family: 'Montserrat', sans-serif;
  }

  .dp__theme_light {
    --dp-font-size: 0.8rem;
  }
}
</style>
