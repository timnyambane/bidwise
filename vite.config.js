import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vuePlugin from "@vitejs/plugin-vue";
import path from "path";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        vuePlugin(),
    ],
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "resources/js"),
            "@components": path.resolve(__dirname, "resources/js/components"),
        },
    },
});
