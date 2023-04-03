<template>

    <div>Please verify your email address first</div>

    <div>
        <Link :href="route('verification.send')"
              method="POST"
              as="button"
              class="text-indigo-600 dark:text-indigo-400"
              >
        Resend Verification Email
        </Link>
    </div>
    
</template>

<script setup>
    import { Link } from '@inertiajs/vue3';
</script>
