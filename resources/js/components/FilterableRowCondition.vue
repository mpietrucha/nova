<template>
    <div class="w-1/2 xl:w-[30%]">
        <FilterableSelect v-model="value" :options="conditions" />
    </div>
</template>

<script setup>
    import FilterableSelect from '@/components/FilterableSelect'

    defineProps({
        conditions: {
            type: Array,
            required: true,
        },
    })

    const value = defineModel()
</script>
