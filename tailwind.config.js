import defaultTheme from "tailwindcss/defaultTheme";
import preset from "./vendor/filament/support/tailwind.config.preset";

/** @type {import('tailwindcss').Config} */
export default {
    presets: [preset],
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
        "./app/Filament/**/*.php",
        "./resources/views/filament/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                roboto: ["Roboto", ...defaultTheme.fontFamily.sans],
                alexandria: ["Alexandria", "sans-serif"],
            },
            colors: {
                primary: {
                    full: "var(--dark-full)",
                    light: "var(--dark-light)",
                    shadWhite: "var(--dark-shadWhite)",
                },

                secondary: {
                    full: "var(--light-full)",
                    light: "var(--light-dark)",
                    shadGray: "var(--light-shadGray)",
                },
            },
        },
    },
    plugins: [require("flowbite"), require("@tailwindcss/forms")],
};
