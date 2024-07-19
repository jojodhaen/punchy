import axiosInstance from '@/axiosInstance'
import router from '@/router'
import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useAuthStore = defineStore('auth', () => {
  const authenticated = ref(false)
  const user = ref({} as User)

  async function login(email: string, password: string) {
    await axiosInstance
      .get('/sanctum/csrf-cookie')
      .then(async () => {
        await axiosInstance
          .post('/api/login', {
            email: email,
            password: password
          })
          .then(() => {
            getUser()
          })
          .catch((error) => {
            console.error(error)
            user.value = {} as User
            authenticated.value = false
          })
      })
      .catch((error) => {
        console.error(error)
        user.value = {} as User
        authenticated.value = false
      })
  }

  async function logout() {
    await axiosInstance
      .post('/api/logout')
      .then(() => {
        authenticated.value = false
        user.value = {} as User
        router.replace({ name: 'Login' })
      })
      .catch((error) => {
        console.error(error)
      })
  }

  async function register(firstName: string, lastName: string, email: string, password: string) {
    await axiosInstance
      .post('/api/register', {
        first_name: firstName,
        last_name: lastName,
        email: email,
        password: password
      })
      .then(() => {
        login(email, password)
      })
      .catch((error) => {
        console.error(error)
      })
  }

  async function getUser() {
    await axiosInstance
      .get('/api/user')
      .then((response) => {
        user.value = response.data
        authenticated.value = true
        router.replace({ name: 'Home' })
      })
      .catch((error) => {
        user.value = {} as User
        authenticated.value = false
      })
  }

  return { authenticated, user, login, logout, register, getUser }
})
