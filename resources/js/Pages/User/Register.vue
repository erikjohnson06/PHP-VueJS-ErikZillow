<template>

    <form @submit.prevent="register">
        <div class="w-1/2 mx-auto">
            <div>
                <label for="name" class="label">Your Name</label>
                <input type="text" id="name" class="input" dusk="name" v-model="form.name" />
                <div class="input-error" v-if="form.errors.name">
                    {{ form.errors.name }}
                </div>
            </div>
            <div class="mt-4">
                <label for="email" class="label">Email Address</label>
                <input type="text" id="email" class="input" dusk="email" v-model="form.email" />
                <div class="input-error" v-if="form.errors.email">
                    {{ form.errors.email }}
                </div>
            </div>
            <div class="mt-4">
                <label for="password" class="label">Password</label>
                <input type="password" id="password" class="input" dusk="password" v-model="form.password" />
                <div class="input-error" v-if="form.errors.password">
                    {{ form.errors.password }}
                </div>
            </div>

            <div class="mt-4">
                <label for="password_confirmation" class="label">Confirm Password</label>
                <input type="password" id="password_confirmation" dusk="password_confirmation" class="input" v-model="form.password_confirmation" />
            </div>

            <div class="mt-4">
                <button class="button-primary w-full" type="submit" dusk="create-button">Create Account</button>

                <div class="mt-2 text-center">
                    <Link :href="route('login')" class="text-sm text-gray-500">Already have an account? Sign in here</Link>
                </div>
            </div>
        </div>
    </form>
</template>

<script setup>

    import { Link, useForm } from '@inertiajs/vue3';

    const form = useForm({
        name: null,
        email: null,
        password: null,
        password_confirmation: null
    });

    const register = () => form.post(route('register.store'));

    document.title = "ErikZillow | Register";
</script>
