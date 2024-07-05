<script lang="ts" setup>
import CalendarDay from '@/components/CalendarDay.vue'
import { useAuthStore } from '@/stores/auth'

const auth = useAuthStore()
const user: User = auth.user ?? ({} as User)
const week = ['MA', 'DI', 'WO', 'DO', 'VR', 'ZA', 'ZO']
</script>

<template>
  <main>
    <h1>Welkom {{ user.first_name }}</h1>
    <div class="divider"></div>
    <h2>Jouw werkweek</h2>
    <p>01/07/2024 - 07/07/2024</p>
    <input type="week" />
    <div class="calendar-container">
      <CalendarDay v-for="day in week" :day="day" />
    </div>

    <button @click="auth.logout">Logout</button>
  </main>
</template>

<style scoped>
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
</style>
