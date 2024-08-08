<script lang="ts" setup>
import router from '@/router'
import { useRouter } from 'vue-router'
</script>

<template>
  <div class="bottom-navigation-container">
    <div class="bottom-navigation-button" @click="router.replace('/')">
      <OhVueIcon
        v-if="useRouter().currentRoute.value.name == 'Home'"
        color="#FFD0D0"
        name="md-home"
        scale="1.8"
      />
      <OhVueIcon v-else color="#FFD0D0" name="md-home-outlined" scale="1.8" />
    </div>

    <div class="bottom-navigation-button" @click="router.replace('hours-overview')">
      <OhVueIcon color="#FFD0D0" name="fa-business-time" scale="1.9" />
    </div>

    <div class="bottom-navigation-button" @click="router.replace('edit-week')">
      <OhVueIcon
        v-if="useRouter().currentRoute.value.name == 'EditWeek'"
        color="#FFD0D0"
        name="md-editcalendar"
        scale="1.7"
      />
      <OhVueIcon v-else color="#FFD0D0" name="md-editcalendar-outlined" scale="1.7" />
    </div>

    <div class="bottom-navigation-button" @click="router.replace('settings')">
      <OhVueIcon
        v-if="useRouter().currentRoute.value.name == 'Settings'"
        color="#FFD0D0"
        name="md-accountcircle"
        scale="1.8"
      />
      <OhVueIcon v-else color="#FFD0D0" name="md-accountcircle-outlined" scale="1.8" />
    </div>
  </div>
</template>

<style scoped>
.bottom-navigation-container {
  position: fixed;
  bottom: 0;
  right: 0;
  left: 0;
  background-color: #a87676;
  height: 80px;
  border-top-left-radius: 20px;
  border-top-right-radius: 20px;
  display: flex;
  flex-direction: row;
  justify-content: space-around;
}

.bottom-navigation-button {
  width: 25%;
  height: 70%;
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
