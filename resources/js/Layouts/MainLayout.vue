<template>

    <Link :href="route('listings.all')">Listings</Link> &nbsp;
    <Link :href="route('listing.create')">New Listing</Link>

    <!-- <div>Timer:  {{ timer }}</div>-->

    <div v-if="flashSuccess" class="success">
        {{ flashSuccess }}
    </div>

    <slot>Default</slot>
</template>

<script setup>

    import {Link, usePage} from '@inertiajs/vue3'
    import {computed} from 'vue'



    // page.props.value.flash.success
    const page = usePage();
    console.log(page);

    const flashSuccess = computed(
        () => usePage().props.flash.success
    )


    //const timer = ref(0);
    //setInterval(() => timer.value++, 1000);

</script>

<style scoped>

    .success {
        background-color: green;
        color: white;
    }
 </style>