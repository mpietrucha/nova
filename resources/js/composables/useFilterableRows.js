import { toRef } from '@vueuse/core'
import { uid } from 'uid/single'
import useFilterableStorage from './useFilterableStorage'

export const createRow = () => {
    return {
        id: uid(),
    }
}

export const createRows = () => {
    return []
}

export const useFilterableRowsStorage = () => {
    return useFilterableStorage(() => createRows(), {
        name: 'rows',
    })
}

export default data => {
    const rows = toRef(data || useFilterableRowsStorage())

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
