<template>

    <Box>

        <template #header>Make an Offer</template>


        <div>

            <form @submit.prevent="makeOffer">
                <input
                    v-model="form.amount"
                    type="text"
                    class="input"
                    />

                <input
                    v-model="form.amount"
                    type="range"
                    :min="minPrice"
                    :max="maxPrice"
                    step="1000"
                    class="w-full h-4 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer mt-2"
                       />

                <button type="submit" class="button-outline w-full mt-2 text-sm">Make an Offer</button>

                {{ form.errors.amount }}
            </form>
        </div>


        <div class="flex justify-between text-gray-500 mt-2">
            <div>Difference from List Price</div>
            <div>
                <Price :price="difference" />
            </div>
        </div>

    </Box>
</template>

<script setup>

    import Box from '@/Components/UI/Box.vue';
    import Price from '@/Components/Price.vue';
    import { computed, watch } from 'vue';
    import { useForm } from '@inertiajs/vue3';
    import { debounce } from 'lodash';

    const props = defineProps({
        listingId:  Number,
        price:  Number
    });

    const form = useForm({
        amount: props.price
    });

    const makeOffer = () => form.post(
            route('listing.offer.store', { listing: props.listingId }),
        {
            preserveScroll: true,
            preserveState: true
        }
    );

    const difference = computed(() => form.amount - props.price);
    const minPrice = computed(() => Math.round(props.price / 2));
    const maxPrice = computed(() => Math.round(props.price * 2));

    const emit = defineEmits(['offerUpdated']);

    watch(() => form.amount,
        debounce((value) => emit('offerUpdated', value), 200)
            );
</script>
