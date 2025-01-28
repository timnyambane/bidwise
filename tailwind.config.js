import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Noto Sans", "sans-serif"],
            },
            flex: {
                2: "2 2 0%",
                3: "3 3 0%",
            },
        },
    },
    plugins: [require("tailwindcss-primeui")],
    darkMode: "class",
};
