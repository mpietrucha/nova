import localization from '@nova/util/localization'

export default () => {
    const tc = (key, count, replaces) => {
        const value = localization(key, { ...replaces, count })

        if (Number.isInteger(count) === false) {
            return value
        }

        const values = value.split('|')

        return values[Math.min(count, values.length - 1)]
    }

    return { __: localization, tc }
}
