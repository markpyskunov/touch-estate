import { createRouter, createWebHistory } from 'vue-router'
import DefaultLayout from '@/layouts/DefaultLayout.vue'
import Home from '@/pages/Home.vue'
import About from '@/pages/About.vue'
import NotFound from '@/pages/NotFound.vue'
import Property from '@/pages/RealEstate/Property.vue'
import LandingPageLayout from "@/layouts/LandingPageLayout.vue";
import VisitGuard from "@/pages/RealEstate/VisitGuard.vue";
import VisitVerification from "@/pages/RealEstate/VisitVerification.vue";

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
        path: ':pathMatch(.*)*',
        name: 'not-found',
        component: NotFound
      }
    ]
  },
    {
        path: '/real-estate',
        component: LandingPageLayout,
        children: [
            {
                path: 'visit',
                name: 'real-estate.visit',
                component: VisitGuard,
            },
            {
                path: 'verify',
                name: 'real-estate.verify',
                component: VisitVerification,
            },
            {
                path: 'property/:id',
                name: 'property.show',
                component: Property,
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

export default router
