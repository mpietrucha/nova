<template>
    <SearchInput
        :options="options"
        @input="search = $event"
        @selected="value = $event"
    >
        <template #default>
            <div v-if="value" class="flex items-center">
                {{ value.name }}
            </div>
        </template>

        <template #option="{ selected, option }">
            <div
                class="flex items-center text-sm font-semibold leading-5"
                :class="{ 'text-white': selected }"
            >
                {{ option.name }}
            </div>
        </template>
    </SearchInput>
</template>

<script setup>
    import { ref, computed, onMounted } from 'vue'

    const value = defineModel()

    const props = defineProps({
        options: {
            type: Array,
            required: true,
        },
    })

    const search = ref('')

    const options = computed(() => {
        return props.options.filter(option => {
            return option.name
                .toLowerCase()
                .includes(search.value.toLowerCase())
        })
    })

    onMounted(() => {
        if (value.value || options.value.length === 0) {
            return
        }

        value.value = options.value[0]
    })
</script>
