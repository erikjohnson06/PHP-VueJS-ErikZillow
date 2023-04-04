<template>

    <div>
        <span class="font-bold"> {{ listing.beds }} beds</span> <span class="text-gray-400"> | </span>
        <span class="font-bold"> {{ listing.baths }} baths </span> <span class="text-gray-400"> | </span>
        <span class="font-bold"> {{ listing.area }} sq. ft </span>
    </div>

</template>

<script setup>
    defineProps({
        listing: Object
    });
</script>