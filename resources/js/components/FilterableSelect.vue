<template>
    <SearchInput :options="options" @input="search = $event" @selected="value = $event">
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
    import { computed, onMounted, ref } from 'vue'

    const props = defineProps({
        options: {
            type: Array,
            required: true,
        },
    })

    const value = defineModel()

    const search = ref('')

    const options = computed(() => {
        return props.options.filter(option => {
            return option.name.toLowerCase().includes(search.value.toLowerCase())
        })
    })

    onMounted(() => {
        const [option] = options.value

        if (value.value || option === undefined) {
            return
        }

        value.value = option
    })
</script>
