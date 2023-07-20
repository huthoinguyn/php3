/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./resources/**/*.svg",
    ],
    theme: {
        extend: {
            colors: {
                "primary": "#14a800",
            },
            fontFamily: {
                "sans": ['Montserrat', 'sans-serif']
            }
        },
    },
    plugins: [],
}
