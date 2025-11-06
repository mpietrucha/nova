import Filterable from './components/Filterable'

Nova.mp = {
    indicate: component => {
        const indicator = component._.props?.field?.indicator

        if (indicator === undefined) {
            return
        }

        component.$el.setAttribute('data-indicator', indicator)
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
    Vue.component('mpietrucha-filterable', Filterable)

    Vue.mixin({
        mounted() {
            Nova.mp.media(this)

            Nova.mp.indicate(this)
        },
    })
})
