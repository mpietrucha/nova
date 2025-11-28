module.exports = {
    plugins: [
        require('tailwindcss')(),
        require('autoprefixer')(),
        require('postcss-rtlcss')(),
        require('@mpietrucha/postcss-tailwind-deduplicate')({
            input: './vendor/laravel/nova/public/app.css',
        }),
    ],
}
