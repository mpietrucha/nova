const config = require('./vendor/laravel/nova/tailwind.config.js')

module.exports = {
    ...config,
    content: ['./resources/js/**/*.vue'],
}
