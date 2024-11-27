import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    vfDarkMode: false,
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
        "./vueform.config.js", // or where `vueform.config.js` is located. Change `.js` to `.ts` if required.
        "./node_modules/@vueform/vueform/themes/tailwind/**/*.vue",
        "./node_modules/@vueform/vueform/themes/tailwind/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, require("@vueform/vueform/tailwind")],
};
