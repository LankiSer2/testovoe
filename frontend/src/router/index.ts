import { createRouter, createWebHistory } from 'vue-router'
import RegistrationView from '@/modules/user/views/RegistrationView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'registration',
      component: RegistrationView,
    },
    {
      path: '/profile',
      name: 'profile',
      component: () => import('@/modules/user/views/ProfileView.vue'),
    },
  ],
})

export default router
