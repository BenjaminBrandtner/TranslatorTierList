<template>
    <div class="flex mr-3 lg:mr-0">
        <NavButton v-for="route in navRoutes" :to="route.path">{{ route.label }}</NavButton>
        <NavSubMenu>
            <NavSubMenuButton v-for="route in submenuRoutes" :to="route.path">{{ route.label }}</NavSubMenuButton>
        </NavSubMenu>
    </div>
</template>

<script>
  import NavButton from './NavButton.vue'
  import NavSubMenu from './NavSubMenu.vue'
  import NavSubMenuButton from './NavSubMenuButton.vue'
  import { navigableRoutes } from '../../router/router.js'
  import { computed, ref } from 'vue'

  export default {
    name: 'NavBar',
    components: { NavSubMenuButton, NavButton, NavSubMenu },
    setup () {
      let routes = navigableRoutes
      let width = ref(window.innerWidth)
      window.addEventListener('resize', () => width.value = window.innerWidth)

      let navRoutes = computed(() => {
        return _.filter(routes, route => route.inSubmenuUntil < width.value)
      })

      let submenuRoutes = computed(() => {
        return _.filter(routes, route => route.inSubmenuUntil >= width.value)
      })

      return {
        navRoutes,
        submenuRoutes
      }
    }
  }
</script>

<style>

</style>
