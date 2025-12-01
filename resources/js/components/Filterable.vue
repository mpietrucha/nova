<template>
    <div class="mpietrucha-nova">
        <FilterableHeader />

        <FilterableGroupPlaceholder v-if="rows.length === 0" @add="addRow()" />

        <form v-else @submit.prevent="submit()">
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
        </form>
    </div>
</template>

<script setup>
    import FilterableFooter from '@/components/FilterableFooter'
    import FilterableGroup from '@/components/FilterableGroup'
    import FilterableGroupPlaceholder from '@/components/FilterableGroupPlaceholder'
    import FilterableHeader from '@/components/FilterableHeader'
    import useFilterable from '@/composables/useFilterable'
    import { computed, watch } from 'vue'

    const { submit, rows, clearRows, addRow, groups, addGroup, deleteGroup } = useFilterable()

    const props = defineProps(['card'])

    const conditions = computed(() => props.card.conditions)

    watch(rows, rows => {
        if (rows.length) {
            return
        }

        groups.value.forEach(group => {
            group.rows.forEach(row => group.deleteRow(row))
        })

        submit()
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
