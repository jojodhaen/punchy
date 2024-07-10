<script lang="ts" setup>
import { ref } from 'vue'

defineProps(['day'])

const startTime = ref<{ hours: number; minutes: number }>()
const endTime = ref<{ hours: number; minutes: number }>()

function getLocaleWeekday(date: Date) {
  return date.toLocaleString('nl-BE', { weekday: 'long' })
}
</script>

<template>
  <div class="day-container">
    <div>
      <h2>{{ getLocaleWeekday(new Date(day)) }}</h2>
      <p>{{ new Date(day).toLocaleDateString() }}</p>
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
