<template>
    <div v-if="dependant !== 'none'" class="w-full xl:w-1/2 mt-3 xl:mt-0">
        <FilterableRowValueIn v-model="value" v-if="dependant === 'in'" />

        <input
            v-else
            v-model="value"
            :type="dependant"
            class="w-full form-control form-input form-control-bordered"
        />
    </div>
</template>

<script setup>
    import FilterableRowValueIn from '@/components/FilterableRowValueIn'
    import { computed } from 'vue'

    const props = defineProps({
        filter: { type: Object, required: true },
    })

    const value = defineModel()

    const dependant = computed(() => props.filter.dependant)
</script>
