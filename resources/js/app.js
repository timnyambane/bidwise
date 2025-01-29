import "./bootstrap";
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import PrimeVue from "primevue/config";
import Aura from "../css/aura";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";

import Button from "primevue/button";
import Avatar from "primevue/avatar";

import { Icon } from "@iconify/vue";
import { InputText, Password, Popover, Tooltip } from "primevue";

// Access the APP_NAME from the environment variables
const appTitle = import.meta.env.VITE_APP_NAME;

createInertiaApp({
    title: (title) => `${title} - ${appTitle}`,

    resolve: (name) => {
        const pages = import.meta.glob("./pages/**/*.vue", { eager: true });
        return pages[`./pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(PrimeVue, {
                unstyled: true,
                pt: Aura,
            })
            .directive("tooltip", Tooltip)
            .component("InputText", InputText)
            .component("Password", Password)
            .component("Button", Button)
            .component("Avatar", Avatar)
            .component("Icon", Icon)
            .component("Popover", Popover)
            .mount(el);
    },
});
