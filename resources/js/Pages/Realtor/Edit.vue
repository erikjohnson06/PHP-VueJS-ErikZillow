<template>
    <form @submit.prevent="update">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-2">
                <label class="label">Beds</label>
                <input type="text" v-model.number="form.beds" class="input" dusk="beds" />
                <div v-if="form.errors.beds" class="input-error">
                    {{ form.errors.beds }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Baths</label>
                <input type="text" v-model.number="form.baths" class="input" dusk="baths" />
                <div v-if="form.errors.baths" class="input-error">
                    {{ form.errors.baths }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Area</label>
                <input type="text" v-model.number="form.area" class="input" dusk="area" />

                <div v-if="form.errors.area" class="input-error">
                    {{ form.errors.area }}
                </div>
            </div>

            <div class="col-span-4">
                <label class="label">Street Address</label>
                <input type="text" v-model="form.address" class="input" dusk="address" />

                <div v-if="form.errors.address" class="input-error">
                    {{ form.errors.address }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">City</label>
                <input type="text" v-model="form.city" class="input" dusk="city" />

                <div v-if="form.errors.city" class="input-error">
                    {{ form.errors.city }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">State</label>
                <select v-model="form.state" class="input" dusk="state">
                    <option value="TN">TN</option>
                    <option value="KY">KY</option>
                    <option value="AL">AL</option>
                    <option value="GA">GA</option>
                    <option value="NC">NC</option>
                    <option value="SC">SC</option>
                </select>

                <div v-if="form.errors.state" class="input-error">
                    {{ form.errors.state }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Zip Code</label>
                <input type="text" v-model="form.zip" class="input" dusk="zip" />

                <div v-if="form.errors.zip" class="input-error">
                    {{ form.errors.zip }}
                </div>
            </div>

            <div class="col-span-6">
                <label class="label">Price</label>
                <input type="text" v-model.number="form.price" class="input" dusk="price" />

                <div v-if="form.errors.price" class="input-error">
                    {{ form.errors.price }}
                </div>
            </div>

            <div class="col-span-6">
                <label class="label">Notes/Comments</label>
                <input type="text" v-model="form.comments" class="input" dusk="comments" />

                <div v-if="form.errors.comments" class="input-error">
                    {{ form.errors.comments }}
                </div>
            </div>

            <div class="col-span-6">
                <button type="submit" :disabled="form.processing" class="button-primary" dusk="edit-listing">Update</button>
            </div>
        </div>
    </form>
</template>

<script setup>

    import { useForm } from '@inertiajs/vue3';

    const props = defineProps({
        listing: Object
    });

    const form = useForm({
        beds: props.listing.beds,
        baths: props.listing.baths,
        area: props.listing.area,
        address: props.listing.address,
        city: props.listing.city,
        state: props.listing.state,
        zip: props.listing.zip,
        price: props.listing.price,
        comments: props.listing.comments,
        id: props.listing.id
    });

    const update = () => form.put(route('realtor.listing.update', {listing: props.listing.id}));

    document.title = "ErikZillow | Edit Listing";
</script>