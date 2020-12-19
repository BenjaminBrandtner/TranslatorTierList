<template>
    <h1 class="font-medium text-3xl">What is this site?</h1>
    <p>
        A place to share and discover Youtube channels that translate content from
        <a href="https://en.wikipedia.org/wiki/Virtual_YouTuber">Virtual Youtubers</a>.
        <br>
        The <span class="text-primary">quality of their translations</span> are rated by the community and categorized
        into different <span class="text-primary">tiers</span>.
    </p>

    <h2 class="font-medium text-2xl mt-3">Neue Überschrift</h2>
    <ul class="ml-6 list-disc">
        <li>
            Channels that go above and beyond with
            <span class="text-primary">video editing</span> are marked with this symbol: 🎬. <br>
        </li>
        <li>
            If a channel mostly posts videos about one specific VTuber or group of VTubers, it is indicated as their
            <span class="text-primary">main focus</span> with a name or emoji.
        </li>
        <li>
            Channels can be sorted and filtered by number of subscribers, to find the hardworking gems that deserve more
            viewers.
        </li>
    </ul>

    <h2 class="font-medium text-2xl mt-3">Why?</h2>
    <p>
        I want you to be aware of the danger of <span class="text-primary">mistranslations</span> and the
        <a href="https://lyger.github.io/scripts/vtuber/translating.html">consequences</a> they can have.
        They are more common across channels with low quality translations, but are not exclusive to them.
        <br>
        However, I absolutely <span class="text-primary">don't</span> mean to belittle the
        <span class="text-primary">effort</span> of channels placed in a lower tier. I love everyone who allows me to
        enjoy VTubers that I otherwise wouldn't be
        able to understand!</p>
</template>

<script>
  export default {
    name: 'SiteExplanation'
  }
</script>

<style scoped>
    a {
        @apply underline text-blue-500;
    }
</style>
