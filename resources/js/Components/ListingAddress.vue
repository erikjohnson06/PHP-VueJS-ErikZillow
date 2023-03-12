<template>

    <span>
        {{ listing.address }} {{ listing.city }}, {{ listing.state }}

        ${{ listing.price }}
    </span>

</template>

<script setup>

    defineProps({
        listing: Object
    });

</script>