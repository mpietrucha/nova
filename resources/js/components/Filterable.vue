<template>
    <div class="mpietrucha-nova">
        <FilterableHeader />

        <FilterableGroupPlaceholder v-if="rows.length === 0" @add="addRow()" />

        <template v-else>
            <FilterableGroup
                v-model="rows"
                :group="__('filterable.group.and')"
                :conditions="conditions"
            />

            <FilterableGroup
                v-for="group in groups"
                v-model="group.rows"
                class="mt-3"
                :group="__('filterable.group.or')"
                :conditions="conditions"
            />

            <FilterableFooter @clear="clearRows()" />
        </template>
    </div>
</template>

<script setup>
    import useFilterableGroups from '@/composables/useFilterableGroups'
    import useFilterableRows from '@/composables/useFilterableRows'
    import { computed, watch } from 'vue'
    import FilterableFooter from './FilterableFooter'
    import FilterableGroup from './FilterableGroup'
    import FilterableGroupPlaceholder from './FilterableGroupPlaceholder'
    import FilterableHeader from './FilterableHeader'

    const { rows, clearRows, addRow } = useFilterableRows()

    const { groups, addGroup, deleteGroup } = useFilterableGroups()

    const props = defineProps(['card'])

    const conditions = computed(() => props.card.conditions)

    watch(rows, rows => {
        if (rows.length) {
            return
        }

        groups.value.forEach(group => {
            group.rows.forEach(row => group.deleteRow(row))
        })
    })

    watch(
        groups,
        groups => {
            groups.forEach((group, i) => {
                const next = groups[i + 1]

                if (group.rows.length && next === undefined) {
                    addGroup()
                }

                if (group.rows.length === 0 && next !== undefined) {
                    deleteGroup(next)
                }
            })
        },
        {
            deep: true,
        },
    )
</script>
