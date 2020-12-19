<template>
    <div class="flex flex-col items-center">
        <details class="max-w-4xl inline-block bg-dark-3 border border-border-grey mb-2 mt-1 rounded-xl text-bright-1">
            <summary class="focus:outline-none px-2 py-1 cursor-pointer">Site Explanation</summary>
            <hr class="border-border-grey">
            <div class="px-2 py-1 text-sm">
                <site-explanation></site-explanation>
            </div>
        </details>
        <div class="max-w-4xl px-2 py-1 text-sm bg-dark-3 border border-border-grey mb-2 mt-1 rounded-xl text-bright-1">
            <h1 class="text-3xl font-medium">Who made this?</h1>
            <p>
                I made this. :) That's me, <a href="#">hiandbye</a>, a fledgling web developer from Germany, who fell
                into the VTuber rabbit hole circa March 2020. A couple months went by until I realized I wasn't gonna
                climb out anytime soon. So I decided to draw upon the power of the virtual world (lol) to create my
                first big web dev project.
            </p>

            <h1 class="text-3xl font-medium mt-4">How is it made?</h1>
            <p>
                A <a href="#">Laravel Backend</a> with a
                <a href="#">Vue3 Frontend</a> (built with the amazingly fast <a href="#">vite</a>) styled with
                <a href="#">Tailwind CSS</a>. <br>
                You can check out the code on <a href="#">Github</a>.
            </p>
            <h1 class="text-3xl font-medium mt-4">Planned Features</h1>
            <ul class="ml-6 list-disc">
                <li>Sorting and grouping by channel creation date</li>
                <li>Sorting and grouping by when a channel last posted a video</li>
                <li>Sorting and grouping by main focus</li>
            </ul>
            <h1 class="text-3xl font-medium mt-4">How can I help?</h1>
            <ul class="ml-6 list-disc">
                <li>
                    You can add Translation Channels that are not yet on this list or update information about those
                    that are.
                </li>
                <li>
                    If you can code, you can help implement <a href="">new features</a> or
                    <a href="#">fix issues</a>.
                </li>
                <li>
                    You could donate a couple bucks to me on <a href="#">Paypal</a>. The money will go towards keeping
                    the server running, the rest towards my superchat fund.
                </li>
            </ul>
            <h1 class="text-3xl font-medium mt-4">Anything else?</h1>
            <ul class="ml-6 list-disc">
                <li>
                    If you're an active or aspiring translator, check out
                    <a href="https://lyger.github.io/scripts/">Lyger's tips and guides</a>.
                </li>
                <li>
                    If you want to learn Japanese, check out <a href="#">these resources</a>.
                </li>
                <li>
                    <a href="https://youtu.be/VD_RwDFxf7o">World is Luna's</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
  import SiteExplanation from '../components/SiteExplanation.vue'

  export default {
    name: 'AboutView',
    components: { SiteExplanation }
  }
</script>

<style scoped>
    a {
        @apply underline text-blue-500;
    }
</style>
