<template>
    <Card class="p-3">
        <div
            class="bg-gray-50 dark:bg-gray-900 rounded-lg border-4 dark:border-gray-600 border-dashed py-3"
        >
            <InvertedButton @click="$emit('add')">
                {{ __('filterable.add_new_condition') }}
            </InvertedButton>
        </div>
    </Card>
</template>
