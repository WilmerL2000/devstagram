/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.php",
        "./resources/**/*.js",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/**/*.blade.php",
    ],
    theme: {
        extend: {},
    },
    plugins: [],
};
