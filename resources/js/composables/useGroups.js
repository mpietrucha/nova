import { uid } from 'uid/single'
import { ref } from 'vue'
import useRows from './useRows'

export default groups => {
    const createGroup = () => ({
        id: uid(),
        ...useRows(),
    })

    groups ||= ref([createGroup()])

    const addGroup = () => {
        groups.value.push(createGroup())
    }

    const removeGroup = group => {
        groups.value = groups.value.filter(value => value.id !== group.id)
    }

    return { groups, createGroup, addGroup, removeGroup }
}
