<template>
    <div class="relative">
        <NavButton :expanded="expanded" active-class="" to="#" @click="expand">...</NavButton>

        <div v-if="expanded" class="absolute" style="right: 0.6rem; top: 3.5rem">
            <slot></slot>
        </div>

    </div>
</template>

<script>
  import { ref } from 'vue'
  import NavButton from './NavButton.vue'

  export default {
    name: 'NavSubMenu',
    components: { NavButton },
    setup () {
      let expanded = ref(false)

      function expand (e) {
        e.stopPropagation()
        document.addEventListener('click',
          () => expanded.value = false,
          { once: true })
        expanded.value = true
      }

      return {
        expanded,
        expand
      }
    }
  }
</script>

<style>
</style>
