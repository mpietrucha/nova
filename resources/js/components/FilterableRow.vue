<template>
    <div class="pt-3 px-3">
        <div class="flex space-x-3">
            <div class="flex w-full">
                <FilterableRowCondition v-model="condition" :conditions="conditions" />

                <FilterableRowFilter v-if="filters" v-model="filter" :filters="filters" />

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
    import FilterableGroupButton from '@/components/FilterableGroupButton'
    import FilterableRowCondition from '@/components/FilterableRowCondition'
    import FilterableRowFilter from '@/components/FilterableRowFilter'
    import FilterableRowValue from '@/components/FilterableRowValue'
    import { computed } from 'vue'

    defineProps({
        conditions: {
            type: Array,
            required: true,
        },
    })

    const value = defineModel('value')
    const filter = defineModel('filter')
    const condition = defineModel('condition')

    const filters = computed(() => condition.value?.filters)
</script>
