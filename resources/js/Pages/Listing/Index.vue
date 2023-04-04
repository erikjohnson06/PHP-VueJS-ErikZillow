<template>

    <Filters :filters="filters" />

    <div v-if="listings.data.length" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <Listing v-for="item in listings.data" :key="item.id" :item="item" />
    </div>

    <div v-else>
        No Results
    </div>

    <div v-if="listings.data.length" class="w-full flex justify-center mt-4 mb-4">
        <Pagination :links="listings.links" />
    </div>
</template>

<script setup>

    import Listing from '@/Pages/Listing/Index/Components/Listing.vue';
    import Pagination from '@/Components/UI/Pagination.vue';
    import Filters from '@/Components/Filters.vue';

    defineProps({
        listings: Object,
        filters: Object
    });

    document.title = "ErikZillow | Listings";
</script>