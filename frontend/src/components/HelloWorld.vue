<template>
    <h1>{{ msg }}</h1>
    <button @click="getData">Get Data</button>
    <p>
        <code>{{ dataComputed }}</code>
    </p>
    <teleport to="#logo-target">
        I'm a genius
    </teleport>
</template>

<script>
  import { computed, ref } from 'vue'

  export default {
    name: 'HelloWorld',
    props: {
      msg: String
    },
    async setup (props, context) {
      console.log(props, context)
      const data = ref('Empty')
      const dataComputed = computed(() => data.value + ', you know?')

      async function getData () {
        try {
          const response = await axios.get(import.meta.env.VITE_TTL_BASE_URL + '/api/test')
          data.value = response.data
        } catch (error) {
          data.value = 'Couldn\'t get data :( '
        }
      }

      await getData()

      return {
        dataComputed,
        getData
      }
    }
  }
</script>
