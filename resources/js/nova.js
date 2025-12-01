import { getFilterableComponent, getFilterableName } from '@/composables/useFilterable'

Nova.mp = {
    attributes: component => {
        const attributes = component._.props?.field?.extraComponentAttributes

        if (attributes === undefined) {
            return
        }

        Object.entries(attributes).forEach(([attribute, value]) => {
            component.$el.setAttribute(attribute, value)
        })
    },

    media: component => {
        const normalize = (data, name) => {
            const value = data[name]

            data[name] = value.split('/')?.[1] ?? value
        }

        const field = component._.props?.file

        if (field) {
            normalize(field, 'name')

            return
        }

        const fields = component._.props?.fields

        if (fields === undefined) {
            return
        }

        fields
            .filter(field => field.component === 'repeater-field')
            .map(fields => fields?.value?.[0]?.fields)
            .flat()
            .filter(Boolean)
            .filter(field => field.component === 'file-field')
            .forEach(field => normalize(field, 'value'))
    },
}

Nova.booting((Vue, router, store) => {
    Vue.component(getFilterableName(), getFilterableComponent())

    Vue.mixin({
        mounted() {
            Nova.mp.media(this)

            Nova.mp.attributes(this)
        },
    })
})
