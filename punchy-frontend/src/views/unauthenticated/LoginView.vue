<script lang="ts" setup>
import TextField from '@/components/TextField.vue'
import router from '@/router'
import { useAuthStore } from '@/stores/auth'
import { ref } from 'vue'

const auth = useAuthStore()

const email = ref('')
const password = ref('')

const handleSubmit = (event: Event) => {
  event.preventDefault()
  auth.login(email.value, password.value)
}

const handleNoAccount = () => {
  console.log('No account?')
  router.replace('/new-user')
}
</script>

<template>
  <div class="container">
    <div>
      <h1>PUNCHY</h1>
      <form v-on:submit="handleSubmit">
        <TextField v-model="email" name="email" type="email" />
        <TextField v-model="password" name="wachtwoord" type="password" />
        <button type="submit">LOG IN</button>
      </form>
    </div>

    <footer>
      <a @click="handleNoAccount">Nog geen account? Maak er een!</a>
    </footer>
  </div>
</template>

<style scoped>
.container {
  display: flex;
  flex-direction: column;
  justify-content: space-around;
  height: 100dvh;
}

h1 {
  font-family: 'Bodoni Moda SC', serif;
  font-size: 3rem;
  font-weight: 1000;
  padding-left: 2rem;
}

form {
  display: flex;
  flex-direction: column;
  padding: 2rem;
}

button {
  font-family: 'Bodoni Moda SC', serif;
  font-size: 1.2rem;
  font-weight: 1000;
  padding: 0.5rem;
  border: 3px solid #a87676;
  border-radius: 0.5rem;
  background-color: #ffd0d0;
  color: black;
  width: 200px;
  margin: 1rem auto;
}

button:active {
  background-color: #a87676;
  color: white;
}

footer {
  display: flex;
  justify-content: center;

  a {
    font-family: 'Bodoni Moda SC', serif;
    font-size: 1rem;
    font-weight: 400;
    color: black;
    text-decoration: underline;
  }
}
</style>
