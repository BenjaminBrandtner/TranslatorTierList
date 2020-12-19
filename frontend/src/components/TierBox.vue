<template>
    <div v-if="!noChannels" class="mb-8 min-h-32 md:min-h-48 border border-border-grey">
        <div :class="bgColorClass" class="flex items-center justify-center
                                          float-left mb-4 mr-4
                                          font-baskerville text-border text-xxl
                                          border border-border-grey w-32 h-32 md:w-48 md:h-48">
            {{ tier }}
        </div>
        <div class="bg-dark-2 min-h-32 md:min-h-48">
            <details :class="bgColorClass" class="inline-block mb-2 mt-1 rounded-xl text-dark-1">
                <summary class="focus:outline-none px-2 py-1 cursor-pointer">{{ name }}</summary>
                <hr class="border-dark-1">
                <p class="w-48  md:w-120  sm:w-112 xs:w-80 px-2 py-1 text-sm" v-html="explanation"></p>
            </details>
            <div>
                <ChannelBubble v-for="channel in channels.value" :key="channel.id" v-bind="channel"/>
            </div>
        </div>
    </div>
</template>

<script>
  import { computed } from 'vue'
  import { bgcolorClassForTier } from '../helpers/helpers.js'
  import ChannelBubble from './ChannelBubble.vue'

  export default {
    name: 'TierBox',
    components: { ChannelBubble },
    props: {
      tier: String,
      name: String,
      explanation: String,
      channels: Object
    },
    setup (props) {
      const noChannels = computed(() => _.isEmpty(props.channels.value))

      return {
        bgColorClass: bgcolorClassForTier(props.tier),
        noChannels
      }
    }
  }
</script>

<style>
    .text-border {
        text-shadow: -1px -1px 0 #000,
        1px -1px 0 #000,
        -1px 1px 0 #000,
        1px 1px 0 #000;
    }

    .text-xxl {
        font-size: 6rem;
        font-weight: bold;
    }

    @screen md {
        .text-xxl {
            font-size: 9rem;
            font-weight: bold;
        }
    }

    details.bg-u-tier {
        @apply text-bright-1;

    }

    details.bg-u-tier hr {
        @apply border-bright-1;
    }
</style>
