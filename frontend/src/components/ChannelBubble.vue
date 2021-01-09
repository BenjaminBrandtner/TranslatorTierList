<template>
    <div class="inline-block relative m-2 font-roboto">
        <a :href="url" class="channelImageContainer">
            <img :src="profileImageUrl"
                 alt="Profile Image"
                 class="channelImage
                        text-dark-1 bg-white absolute
                        border-2 border-border-grey rounded-full">
        </a>
        <a :href="url"
           class="block
                  bg-white text-dark-1 text-14 whitespace-no-wrap
                  pt-1 lg:pt-2 pr-6
                  border border-border-grey rounded-t-full"
        >
            &nbsp; {{ name }}
        </a>
        <div :class="bgColorClass"
             class="flex py-1 pr-6
                    border border-border-grey rounded-b-full text-12"
        >
            &nbsp;
            <div v-if="subscribersCount" class="pill font-light mr-2">
                {{ format(subscribersCount) }}
            </div>
            <div v-if="goodEditor" class="pill mr-2">
                🎬
            </div>
            <div class="flex-1"/>
            <div v-if="mainFocusManual" class="pill ml-6 md:ml-8">
                {{ mainFocusManual }}
            </div>
        </div>
    </div>
</template>

<script>
  import { bgcolorClassForTier, format } from '../helpers/helpers.js'

  export default {
    name: 'ChannelBubble',
    props: {
      name: String,
      channelId: String,
      goodEditor: Boolean,
      mainFocusManual: String,
      profileImageUrl: String,
      subscribersCount: Number,
      tier: String
    },
    inheritAttrs: false,
    setup (props) {
      const url = 'https://www.youtube.com/channel/' + props.channelId

      return {
        bgColorClass: bgcolorClassForTier(props.tier),
        url,
        format
      }
    }
  }
</script>

<style>
    .channelImage {
        width: 66px;
        height: 66px;
    }

    .channelImageContainer ~ * {
        padding-left: 67px;
        height: 33px;
    }

    .text-12 {
        font-size: 11pt;
    }

    .text-14 {
        font-size: 12pt;
    }

    .pill {
        @apply border border-border-grey rounded-full bg-white text-dark-1 px-2 ;
    }

    @screen lg {
        .channelImage {
            width: 88px;
            height: 88px;
        }

        .channelImageContainer ~ * {
            padding-left: 89px;
            height: 44px;
        }

        .text-12 {
            font-size: 12pt;
        }

        .text-14 {
            font-size: 14pt;
        }

        .pill {
            @apply pt-1;
        }
    }

</style>
