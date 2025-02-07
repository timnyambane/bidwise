import "./bootstrap";
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import PrimeVue from "primevue/config";
import Aura from "../css/aura";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";

import { Icon } from "@iconify/vue";
import {
    Drawer,
    InputText,
    Password,
    Button,
    Avatar,
    Popover,
    Tooltip,
    Select,
    Dialog,
    Textarea,
    RadioButton,
    DatePicker,
    MultiSelect,
    Menu,
} from "primevue";

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
            .component("Drawer", Drawer)
            .component("Select", Select)
            .component("Dialog", Dialog)
            .component("Textarea", Textarea)
            .component("RadioButton", RadioButton)
            .component("DatePicker", DatePicker)
            .component("MultiSelect", MultiSelect)
            .component("Menu", Menu)
            .mount(el);
    },
});
