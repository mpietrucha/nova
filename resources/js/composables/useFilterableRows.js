import useFilterableStorage from '@/composables/useFilterableStorage'
import { toRef } from '@vueuse/core'
import { uid } from 'uid/single'

export const createRow = () => {
    return {
        id: uid(),
    }
}

export const createRows = () => {
    return []
}

export const useRows = () => {
    return useFilterableStorage(createRows, {
        name: 'rows',
    })
}

export default data => {
    const rows = toRef(data || useRows())

    const clearRows = () => {
        rows.value = createRows()
    }

    const addRow = () => {
        rows.value.push(createRow())
    }

    const deleteRow = ({ id }) => {
        rows.value = rows.value.filter(row => row.id !== id)
    }

    return {
        rows,
        clearRows,
        addRow,
        deleteRow,
    }
}
