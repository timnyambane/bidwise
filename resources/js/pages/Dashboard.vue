<script setup>
import { Head, usePage, router } from "@inertiajs/vue3";
import { ref, computed, defineEmits } from "vue";
import { customerTabs } from "@/data.js";
import PostJobDrawer from "@components/base/PostJobDrawer.vue";

const selectedTabComponent = ref(customerTabs[0].component);
const selectedTab = ref(customerTabs[0]);
const postJobDrawer = ref(false);

const selectTab = (tab) => {
    selectedTab.value = tab;
    selectedTabComponent.value = tab.component;
};

const user = computed(() => usePage().props.auth?.user);
const handleLogout = () => {
    router.post(
        route("logout"),
        {},
        {
            onSuccess: () => {
                router.visit(route("home"));
            },
            onError: (error) => {
                console.error(error);
            },
        }
    );
};

const handleJobPosted = () => {
    postJobDrawer.value = false;
};
</script>

<template>
    <Head title="Dashboard" />
    <div
        class="flex flex-col md:flex-row w-full max-w-screen-lg mx-auto text-gray-800"
    >
        <!-- Sidebar -->
        <aside
            class="hidden md:flex flex-col w-72 bg-white border-r border-gray-200 sticky top-0 h-screen overflow-y-auto"
        >
            <div class="py-4 px-6 text-3xl font-black text-primary-900">
                BidWise
            </div>
            <ul class="mt-6 mx-2">
                <li
                    v-for="(tab, index) in customerTabs"
                    :key="index"
                    :class="[
                        'cursor-pointer py-3 px-4 flex my-0.5 items-center gap-3 font-medium transition duration-200 rounded-md',
                        tab.component === selectedTabComponent
                            ? 'font-semibold text-primary-600 bg-gray-100'
                            : 'hover:font-semibold hover:bg-gray-50',
                    ]"
                    @click="selectTab(tab)"
                >
                    <Icon
                        :icon="
                            tab.component === selectedTabComponent
                                ? tab.icon.active
                                : tab.icon.default
                        "
                        class="text-xl"
                    />
                    {{ tab.name }}
                </li>
            </ul>
        </aside>

        <!-- Main Content Section -->
        <main class="flex-1 bg-white min-h-screen flex flex-col">
            <header
                class="sticky top-0 z-10 flex items-center justify-between px-4 md:px-6 py-2 shadow-sm bg-white"
            >
                <span class="text-lg font-semibold">
                    Welcome, {{ user.first_name }}
                </span>
                <div class="flex items-center gap-x-4">
                    <Button
                        label="Logout"
                        text
                        size="small"
                        @click="handleLogout"
                    />
                    <Button
                        icon="fa-solid fa-plus"
                        @click="postJobDrawer = true"
                    />
                    <Dialog
                        v-model:visible="postJobDrawer"
                        header="Post a Job"
                        modal
                        :draggable="false"
                        :position="'top'"
                        class="w-[95%] md:w-[50%] mt-20"
                    >
                        <PostJobDrawer @job-posted="handleJobPosted" />
                    </Dialog>
                    <Avatar
                        :image="'https://primefaces.org/cdn/primevue/images/organization/walter.jpg'"
                        class="hidden md:mr-2"
                        shape="circle"
                        size="large"
                    />
                </div>
            </header>
            <div class="flex-grow overflow-auto px-2 md:px-4 pb-16 md:pb-4">
                <component
                    v-if="selectedTabComponent"
                    :is="selectedTabComponent"
                />
            </div>
        </main>

        <!-- Bottom Navbar (Mobile Only) -->
        <nav
            class="fixed bottom-0 left-0 w-full bg-gray-50 border-t border-gray-200 md:hidden"
        >
            <ul class="flex justify-around items-center py-3">
                <li
                    v-for="(tab, index) in customerTabs"
                    :key="index"
                    :class="[
                        'cursor-pointer flex flex-col items-center text-sm font-medium transition duration-200',
                        tab.component === selectedTabComponent
                            ? 'text-primary-600'
                            : 'text-gray-600 hover:text-gray-800',
                    ]"
                    @click="selectTab(tab)"
                >
                    <Icon
                        :icon="
                            tab.component === selectedTabComponent
                                ? tab.icon.active
                                : tab.icon.default
                        "
                        class="text-xl"
                    />
                    <span class="">{{ tab.name }}</span>
                </li>
            </ul>
        </nav>
    </div>
</template>
