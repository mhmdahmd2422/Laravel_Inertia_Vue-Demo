<script setup>

defineProps({
    active: Boolean,
})
</script>

<template>
    <Link href="/"
          class="text-black hover:underline"
          :class="{'font-bold underline': active}"
    >
        <slot/>
    </Link>
</template>
