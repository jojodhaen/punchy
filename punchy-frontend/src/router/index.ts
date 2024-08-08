import { useAuthStore } from '@/stores/auth'
import EditWeekView from '@/views/authenticated/EditWeekView.vue'
import HoursOverviewView from '@/views/authenticated/HoursOverviewView.vue'
import SettingsView from '@/views/authenticated/SettingsView.vue'
import LoginView from '@/views/unauthenticated/LoginView.vue'
import NewUserView from '@/views/unauthenticated/NewUserView.vue'
import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/authenticated/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
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
      path: '/',
      name: 'Home',
      component: HomeView,
      meta: {
        needsAuth: true
      }
    },
    {
      path: '/hours-overview',
      name: 'HoursOverview',
      component: HoursOverviewView,
      meta: {
        needsAuth: true
      }
    },
    {
      path: '/edit-week',
      name: 'EditWeek',
      component: EditWeekView,
      meta: {
        needsAuth: true
      }
    },
    {
      path: '/settings',
      name: 'Settings',
      component: SettingsView,
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
    next({ name: from.name })
  } else {
    next()
  }
})

export default router
