<template>

    <Box>

        <div>
            <Link :href="route('listing.show', {id : item.id})">

            <div class="flex items-center gap-1">
                <Price :price="item.price" class="text-2xl font-bold" />
                <div class="text-xs text-gray-500">
                    <Price :price="monthlyPayment" /> / month
                </div>
            </div>

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
</template>

<script setup>

    import {Link} from '@inertiajs/vue3';
    import ListingSpace from '@/Components/ListingSpace.vue';
    import ListingAddress from '@/Components/ListingAddress.vue';
    import Price from '@/Components/Price.vue';
    import Box from '@/Components/UI/Box.vue';

    import {useMonthlyPayment} from '@/Composables/useMonthlyPayment';

    const props = defineProps({
        item: Object
    });

    const { monthlyPayment } = useMonthlyPayment(props.item.price, 3.0, 30);
</script>
