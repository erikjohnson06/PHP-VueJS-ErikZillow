<template>

    <form @submit.prevent="login">
        <div class="w-1/2 mx-auto">
            <div>
                <label for="email" class="label">Email Address</label>
                <input type="text" id="email" class="input" dusk="email" v-model="form.email" />
                <div class="input-error" v-if="form.errors.email">{{ form.errors.email }}</div>
            </div>
            <div class="mt-4">
                <label for="password" class="label">Password</label>
                <input type="password" id="password" class="input" dusk="password" v-model="form.password" />
                <div class="input-error" v-if="form.errors.password">{{ form.errors.password }}</div>
            </div>
            <div class="mt-4">
                <button class="button-primary w-full" type="submit" dusk="login-button">Login</button>

                <div class="mt-2 text-center">
                    <Link :href="route('register')" class="text-sm text-gray-500">Don't have an account? Register here</Link>
                </div>
            </div>
        </div>
    </form>

</template>

<script setup>

    import { Link, useForm } from '@inertiajs/vue3';

    const form = useForm({
        email: null,
        password: null
    });

    const login = () => form.post(route('login.store'));

    document.title = "ErikZillow | Login";
</script>
