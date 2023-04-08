<template>

    <form>

        <div class="flex flex-wrap gap-4 mb-4 mt-4">
            <div class="flex flex-nowrap items-center gap-2">
                <input id="deleted"
                       type="checkbox"
                       class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                       v-model="filterForm.deleted"
                       dusk="unpublished"
                       />
                <label for="deleted">Unpublished</label>
            </div>

            <div>
                <select class="input-filter-l w-36"
                        v-model="filterForm.by">
                    <option value="">---</option>
                    <option value="created_at">Created</option>
                    <option value="updated_at">Last Updated</option>
                    <option value="price">Price</option>
                    <option value="beds">Beds</option>
                    <option value="beds">Baths</option>
                    <option value="beds">Area</option>
                </select>

                <select class="input-filter-r w-42"
                        v-model="filterForm.order">
                    <option value="">---</option>
                    <option v-for="option in sortOptions"
                            :key="option.value"
                            :value="option.value"
                            >
                        {{ option.label }}
                    </option>
                </select>
            </div>
        </div>
    </form>
</template>

<script setup>
    import { reactive, watch, computed } from 'vue';
    import { router } from '@inertiajs/vue3';
    import { debounce } from 'lodash';

    const sortLabels = {
        created_at: [
            {
                label: 'Most Recent',
                value: 'desc'
            },
            {
                label: 'Oldest',
                value: 'asc'
            }
        ],
        updated_at: [
            {
                label: 'Most Recent',
                value: 'desc'
            },
            {
                label: 'Oldest',
                value: 'asc'
            }
        ],
        price: [
            {
                label: 'Highest to Lowest',
                value: 'desc'
            },
            {
                label: 'Lowest to Highest',
                value: 'asc'
            }
        ],
        beds: [
            {
                label: 'Highest to Lowest',
                value: 'desc'
            },
            {
                label: 'Lowest to Highest',
                value: 'asc'
            }
        ],
        baths: [
            {
                label: 'Highest to Lowest',
                value: 'desc'
            },
            {
                label: 'Lowest to Highest',
                value: 'asc'
            }
        ],
        area: [
            {
                label: 'Highest to Lowest',
                value: 'desc'
            },
            {
                label: 'Lowest to Highest',
                value: 'asc'
            }
        ]
    };

    const sortOptions = computed(() => sortLabels[filterForm.by]);

    const props = defineProps({
        filters: Object
    });

    const filterForm = reactive({
        deleted: props.filters.deleted ?? false,
        by: props.filters.by ?? 'updated_at',
        order: props.filters.order ?? 'desc'
    });

    watch(
        filterForm,
        debounce(
            () => router.get(
                route('realtor.listing.index'),
                filterForm,
                {preserveState: true, preserveScroll: true}
            ), 500
        )
    );
</script>
