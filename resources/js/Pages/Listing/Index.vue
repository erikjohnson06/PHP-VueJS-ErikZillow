<template>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <Listing v-for="item in listings" :key="item.id" :item="item" />

    </div>
</template>

<script setup>

    import Listing from '@/Pages/Listing/Index/Components/Listing.vue';

    defineProps({
        listings: Array
    });
</script>