import { toRef } from '@vueuse/core'
import { uid } from 'uid/single'
import useFilterableRows, { createRows } from './useFilterableRows'
import useFilterableStorage from './useFilterableStorage'

export const createGroup = ({ id = uid(), rows } = {}) => {
    return {
        id,
        ...useFilterableRows(rows || createRows()),
    }
}

export const createGroups = group => {
    return [createGroup(group)]
}

export const useFilterableGroupsStorage = () => {
    const groups = useFilterableStorage(() => createGroups(), {
        name: 'groups',
    })

    groups.value = groups.value.map(group => createGroup(group))

    return groups
}

export default data => {
    const groups = toRef(data || useFilterableGroupsStorage())

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
