import { getFilterableName } from '@/composables/useFilterable'
import { useLocalStorage } from '@vueuse/core'

const storage = new Map()

export const createStorageKey = ({ name } = {}) => {
    return [getFilterableName().split('-'), window.location.pathname.split('/'), name]
        .flat()
        .filter(Boolean)
        .join('.')
}

export default (initial, options = {}) => {
    const key = createStorageKey(options)

    if (storage.has(key)) {
        return storage.get(key)
    }

    const value = useLocalStorage(key, initial)

    storage.set(key, value)

    return value
}
