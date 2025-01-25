import { markRaw } from "vue";

import NewJobs from "@components/layout/customer/NewJobs.vue";
import Quoted from "@components/layout/customer/Quoted.vue";
import InProgress from "@components/layout/customer/InProgress.vue";
import Completed from "@components/layout/customer/Completed.vue";

export const customerTabs = [
    {
        name: "New Jobs",
        component: markRaw(NewJobs),
        icon: {
            default: "icon-park-outline:newlybuild",
            active: "icon-park-solid:newlybuild",
        },
    },
    {
        name: "Quoted",
        component: markRaw(Quoted),
        icon: {
            default: "bi:chat-square-quote",
            active: "bi:chat-square-quote-fill",
        },
    },
    {
        name: "InProgress",
        component: markRaw(InProgress),
        icon: {
            default: "tabler:clock",
            active: "tabler:clock-filled",
        },
    },
    {
        name: "Completed",
        component: markRaw(Completed),
        icon: {
            default: "ph:seal-check-bold",
            active: "ph:seal-check-fill",
        },
    },
];
