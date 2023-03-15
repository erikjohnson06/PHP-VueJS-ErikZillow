<template>
    <form @submit.prevent="create">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-2">
                <label class="label">Beds</label>
                <input
                    type="text"
                    v-model.number="form.beds"
                    class="input"
                    />
                <div v-if="form.errors.beds">
                    {{ form.errors.beds }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Baths</label>
                <input
                    type="text"
                    v-model.number="form.baths"
                    class="input"
                    />
                <div v-if="form.errors.baths">
                    {{ form.errors.baths }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Area</label>
                <input
                    type="text"
                    v-model.number="form.area"
                    class="input"
                    />

                <div v-if="form.errors.area">
                    {{ form.errors.area }}
                </div>
            </div>

            <div class="col-span-4">
                <label class="label">Street Address</label>
                <input
                    type="text"
                    v-model="form.address"
                    class="input"
                    />
                <div v-if="form.errors.address">
                    {{ form.errors.address }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">City</label>
                <input
                    type="text"
                    v-model="form.city"
                    class="input"
                    />
                <div v-if="form.errors.city">
                    {{ form.errors.city }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">State</label>
                <select
                    v-model="form.state"
                    class="input"
                    >
                    <option value="">---</option>
                    <option value="TN">TN</option>
                    <option value="KY">KY</option>
                    <option value="AL">AL</option>
                    <option value="GA">GA</option>
                    <option value="NC">NC</option>
                    <option value="SC">SC</option>
                </select>

                <div v-if="form.errors.state">
                    {{ form.errors.state }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Zip Code</label>
                <input
                    type="text"
                    v-model="form.zip"
                    class="input"
                    />

                <div v-if="form.errors.zip">
                    {{ form.errors.zip }}
                </div>
            </div>

            <div class="col-span-6">
                <label class="label">Price</label>
                <input
                    type="text"
                    v-model.number="form.price"
                    class="input"
                    />

                <div v-if="form.errors.price">
                    {{ form.errors.price }}
                </div>
            </div>

            <div class="col-span-6">
                <label class="label">Notes/Comments</label>
                <input
                    type="text"
                    v-model="form.comments"
                    class="input"
                    />

                <div v-if="form.errors.comments">
                    {{ form.errors.comments }}
                </div>
            </div>

            <div class="col-span-6">
                <button type="submit" :disabled="form.processing" class="button-primary">
                    Create
                </button>
            </div>
        </div>
    </form>
</template>

<style scoped>
    label {
        margin-right: 2em;
    }

    div {
        padding: 2px
    }
</style>

<script setup>

    import {useForm} from '@inertiajs/vue3';
    //import {Inertia} from '@inertiajs/inertia'
    //import {reactive} from 'vue'

    const form = useForm({
        beds: 0,
        baths: 0,
        area: 0,
        address: null,
        city: null,
        state: "",
        zip: null,
        price: 0,
        comments: null
    });

    const create = () => form.post(route('listing.store'));

</script>