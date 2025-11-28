<template>
    <div class="w-full flex form-control form-input form-control-bordered form-select p-2">
        <InvertedButton
            :iconType="count ? 'arrow-right-circle' : 'plus-circle'"
            @click="modal = true"
        >
            <template v-if="count">
                {{ __('filterable.row.value.in.edit') }}
                {{ tc('filterable.row.value.in.items', count) }}
            </template>
            <template v-else>
                {{ __('filterable.row.value.in.add_items') }}
            </template>
        </InvertedButton>
    </div>

    <FilterableRowValueInModal
        v-model="value"
        v-model:count="count"
        :show="modal"
        @close="modal = false"
    />
</template>

<script setup>
    import useLocalization from '@/composables/useLocalization'
    import { ref } from 'vue'
    import FilterableRowValueInModal from './FilterableRowValueInModal'

    const modal = ref(false)

    const count = ref(0)

    const value = defineModel()

    const { tc } = useLocalization()
</script>
