<template>
    <div class="lg:mx-10 xl:mx-24">
        <nav class="flex mt-1 mb-6">
            <logo/>
            <div class="flex-1 min-w-8"/>
            <nav-bar/>
        </nav>

        <div v-if="isLoading">
            <img alt="Loading..." class="mx-auto mt-12" src="/_assets/loading.svg">
        </div>
        <div v-else-if="error" class="mt-12 text-bright-1 font-medium text-2xl">
            {{ error }}
        </div>
        <div v-else>
            <router-view v-slot="{ Component }">
                <keep-alive>
                    <component :is="Component"/>
                </keep-alive>
            </router-view>
        </div>

        <div class="hidden xl:block fixed bottom-0 right-0 hover:opacity-25">
            <img :src="'/_assets/' + theme.name + '.png'" alt="">
        </div>
    </div>
</template>

<script>
  import { error, isLoading } from './store/store.js'
  import NavBar from './components/nav/NavBar.vue'
  import Logo from './components/Logo.vue'
  import colors from './colors.js'

  export default {
    name: 'App',
    components: { NavBar, Logo },

    setup () {
      let theme = colors[_.random(0, colors.length - 1)]
      document.documentElement.style.setProperty('--primary', theme.primary)
      document.documentElement.style.setProperty('--primary-background', theme.background)

      return {
        theme,
        error,
        isLoading
      }
    }
  }
</script>

<style>
    body {
        background: radial-gradient(ellipse, var(--primary-background), transparent 125%) no-repeat fixed;
    }
</style>
