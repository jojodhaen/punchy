import { useAuthStore } from '@/stores/auth'
import EditDayView from '@/views/authenticated/EditDayView.vue'
import EditWeekView from '@/views/authenticated/EditWeekView.vue'
import LoginView from '@/views/unauthenticated/LoginView.vue'
import NewUserView from '@/views/unauthenticated/NewUserView.vue'
import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/authenticated/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'Home',
      component: HomeView,
      meta: {
        needsAuth: true
      }
    },
    {
      path: '/login',
      name: 'Login',
      component: LoginView,
      meta: {
        needsAuth: false
      }
    },
    {
      path: '/new-user',
      name: 'NewUser',
      component: NewUserView,
      meta: {
        needsAuth: false
      }
    },
    {
      path: '/edit-day',
      name: 'AddDay',
      component: EditDayView,
      meta: {
        needsAuth: true
      }
    },
    {
      path: '/edit-week',
      name: 'AddWeek',
      component: EditWeekView,
      meta: {
        needsAuth: true
      }
    }
  ]
})

router.beforeEach(async (to, from, next) => {
  const auth = useAuthStore()

  if (!auth.authenticated) {
    await auth.getUser().finally(() => {
      if (!auth.authenticated && to.meta.needsAuth) {
        next({ name: 'Login' })
      } else next()
    })
  } else if (auth.authenticated && !to.meta.needsAuth) {
    next({ name: 'from' })
  } else {
    next()
  }
})

export default router
