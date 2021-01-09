<template>
    <router-link :class="expanded ? 'bg-dark-4' : 'bg-dark-3'"
                 class="flex flex-col justify-center
                        border border-border-grey
                        h-14 ml-1.5 px-6
                        hover:bg-dark-4
                        skewed-right">
        <span class="skewed-left mb-1 whitespace-no-wrap font-roboto">
            <slot></slot>
        </span>
    </router-link>
</template>

<script>
  export default {
    name: 'NavButton',
    props: ['expanded']
  }
</script>

<style scoped>
    .skewed-right {
        transition: padding 0.3s;
        transform: skewX(-20deg);
    }

    .skewed-left {
        transform: skewX(20deg);
    }

    .router-link-active {
        @apply bg-primary text-dark-1 px-16 font-bold;
    }

    .router-link-active:hover {
        @apply bg-primary;
    }
</style>
