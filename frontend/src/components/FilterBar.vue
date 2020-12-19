<template>
    <div id="filterBar" class="flex flex-wrap">
        <label>Name <input v-model="filters.name" dusk="filter-name" type="text"> </label>
        <label>
            Tier
            <select v-model="filters.tier">
                <option v-for="option in tierOptions" :value="option.value">{{ option.text }}</option>
            </select>
        </label>
        <label>Subscribers
            <select v-model="filters.subscribers">
                <option v-for="option in subscribersOptions" :value="option.value">{{ option.text }}</option>
            </select>
        </label>
        <label>
            Main Focus
            <select v-model="filters.mainFocus">
                <option v-for="option in mainFocusOptions" :value="option.value">{{ option.text }}</option>
            </select>
        </label>
        <label class="border-t border-transparent">
            Great Editor <input v-model="filters.greatEditor" type="checkbox"></label>
        <label>
            Sorting
            <select v-model="filters.sorting">
                <option v-for="option in sortingOptions" :value="option.value">{{ option.text }}</option>
            </select>
        </label>
    </div>
</template>

<script>
  import { filters } from '../store/store.js'

  export default {
    name: 'FilterBar',
    setup () {
      const format = (number) => number.toLocaleString()

      const tierOptions = [
        {
          value: 'all',
          text: 'All'
        },
        {
          value: 'S',
          text: 'S'
        },
        {
          value: 'A',
          text: 'A'
        },
        {
          value: 'B',
          text: 'B'
        },
        {
          value: 'C',
          text: 'C'
        },
        {
          value: 'U',
          text: 'U'
        }
      ]

      const subscribersOptions = [
        {
          value: 'all',
          text: 'All'
        },
        {
          value: c => c <= 5000,
          text: `< ${format(5000)}`
        },
        {
          value: c => c > 5000 && c <= 15000,
          text: `${format(5000)} - ${format(15000)}`
        },
        {
          value: c => c > 15000 && c <= 50000,
          text: `${format(15000)} - ${format(50000)}`
        },
        {
          value: c => c > 50000 && c <= 100000,
          text: `${format(50000)} - ${format(100000)}`
        },
        {
          value: c => c > 100000,
          text: `> ${format(100000)}`
        }
      ]

      const mainFocusOptions = [
        {
          value: 'all',
          text: 'All'
        },
        {
          value: null,
          text: 'Coming Soon!'
        }
      ]

      const sortingOptions = [
        {
          value: 'alphabetically',
          text: 'Alphabetically'
        },
        {
          value: 'subscribers',
          text: 'Subscribers'
        },
        {
          value: 'mainFocus',
          text: 'Main Focus'
        }
      ]

      return {
        filters,
        tierOptions,
        subscribersOptions,
        mainFocusOptions,
        sortingOptions
      }
    }
  }
</script>

<style>
    select, input {
        @apply bg-dark-3 px-1 border border-border-grey outline-none mr-4;
    }

    #filterBar label {
        @apply mt-2;
    }
</style>
