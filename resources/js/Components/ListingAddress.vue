<template>

    <span>
        {{ listing.address }} {{ listing.city }}, {{ listing.state }}
    </span>

</template>

<script setup>
    defineProps({
        listing: Object
    });
</script>