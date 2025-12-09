<template>
    <SearchInput
        :options="options"
        @input="search = $event"
        @selected="value = $event"
        v-model="value"
        trackBy="name"
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
    import { computed, nextTick, onMounted, ref, watch } from 'vue'

    const props = defineProps({
        options: { type: Array, required: true },
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

    watch(
        () => props.options,
        () => {
            nextTick(() => {
                if (options.value[0]) {
                    value.value = options.value[0]
                }
            })
        },
    )
</script>
