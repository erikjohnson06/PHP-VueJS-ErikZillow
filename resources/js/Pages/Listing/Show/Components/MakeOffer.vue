<template>

    <Box>

        <template #header>Make an Offer</template>


        <div>

            <form>
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

                <button type="submit" class="button-outline w-full mt-2 text-sm"></button>
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
    import {computed} from 'vue';
    import {useForm} from '@inertiajs/vue3';

    const props = defineProps({
        listingId:  Number,
        price:  Number
    });

    const form = useForm({
        amount: props.price
    });

    const difference = computed(() => form.amount - props.price);
    const minPrice = computed(() => Math.ceil(props.price / 2));
    const maxPrice = computed(() => Math.ceil(props.price * 2));


//    import {Link, usePage} from '@inertiajs/vue3';
//    import {computed} from 'vue';
//    import ListingSpace from '@/Components/ListingSpace.vue';
//    import ListingAddress from '@/Components/ListingAddress.vue';
//    import Price from '@/Components/Price.vue';
//    import Box from '@/Components/UI/Box.vue';
//    import {useMonthlyPayment} from '@/Composables/useMonthlyPayment';
//

//
//    const { monthlyPayment } = useMonthlyPayment(props.item.price, 3.0, 30);
//
//    const user = computed(
//        () => usePage().props.user
//    );
</script>
