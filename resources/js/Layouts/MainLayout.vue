<template>

    <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 w-full">

        <div class="container mx-auto p-4 w-full">
            <nav class="p-4 flex items-center justify-between">
                <div class="text-lg font-medium">
                    <Link :href="route('listing.index')">Listings</Link>
                </div>
                <div class="inline-flex flex-nowrap items-center text-xl text-indigo-600 dark:text-indigo-300 font-bold text-center">
                    <Link  :href="route('listing.index')">
                        <img class="inline-block h-8 align-bottom"
                             src="/assets/erikzillow_logo.png"
                             alt="Logo"
                             />
                        ErikZillow
                    </Link>
                </div>
                <div v-if="user" class="flex items-center gap-4">

                    <Link :href="route('notification.index')"
                          class="text-gray-500 relative pr-2 py-2 text-lg">

                    &#128276;

                    <div v-if="notificationCount"
                         class="absolute right-0 top-0 w-5 bg-red-700 dark:bg-red-400 text-white font-medium border border-white dark:border-gray-900 rounded-full text-xs text-center">
                        {{ notificationCount }}
                    </div>
                    </Link>

                    <Link :href="route('realtor.listing.index')" class="text-sm text-gray-500">{{ user.name }}</Link>
                    <Link :href="route('realtor.listing.create')" class="button-primary">+ New Listing</Link>
                    <div>
                        <Link :href="route('logout')" as='button'>Logout</Link>
                    </div>
                </div>
                <div v-else class="flex items-center gap-2">
                    <Link :href="route('register')">Register</Link>
                    <Link :href="route('login')">Sign In</Link>
                </div>
            </nav>
        </div>

    </header>

    <main class="container mx-auto p-4">

        <div v-if="flashSuccess" class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2">
            {{ flashSuccess }}
        </div>

        <slot>Default</slot>
    </main>

</template>

<script setup>

    import { Link, usePage } from '@inertiajs/vue3';
    import { computed } from 'vue';


    const flashSuccess = computed(
            () => usePage().props.flash.success
    );

    const user = computed(
            () => usePage().props.user
    );

    const notificationCount = computed(
            () => Math.min(usePage().props.user.notificationCount, 9)
    );
</script>