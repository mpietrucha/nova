<template>
    <div class="pt-3 px-3">
        <div class="flex space-x-3">
            <div class="flex w-full">
                <FilterableRowCondition
                    v-model="condition"
                    :conditions="conditions"
                />

                <FilterableRowFilter
                    v-if="filters"
                    v-model="filter"
                    :filters="filters"
                />

                <FilterableRowValue
                    v-if="filter"
                    v-model="value"
                    :filter="filter"
                    class="hidden xl:block"
                />
            </div>

            <FilterableGroupButton @click.stop="$emit('delete')" icon="trash" />
        </div>

        <FilterableRowValue
            v-if="filter"
            v-model="value"
            :filter="filter"
            class="block xl:hidden"
        />
    </div>
</template>

<script setup>
    import { ref, computed } from 'vue'
    import FilterableRowValue from './FilterableRowValue'
    import FilterableRowFilter from './FilterableRowFilter'
    import FilterableGroupButton from './FilterableGroupButton'
    import FilterableRowCondition from './FilterableRowCondition'

    defineProps({
        conditions: {
            type: Array,
            required: true,
        },
    })

    const condition = ref()

    const filter = defineModel('filter')
    const value = defineModel()

    const filters = computed(() => condition.value?.filters)
</script>
