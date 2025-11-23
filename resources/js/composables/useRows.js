import { uid } from 'uid/single'
import { ref } from 'vue'

export default rows => {
    rows ||= ref([])

    const createRow = () => ({
        id: uid(),
    })

    const addRow = () => {
        rows.value.push(createRow())
    }

    const removeRow = row => {
        rows.value = rows.value.filter(item => item.id !== row.id)
    }

    return { rows, createRow, addRow, removeRow }
}
