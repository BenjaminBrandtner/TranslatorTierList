import { createRouter, createWebHistory } from 'vue-router'

import TierListView from '../views/TierListView.vue'
import SubCountView from '../views/SubCountView.vue'
import MainFocusView from '../views/MainFocusView.vue'
import AlphabeticallyView from '../views/AlphabeticallyView.vue'
import SettingsView from '../views/SettingsView.vue'
import AboutView from '../views/AboutView.vue'
import NotFoundView from '../views/NotFoundView.vue'

export const navigableRoutes = [
  {
    path: '/',
    component: TierListView,
    label: 'Tier List',
    inSubmenuUntil: 600
  },
  {
    path: '/subcount',
    component: SubCountView,
    label: 'Sub Count',
    inSubmenuUntil: 700
  },
  {
    path: '/mainfocus',
    component: MainFocusView,
    label: 'Main Focus',
    inSubmenuUntil: 900
  },
  {
    path: '/alphabetically',
    component: AlphabeticallyView,
    label: 'Alphabetically',
    inSubmenuUntil: 1100
  },
  {
    path: '/settings',
    component: SettingsView,
    label: 'Settings',
    inSubmenuUntil: 10000
  },
  {
    path: '/about',
    component: AboutView,
    label: 'About',
    inSubmenuUntil: 10000
  }
]

export const router = createRouter({
  history: createWebHistory(),
  routes: navigableRoutes.concat([
    {
      path: '/:catchAll(.*)',
      component: NotFoundView
    }
  ])
})
