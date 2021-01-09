<template>
    <router-link class="flex flex-col justify-center items-center
                        border border-border-grey
                        h-14 mt-1 px-6
                        bg-dark-4 hover:bg-dark-5">
        <span class="mb-1 whitespace-no-wrap font-roboto">
            <slot></slot>
        </span>
    </router-link>

</template>

<script>
  export default {
    name: 'NavSubMenuButton'
  }
</script>

<style scoped>
    .router-link-active {
        @apply bg-primary text-dark-1 font-bold;
    }

    .router-link-active:hover {
        @apply bg-primary;
    }

</style>
