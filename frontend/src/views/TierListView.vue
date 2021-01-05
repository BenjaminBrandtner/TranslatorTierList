<template>
    <details v-if="showSiteExplanation"
             class="max-w-4xl inline-block mt-1
                    border border-border-grey rounded-xl
                    bg-dark-3 text-bright-1">
        <summary class="focus:outline-none px-2 py-1 cursor-pointer"
                 @click="showSiteExplanationCloseButton = true">
            <span class="mr-2">Click me for an explanation</span>
            <close-icon v-if="showSiteExplanationCloseButton"
                        class="inline align-middle float-right
                               cursor-pointer hover:text-primary"
                        @click="showSiteExplanation = false"/>
        </summary>
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
  import {
    filteredChannels,
    showSiteExplanation,
    showSiteExplanationCloseButton,
    tieredChannels
  } from '../store/store.js'
  import FilterBar from '../components/FilterBar.vue'
  import SiteExplanation from '../components/SiteExplanation.vue'
  import TierBox from '../components/TierBox.vue'
  import CloseIcon from '../components/icons/CloseIcon.vue'
  import { computed } from 'vue'

  export default {
    name: 'TierListView',
    components: { FilterBar, SiteExplanation, TierBox, CloseIcon },
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
          explanation: 'A good translation <b>has no mistranslations</b>. It may have small grammatical errors or sound slightly off, but still <b>easily gets the point across.</b>',
          channels: tieredChannels['A']
        },
        {
          tier: 'B',
          name: 'Okay Translation',
          explanation: 'An okay translation <b>has mistranslations</b> or it <b>sounds unnatural</b> and is occasionally <b>hard to understand.</b>',
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
        noChannels,
        showSiteExplanation,
        showSiteExplanationCloseButton
      }
    }
  }
</script>
