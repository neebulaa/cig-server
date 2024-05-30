/** @type {import('tailwindcss').Config} */
const withMT = require("@material-tailwind/html/utils/withMT");
export default withMT({
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
    },
    plugins: [],
});
