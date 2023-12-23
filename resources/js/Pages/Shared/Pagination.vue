<script setup>
defineProps({
    links: Array,
})
</script>

<template>
    <div>
        <Component
            :is="link.url? 'Link' : 'span'"
            v-for="link in links"
            :href="link.url"
            v-html="link.label"
            class="px-2"
            :class="{'text-grey-400': ! link.url, 'font-bold text-blue-500 underline': link.active}"
        ></Component>
    </div>
</template>
