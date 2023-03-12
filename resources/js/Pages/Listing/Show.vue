<template>

    <div>
        <ListingAddress :listing="listing" />
    </div>

</template>


<script setup>

    import {Link} from '@inertiajs/vue3'
    import ListingAddress from '../../Components/ListingAddress.vue'

    defineProps({
        listing: Object
    });
</script>