import { createRouter, createWebHistory } from 'vue-router'
import DefaultLayout from '@/layouts/DefaultLayout.vue'
import Home from '@/pages/Home.vue'
import About from '@/pages/About.vue'
import NotFound from '@/pages/NotFound.vue'
import Listing from '@/pages/RealEstate/Listing.vue'
import LandingPageLayout from "@/layouts/LandingPageLayout.vue";

console.log('Router module loaded') // Debug point 1

const routes = [
  {
    path: '/',
    component: DefaultLayout,
    children: [
      {
        path: '',
        name: 'home',
        component: Home
      },
      {
        path: 'about',
        name: 'about',
        component: About
      },
      {
        path: 'listing/:id',
        name: 'listing',
        component: Listing,
        props: true
      },
      {
        path: ':pathMatch(.*)*',
        name: 'not-found',
        component: NotFound
      }
    ]
  },
    {
        path: '/',
        component: LandingPageLayout,
        children: [
            {
                path: 'listing/:id',
                name: 'listing',
                component: Listing,
                props: true
            },
            {
                path: ':pathMatch(.*)*',
                name: 'not-found',
                component: NotFound
            }
        ]
    }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

console.log('Router created with routes:', routes) // Debug point 2

// Add navigation guard for debugging
router.beforeEach((to, from, next) => {
  console.log('Navigation guard triggered:', {
    to: to.path,
    from: from.path,
    matched: to.matched.map(route => route.path)
  })
  next()
})

// Add afterEach hook for debugging
router.afterEach((to, from) => {
  console.log('Navigation completed:', {
    to: to.path,
    from: from.path
  })
})

export default router
