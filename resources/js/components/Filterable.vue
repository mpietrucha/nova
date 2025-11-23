<template>
    <div class="mpietrucha-nova">
        <h1 class="font-normal text-xl mb-3 flex items-center">
            {{ __('filterable.filters') }}
        </h1>

        <FilterableDefault v-if="rows.length === 0" @add="addRow()" />

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
        </template>
    </div>
</template>

<script setup>
    import useRows from '@/composables/useRows'
    import useGroups from '@/composables/useGroups'
    import { computed, watch } from 'vue'
    import FilterableGroup from './FilterableGroup'
    import FilterableDefault from './FilterableDefault'

    const { rows, addRow } = useRows()

    const { groups, addGroup, removeGroup } = useGroups()

    const props = defineProps(['card'])

    const conditions = computed(() => props.card.conditions)

    watch(rows, rows => {
        if (rows.length) {
            return
        }

        groups.value.forEach(group => {
            group.rows.forEach(row => group.removeRow(row))
        })
    })

    watch(
        groups,
        groups => {
            groups.forEach((group, i) => {
                const next = groups[i + 1]

                if (group.rows.length === 0 && next) {
                    removeGroup(next)
                }

                if (group.rows.length && next === undefined) {
                    addGroup()
                }
            })
        },
        {
            deep: true,
        },
    )
</script>
