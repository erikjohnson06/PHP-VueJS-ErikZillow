<template>
    <h1 class="text-3xl mb-4">My Listings</h1>
    <section class="mb-8">
        <RealtorFilters />
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        <Box v-for="item in listings" :key="item.id">
            <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
                <div>
                    <div class="xl:flex items-center gap-2">
                        <Price :price="item.price" class="text-2xl font-medium"/>
                        <ListingSpace :listing="item" />
                    </div>

                    <ListingAddress :listing="item" class="text-gray-500 "/>
                </div>
                <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">

                    <Link class="button-outline text-xs font-medium">Preview</Link>
                    <Link class="button-outline text-xs font-medium">Edit</Link>

                    <Link class="button-outline text-xs font-medium"
                        :href="route('realtor.listing.destroy', {listing : item.id})"
                        method="delete"
                        as="button">
                    Delete
                    </Link>

                </div>
            </div>
        </Box>
    </section>
</template>

<script setup>

    import {Link} from '@inertiajs/vue3';
    import Box from '@/Components/UI/Box.vue';
    import Pagination from '@/Components/UI/Pagination.vue';
    import Price from '@/Components/Price.vue';
    import ListingAddress from '@/Components/ListingAddress.vue';
    import ListingSpace from '@/Components/ListingSpace.vue';
    import RealtorFilters from '@/Pages/Realtor/Index/Components/RealtorFilters.vue';


    defineProps({
        listings: Array
    });

</script>