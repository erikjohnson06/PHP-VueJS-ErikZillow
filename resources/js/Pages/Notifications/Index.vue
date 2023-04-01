<template>

    <h1 class="text-3xl mb-4">Notifications</h1>

    <section v-if="notifications.data.length" class="text-gray-700 dark:text-gray-400">

        <div v-for="notification in notifications.data"
             :key="notification.id"
             class="border-b border-gray-200 dark:border-gray-800 py-4 flex justify-between items-center">

            <div>
                <span v-if="notification.type === 'App\\Notifications\\OfferMade'">
                    Offer for
                    <Link :href="route('realtor.listing.show', {listing: notification.data.listing_id})"
                          class="text-indigo-600 dark:text-indigo-400"
                          >Listing #{{ notification.data.listing_id  }}</Link> was made:

                    <Price  :price="notification.data.amount" />
                </span>
            </div>

            <div>
                <Link v-if="!notification.read_at"
                      :href="route('notification.update', {notification: notification.id})"
                      as="button"
                      method="PUT"
                      class="button-outline text-xs font-medium uppercase">
                Mark as Read
                </Link>
            </div>
        </div>

    </section>

    <EmptyState v-else>No Notifications Yet</EmptyState>

    <section v-if="notifications.data.length" class="w-full flex justify-center mt-8 mb-8">
        <Pagination :links="notifications.links" />
    </section>

</template>

<script setup>

    import { Link } from '@inertiajs/vue3';
    import EmptyState from '@/Components/UI/EmptyState.vue';
    import Pagination from '@/Components/UI/Pagination.vue';
    import Price from '@/Components/Price.vue';

    defineProps({
        notifications : Object
    });
</script>