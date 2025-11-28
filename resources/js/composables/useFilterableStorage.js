import { useLocalStorage } from '@vueuse/core'

export const useDefaultStorageValue = value => {
    return typeof value === 'function' ? value() : value
}

export const createStorageKey = name => {
    return ['mpietrucha', 'filterable', window.location.pathname.split('/'), name]
        .flat()
        .filter(Boolean)
        .join('.')
}

export default (value, { name } = {}) => {
    return useLocalStorage(createStorageKey(name), useDefaultStorageValue(value))
}
