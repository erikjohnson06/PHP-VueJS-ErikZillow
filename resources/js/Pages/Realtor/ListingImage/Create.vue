<template>
    <form
        method="POST"
        enctype="multipart/form-data"
        :action="route('realtor.listing.image.store', {listing: listing.id})">
        <input
            type="file"
            multiple
            name="images[]"
            />
        <button type="submit">Upload</button>
    </form>
</template>

<script setup>

    defineProps(
        {listing : Object}
    );


//    import {useForm} from '@inertiajs/vue3';
//    //import {Inertia} from '@inertiajs/inertia'
//    //import {reactive} from 'vue'
//
//    const form = useForm({
//        beds: 0,
//        baths: 0,
//        area: 0,
//        address: null,
//        city: null,
//        state: "",
//        zip: null,
//        price: 0,
//        comments: null
//    });
//
//    const create = () => form.post(route('realtor.listing.store'));

</script>