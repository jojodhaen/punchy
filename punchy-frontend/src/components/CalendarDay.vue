<script lang="ts" setup>
defineProps(['day'])
</script>

<template>
  <div class="day">
    <p>{{ day }}</p>
  </div>
</template>

<style scoped>
.day {
  background-color: #a87676;
  height: 100px;
  flex: 1;
  border-radius: 0.5rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-direction: column;

  p {
    font-family: 'Montserrat', sans-serif;
    font-size: 1rem;
    font-weight: 600;
    margin: 10px 0 0 0;
  }
}
</style>
