<template>
    <router-link active-class="" class="cursor-pointer w-64 min-w-64 h-16 min-h-16" to="/">
        <div class="flex justify-between">
            <svg height="2.3rem" viewBox="0 0 64.346 37.442" width="4rem" xmlns="http://www.w3.org/2000/svg">
                <path d="M60.011,6H9.335C5.851,6,3,8.05,3,10.555V37.887c0,2.505,2.851,4.555,6.335,4.555H60.011c3.484,0,6.335-2.05,6.335-4.555V10.555C66.346,8.05,63.5,6,60.011,6ZM9.335,24.221H22v4.555H9.335ZM41.008,37.887H9.335V33.331H41.008Zm19,0H47.342V33.331H60.011Zm0-9.11H28.338V24.221H60.011Z"
                      style="fill: none; stroke: var(--bright-1);"
                      transform="translate(-2.5 -5.5)"/>
            </svg>
            <p class="font-noto text-2xl">
                翻訳ティアリスト
            </p>
        </div>
        <p class="font-noto text-xl" style="letter-spacing: 0.2rem">
            Translator Tier List
        </p>
    </router-link>

    <div v-if="inDevelopment" class="mt-2 p-2 bg-yellow-400 text-black text-3xl font-medium">
        <span class=" xs:hidden">&lt;xs</span>
        <span class=" hidden xs:block sm:hidden">xs</span>
        <span class=" hidden sm:block md:hidden">sm</span>
        <span class=" hidden md:block lg:hidden">md</span>
        <span class=" hidden lg:block xl:hidden">lg</span>
        <span class=" hidden xl:block">xl</span>
    </div>
</template>

<script>
  export default {
    name: 'Logo',
    setup () {
      const inDevelopment = process.env.NODE_ENV === 'development'

      return {
        inDevelopment
      }
    }
  }

</script>

<style>
</style>

