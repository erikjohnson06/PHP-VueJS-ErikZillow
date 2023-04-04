<template>
    <h1 class="text-3xl mb-4">My Listings</h1>
    <section class="mb-8">
        <RealtorFilters :filters="filters"/>
    </section>

    <section v-if="listings.data.length" class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        <Box v-for="item in listings.data"
             :key="item.id"
             :class="{'border-dashed' : item.deleted_at }">
            <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
                <div :class="{'opacity-25' : item.deleted_at}">

                    <div v-if="item.sold_at != null"
                         class="text-xs font-bold uppercase border border-dashed p-1 border-green-300 text-green-500 dark:border-green-600 dark:text-green-600 inline-block rounded-md mb-2"
                         >
                        Sold
                    </div>

                    <div class="xl:flex items-center gap-2">
                        <Price :price="item.price" class="text-2xl font-medium"/>
                        <ListingSpace :listing="item" />
                    </div>

                    <ListingAddress :listing="item" class="text-gray-500 "/>
                </div>

                <section>

                    <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">

                        <a
                            class="button-outline text-xs font-medium"
                            :href="route('listing.show', { id : item.id })"
                            target="_blank"
                            >
                            Preview
                        </a>

                        <Link class="button-outline text-xs font-medium"
                              :href="route('realtor.listing.edit', { id : item.id })"
                              >
                        Edit
                        </Link>

                        <div v-if="!item.deleted_at">

                            <Link
                                class="button-secondary text-xs font-medium"
                                :href="route('realtor.listing.destroy', {listing : item.id})"
                                method="delete"
                                as="button">
                            Unpublish
                            </Link>
                        </div>

                        <div v-else>

                            <Link
                                class="button-primary text-xs font-medium"
                                :href="route('realtor.listing.restore', {listing : item.id})"
                                method="put"
                                as="button">
                            Publish
                            </Link>

                            <Link
                                class="button-secondary text-xs font-medium ml-1"
                                :href="route('realtor.listing.delete', {listing : item.id})"
                                method="put"
                                as="button">
                            Delete
                            </Link>
                        </div>
                    </div>

                    <div class="mt-2" v-if="!item.deleted_at">
                        <Link
                            class="block w-full button-outline text-xs text-center font-medium"
                            :href="route('realtor.listing.image.create', {listing : item.id})"
                            >
                        Images ({{ item.images_count }})
                        </Link>
                    </div>

                    <div class="mt-2" v-if="!item.deleted_at">
                        <Link
                            class="block w-full button-outline text-xs text-center font-medium"
                            :href="route('realtor.listing.show', {id : item.id})"
                            >
                        Offers ({{ item.offers_count }})
                        </Link>
                    </div>
                </section>


            </div>
        </Box>
    </section>

    <EmptyState v-else>No Listings Yet</EmptyState>

    <section v-if="listings.data.length" class="w-full flex justify-center mt-4 mb-4">
        <Pagination :links="listings.links" />
    </section>
</template>

<script setup>

    import { Link } from '@inertiajs/vue3';
    import Box from '@/Components/UI/Box.vue';
    import EmptyState from '@/Components/UI/EmptyState.vue';
    import Pagination from '@/Components/UI/Pagination.vue';
    import Price from '@/Components/Price.vue';
    import ListingAddress from '@/Components/ListingAddress.vue';
    import ListingSpace from '@/Components/ListingSpace.vue';
    import RealtorFilters from '@/Pages/Realtor/Index/Components/RealtorFilters.vue';

    defineProps({
        listings: Object,
        filters: Object
    });

    document.title = "ErikZillow | My Listings";
</script>