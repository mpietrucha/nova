Nova.booting((Vue, router, store) => {
    Vue.mixin({
        mounted() {
            const indicator = this._.props?.field?.indicator

            if (indicator === undefined) {
                return
            }

            this.$el.setAttribute('data-indicator', indicator)
        },
    })
})
