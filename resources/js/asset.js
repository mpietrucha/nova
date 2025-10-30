Nova.mp = {
    indicate: component => {
        const indicator = component._.props?.field?.indicator

        if (indicator === undefined) {
            return
        }

        component.$el.setAttribute('data-indicator', indicator)
    },

    media: component => {
        const fields = component._.props?.fields

        if (fields === undefined) {
            return
        }

        fields
            .filter(field => field.component === 'repeater-field')
            .map(repeater => repeater?.value?.[0]?.fields)
            .flat()
            .filter(Boolean)
            .filter(field => field.component === 'file-field')
            .forEach(field => {
                field.value = field.value.split('/')?.[1] ?? field.value
            })
    },
}

Nova.booting((Vue, router, store) => {
    Vue.mixin({
        mounted() {
            Nova.mp.media(this)

            Nova.mp.indicate(this)
        },
    })
})
