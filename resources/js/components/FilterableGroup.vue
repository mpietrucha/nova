<template>
    <Card>
        <div
            class="py-2 px-3 flex justify-between items-center"
            :class="{
                'border-b border-gray-100 dark:border-gray-700': rows.length,
            }"
        >
            <div class="uppercase text-gray-500 text-xs tracking-wide whitespace-nowrap">
                {{ group }}
            </div>

            <FilterableGroupButton @click="addRow()" />
        </div>

        <div
            class="pb-3 space-y-3 divide-y divide-gray-100 dark:divide-gray-700"
            v-if="rows.length"
        >
            <FilterableRow
                v-for="row in rows"
                v-model:value="row.value"
                v-model:filter="row.filter"
                v-model:condition="row.condition"
                :key="row.id"
                :conditions="conditions"
                @delete="deleteRow(row)"
            />
        </div>
    </Card>
</template>

<script setup>
    import FilterableGroupButton from '@/components/FilterableGroupButton'
    import FilterableRow from '@/components/FilterableRow'
    import useFilterable from '@/composables/useFilterable'

    defineProps({
        group: {
            type: String,
            required: true,
        },
        conditions: {
            type: Array,
            required: true,
        },
    })

    const rows = defineModel()

    const { addRow, deleteRow } = useFilterable({ rows })
</script>
