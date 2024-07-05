import { useAuthStore } from '@/stores/auth'
import LoginView from '@/views/LoginView.vue'
import NewUserView from '@/views/NewUserView.vue'
import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

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
      path: '/about',
      name: 'About',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue'),
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
