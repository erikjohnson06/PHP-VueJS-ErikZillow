<template>
    <form @submit.prevent="create">
        <div>
            <div>
                <label>Beds</label>
                <input type="text" v-model.number="form.beds" />
                <div v-if="form.errors.beds">
                    {{ form.errors.beds }}
                </div>
            </div>

            <div>
                <label>Baths</label>
                <input type="text" v-model.number="form.baths" />
                <div v-if="form.errors.baths">
                    {{ form.errors.baths }}
                </div>
            </div>

            <div>
                <label>Area</label>
                <input type="text" v-model.number="form.area" />

                <div v-if="form.errors.area">
                    {{ form.errors.area }}
                </div>
            </div>

            <div>
                <label>Street Address</label>
                <input type="text" v-model="form.address" />

                <div v-if="form.errors.address">
                    {{ form.errors.address }}
                </div>
            </div>

            <div>
                <label>City</label>
                <input type="text" v-model="form.city" />

                <div v-if="form.errors.city">
                    {{ form.errors.city }}
                </div>
            </div>

            <div>
                <label>State</label>
                <select v-model="form.state">
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

            <div>
                <label>Zip Code</label>
                <input type="text" v-model="form.zip" />

                <div v-if="form.errors.zip">
                    {{ form.errors.zip }}
                </div>
            </div>

            <div>
                <label>Price</label>
                <input type="text" v-model.number="form.price" />

                <div v-if="form.errors.price">
                    {{ form.errors.price }}
                </div>
            </div>

            <div>
                <label>Notes/Comments</label>
                <input type="text" v-model="form.comments" />

                <div v-if="form.errors.comments">
                    {{ form.errors.comments }}
                </div>
            </div>

            <div>
                <button type="submit" :disabled="form.processing">Create</button>
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
        state : "",
        zip: null,
        price: 0,
        comments: null
    });

    const create = () => form.post(route('listing.store'));

</script>