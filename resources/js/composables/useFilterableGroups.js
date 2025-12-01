import useFilterableRows, { createRows } from '@/composables/useFilterableRows'
import useFilterableStorage from '@/composables/useFilterableStorage'
import { toRef } from '@vueuse/core'
import { uid } from 'uid/single'

export const createGroup = ({ id = uid(), rows } = {}) => {
    return {
        id,
        ...useFilterableRows(rows || createRows()),
    }
}

export const createGroups = group => {
    return [createGroup(group)]
}

export const useGroups = () => {
    return useFilterableStorage(createGroups, {
        name: 'groups',
    })
}

export const useHydratedGroups = () => {
    const groups = useGroups()

    groups.value = groups.value.map(group => createGroup(group))

    return groups
}

export default data => {
    const groups = toRef(data || useHydratedGroups())

    const clearGroups = () => {
        groups.value = createGroups()
    }

    const addGroup = () => {
        groups.value.push(createGroup())
    }

    const deleteGroup = ({ id }) => {
        groups.value = groups.value.filter(group => group.id !== id)
    }

    return {
        groups,
        clearGroups,
        addGroup,
        deleteGroup,
    }
}
