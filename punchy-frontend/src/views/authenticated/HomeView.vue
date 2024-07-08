<script lang="ts" setup>
import CalendarDay from '@/components/CalendarDay.vue'
import router from '@/router'
import { useAuthStore } from '@/stores/auth'
import { ref } from 'vue'

const auth = useAuthStore()
const user: User = auth.user ?? ({} as User)
const week = ['MA', 'DI', 'WO', 'DO', 'VR', 'ZA', 'ZO']
const clockTimeMenuButtonOpen = ref(false)

const handleClockTimeMenuOpenButtonClicked = () => {
  clockTimeMenuButtonOpen.value = !clockTimeMenuButtonOpen.value
}

const handleEditOneDayClicked = () => {
  if (clockTimeMenuButtonOpen.value) {
    router.push('/edit-day')
  }
}

const handleEditWeekClicked = () => {
  if (clockTimeMenuButtonOpen.value) {
    router.push('/edit-week')
  }
}
</script>

<template>
  <main>
    <h1>Welkom {{ user.first_name }}</h1>
    <div class="divider"></div>
    <h2>Jouw werkweek</h2>
    <p class="date-viewer">01/07/2024 - 07/07/2024</p>
    <input type="week" />
    <div class="calendar-container">
      <CalendarDay v-for="day in week" :day="day" />
    </div>

    <button @click="auth.logout">Logout</button>

    <div
      :class="{ 'clock-time-menu-open': clockTimeMenuButtonOpen }"
      class="open-clock-time-menu-button"
    >
      <div
        :class="{ 'clock-time-menu-option-1': clockTimeMenuButtonOpen }"
        class="clock-time-menu-option"
        @click="handleEditOneDayClicked"
      >
        <p>Eén dag</p>
      </div>
      <div
        :class="{ 'clock-time-menu-option-2': clockTimeMenuButtonOpen }"
        class="clock-time-menu-option"
        @click="handleEditWeekClicked"
      >
        <p>Meerdere dagen</p>
      </div>
      <img
        :class="{ 'plus-opened': clockTimeMenuButtonOpen }"
        alt="Add"
        src="@/assets/plus.png"
        @click="handleClockTimeMenuOpenButtonClicked"
      />
    </div>
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

.date-viewer {
  text-align: center;
}

.open-clock-time-menu-button {
  border-radius: 28px;
  width: 50px;
  height: 50px;
  margin: 0;
  position: fixed;
  bottom: 5vw;
  right: 5vw;
  border: 3px solid #a87676;
  background-color: #ffd0d0;
  transition-duration: 0.3s;
  transition-delay: 0.2s;

  img {
    width: 30px;
    height: 30px;
    padding: 10px;
    transition-duration: 0.3s;
    position: absolute;
    bottom: 0;
    right: 0;
  }
}

.plus-opened {
  transform: rotate(-45deg) scale(0.7);
}

.clock-time-menu-open {
  width: 90vw;
  height: 150px;
  transition-duration: 0.3s;
  transition-delay: 0s;
}

.clock-time-menu-option {
  opacity: 0;
  transition-duration: 0.2s;
  border: 2px solid #a87676;
  border-radius: 20px;
  margin: 8px 0 4px 8px;
  height: 59px;
  width: calc(90vw - 65px);
  display: flex;
  align-items: center;

  p {
    margin: 0 0 0 10px;
    padding: 0;
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
  }

  &:active {
    background-color: #a87676;
    color: white;
    transition-delay: 0s;
  }
}

.clock-time-menu-option-1 {
  opacity: 1;
  transition-delay: 0.3s;
  transition-duration: 0.2s;
}

.clock-time-menu-option-2 {
  opacity: 1;
  transition-delay: 0.4s;
  transition-duration: 0.2s;
}
</style>
