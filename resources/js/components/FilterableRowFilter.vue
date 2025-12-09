<template>
    <div class="w-1/2 xl:w-1/5 pl-3 xl:pr-3">
        <FilterableSelect v-model="value" :options="filters" />
    </div>
</template>

<script setup>
    import FilterableSelect from '@/components/FilterableSelect'

    defineProps({
        filters: { type: Array, required: true },
    })

    const value = defineModel()
</script>
