<template>
    <div
        class="mt-4 flex flex-col md:flex-row md:items-center justify-center md:justify-end space-y-2 md:space-y-0 md:space-x-3"
    >
        <Button variant="ghost" @click="$emit('clear')">
            {{ __('filterable.footer.clear') }}
        </Button>

        <Button type="submit">
            {{ __('filterable.footer.filter') }}
        </Button>
    </div>
</template>

<script setup>
    import { Button } from 'laravel-nova-ui'
</script>
