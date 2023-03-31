<template>

    <Box>
        <template #header>
            Offer #{{ offer.id }}
            <span v-if="offer.accepted_at"
                  class="dark:bg-green-900 dark:text-green-200 bg-green-200 text-green-900 p-1 rounded-md uppercase ml-1"
            >
                Accepted</span>
        </template>

        <section class="flex items-center justify-between">
            <div>
                <Price :price="offer.amount" class="text-xl" />

                <div class="text-gray-500">
                    Difference: <Price :price="difference" />
                </div>

                <div class="text-gray-500 text-sm">
                    Made By: {{ offer.bidder.name }}
                </div>

                <div class="text-gray-500 text-sm">
                    Created: {{ madeOn }}
                </div>
            </div>

            <div>
                <Link
                    v-if="notSold"
                    :href="route('realtor.offer.accept', { offer: offer.id })"
                    class="button-outline text-xs font-medium"
                    as="button"
                    method="PUT"
                    >
                Accept
                </Link>
            </div>
        </section>
    </Box>
</template>

<script setup>

    import { Link } from '@inertiajs/vue3';
    import Box from '@/Components/UI/Box.vue';
//    import Pagination from '@/Components/UI/Pagination.vue';
    import Price from '@/Components/Price.vue';
//    import ListingAddress from '@/Components/ListingAddress.vue';
//    import ListingSpace from '@/Components/ListingSpace.vue';
//    import RealtorFilters from '@/Pages/Realtor/Index/Components/RealtorFilters.vue';
    import { computed } from 'vue';

    const props = defineProps({
        offer: Object,
        listingPrice: Number
    });

    const difference = computed(
            () => props.offer.amount - props.listingPrice
    );

    const madeOn = computed(
            () => new Date(props.offer.created_at).toDateString()
    );

    const notSold = computed(
            () => !props.offer.accepted_at && !props.offer.rejected_at
    );

</script>