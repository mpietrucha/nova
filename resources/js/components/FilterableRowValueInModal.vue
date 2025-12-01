<template>
    <Modal :show="show" role="dialog" size="xl" @close-via-escape="close">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden space-y-6">
            <slot name="header">
                <ModalHeader>
                    {{ __('filterable.row.value.in.modal.header') }}
                </ModalHeader>
            </slot>

            <slot name="content">
                <ModalContent>
                    <textarea
                        v-model="value"
                        rows="20"
                        class="w-full h-auto py-3 block form-control form-input form-control-bordered"
                    />

                    <div class="mt-2 flex justify-between">
                        <HelpText>
                            {{ __('filterable.row.value.in.modal.help') }}
                        </HelpText>

                        <span class="text-xs font-semibold text-gray-400">
                            {{ tc('filterable.row.value.in.items', count) }}
                        </span>
                    </div>
                </ModalContent>
            </slot>

            <ModalFooter class="space-x-3 justify-end">
                <Button @click="clear()" variant="link" state="mellow">
                    {{ __('filterable.row.value.in.modal.clear') }}
                </Button>

                <Button @click="close()">
                    {{ __('filterable.row.value.in.modal.save') }}
                </Button>
            </ModalFooter>
        </div>
    </Modal>
</template>

<script setup>
    import useLocalization from '@/composables/useLocalization'
    import { Button } from 'laravel-nova-ui'
    import { watch } from 'vue'

    defineProps({
        show: {
            type: Boolean,
            default: false,
        },
    })

    const emit = defineEmits(['close'])

    const value = defineModel('value')
    const count = defineModel('count')

    const { tc } = useLocalization()

    const close = () => emit('close')

    const clear = () => {
        close()
        value.value = undefined
    }

    watch(
        value,
        value => {
            count.value = (value?.split(/\r?\n/) ?? []).length
        },
        { immediate: true },
    )
</script>
