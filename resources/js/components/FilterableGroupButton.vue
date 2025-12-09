<template>
    <Button variant="action" :icon="icon" />
</template>

<script setup>
    import { Button } from 'laravel-nova-ui'

    defineProps({
        icon: { type: String, default: 'plus-circle' },
    })
</script>
