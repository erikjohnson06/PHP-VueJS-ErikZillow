<template>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <Box v-for="item in listings" :key="item.id">

            <div>
                <Link :href="route('listing.show', {id : item.id})">
                <ListingSpace :listing="item" class="text-lg" />
                <ListingAddress :listing="item" class="text-gray-500" />
                </Link>
            </div>

            <div>
                <Link :href="route('listing.edit', {id : item.id})">Edit</Link>
            </div>

            <div>
                <Link :href="route('listing.delete', {id : item.id})" method="DELETE" as="button">Delete</Link>
            </div>
        </Box>
    </div>
</template>

<script setup>

    import {Link} from '@inertiajs/vue3';
    import ListingSpace from '../../Components/ListingSpace.vue';
    import ListingAddress from '../../Components/ListingAddress.vue';
    import Box from '../../Components/UI/Box.vue';

    defineProps({
        listings: Array
    });
</script>