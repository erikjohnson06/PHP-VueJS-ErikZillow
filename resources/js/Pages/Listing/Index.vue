<template>

    <div v-for="item in listings" :key="item.id">

        <div>
            <Link :href="route('listing.show', {id : item.id})">
                <ListingAddress :listing="item" />
            </Link>
        </div>

        <div>
            <Link :href="route('listing.edit', {id : item.id})">Edit</Link>
        </div>

        <div>
            <Link :href="route('listing.delete', {id : item.id})" method="DELETE" as="button">Delete</Link>
        </div>
    </div>
</template>

<script setup>

    import {Link} from '@inertiajs/vue3'
    import ListingAddress from '../../Components/ListingAddress.vue'

            defineProps({
                listings: Array
            });
</script>