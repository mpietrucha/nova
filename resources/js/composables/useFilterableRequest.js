import { useGroups } from '@/composables/useFilterableGroups'
import { useRows } from '@/composables/useFilterableRows'

const handler = Nova.request

const interceptor = request => {
    if (isFilterableRequest(request) === false) {
        return request
    }

    request.params = {
        ...request.params,
        filterable: [getRequestRows(), ...getRequestGroups()],
    }

    return request
}

export const isFilterableRequest = request => {
    return request.url.split('/').length === 3
}

export const createRequestRow = row => {
    if (!row.filter) {
        return
    }

    return {
        condition: row.condition.attribute,
        filter: row.filter.attribute,
        value: row.value,
    }
}

export const getRequestRows = () => {
    return useRows().value.map(createRequestRow)
}

export const getRequestGroups = () => {
    return useGroups().value.map(group => group.rows.map(createRequestRow))
}

export const getRequestInterceptor = () => {
    return interceptor
}

export const getRequestHandler = (options = null) => {
    return handler(options)
}

Nova.request = (options = null) => {
    const request = getRequestHandler(options)

    request.interceptors.request.use(getRequestInterceptor())

    return request
}

export default () => {
    const submit = () => {
        Nova.$emit('refresh-resources')
    }

    return { submit }
}
