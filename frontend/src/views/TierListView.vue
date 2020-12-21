<template>
    <details class="max-w-4xl inline-block bg-dark-3 border border-border-grey mt-1 rounded-xl text-bright-1">
        <summary class="focus:outline-none px-2 py-1 cursor-pointer">Click me for an explanation</summary>
        <hr class="border-border-grey">
        <div class="px-2 py-1">
            <site-explanation></site-explanation>
        </div>
    </details>

    <filter-bar class="mt-4"/>

    <div v-if="noChannels" class="mt-4 text-bright-1 font-medium text-xl">
        No channels match your filter criteria.
    </div>
    <div v-else class="mt-4">
        <TierBox v-for="tier in tiers" v-bind="tier"></TierBox>
    </div>
</template>

<script>
  import { filteredChannels, tieredChannels } from '../store/store.js'
  import FilterBar from '../components/FilterBar.vue'
  import SiteExplanation from '../components/SiteExplanation.vue'
  import TierBox from '../components/TierBox.vue'
  import { computed } from 'vue'

  export default {
    name: 'TierListView',
    components: { FilterBar, SiteExplanation, TierBox },
    setup () {
      const tiers = [
        {
          tier: 'S',
          name: 'Natural Translation',
          explanation: 'A natural translation reads like a <b>fluent English monolog/dialog</b>. Creating these is no easy feat, as it requires mastery of the English language and a <b>feel for how people talk.</b>',
          channels: tieredChannels['S']
        },
        {
          tier: 'A',
          name: 'Good Translation',
          explanation: 'A good translation may have small grammatical errors or sound slightly off, but still <b>easily gets the point across.</b>',
          channels: tieredChannels['A']
        },
        {
          tier: 'B',
          name: 'Okay Translation',
          explanation: 'An okay translation <b>sounds unnatural</b> or is occasionally <b>hard to understand.</b>',
          channels: tieredChannels['B']
        },
        {
          tier: 'C',
          name: 'Meh Translation',
          explanation: 'A meh translation has bad grammar, weird sentence structure, leaves many things untranslated or has mistranslations. They require <b>extra effort</b> from the viewer to <b>decipher.</b>',
          channels: tieredChannels['C']
        },
        {
          tier: 'U',
          name: 'Uncategorized',
          explanation: 'Translation Quality has not been evaluated yet.',
          channels: tieredChannels['U']
        }
      ]

      const noChannels = computed(() => _.isEmpty(filteredChannels.value))

      return {
        tiers,
        noChannels
      }
    }
  }
</script>