<script lang="ts" setup>
defineProps(['day'])
</script>

<template>
  <div class="day">
    <p class="day-name">{{ day[0].toLocaleString('nl-BE', { weekday: 'short' }).toUpperCase() }}</p>

    <p class="date">{{ day[0].toLocaleDateString().slice(0, 5) }}</p>
    <div>
      <p class="hours">{{ day[1].slice(0, 5) }}</p>
      <p class="hours">{{ day[2].slice(0, 5) }}</p>
    </div>
  </div>
</template>

<style scoped>
.day {
  background-color: #a87676;
  height: 90px;
  flex: 1;
  border-radius: 0.5rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-direction: column;
  padding-top: 10px;
  padding-bottom: 10px;

  p {
    margin: 0;
  }

  .day-name {
    font-size: 1.2rem;
    font-weight: 700;
    font-family: 'Montserrat', sans-serif;
  }

  .date {
    font-size: 0.9rem;
    font-weight: 500;
    font-family: monospace;
  }

  .hours {
    font-size: 0.8rem;
    font-weight: 500;
    font-family: monospace;
  }
}
</style>
