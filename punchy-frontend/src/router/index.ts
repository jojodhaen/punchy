import { useAuthStore } from '@/stores/auth'
import LoginView from '@/views/LoginView.vue'
import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'Home',
      component: HomeView
    },
    {
      path: '/login',
      name: 'Login',
      component: LoginView
    },
    {
      path: '/about',
      name: 'About',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    }
  ]
})

router.beforeEach(async (to, from, next) => {
  const auth = useAuthStore()

  if (!auth.authenticated) {
    await auth.getUser().finally(() => {
      if (to.name !== 'Login' && !auth.authenticated) {
        next({ name: 'Login' })
      } else next()
    })
  } else if (to.name === 'Login' && auth.authenticated) {
    next({ name: 'from' })
  } else {
    next()
  }
})

export default router
