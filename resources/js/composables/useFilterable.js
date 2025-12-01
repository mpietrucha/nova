import Filterable from '@/components/Filterable'
import useFilterableGroups from '@/composables/useFilterableGroups'
import useFilterableRequest from '@/composables/useFilterableRequest'
import useFilterableRows from '@/composables/useFilterableRows'

export const getFilterableComponent = () => {
    return Filterable
}

export const getFilterableName = () => {
    return 'mpietrucha-filterable'
}

export default ({ rows, groups } = {}) => {
    const { submit } = useFilterableRequest()

    return {
        submit,
        ...useFilterableRows(rows),
        ...useFilterableGroups(groups),
    }
}
