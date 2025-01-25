<script setup>
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";
import { customerTabs } from "@/data.js";

const selectedTabComponent = ref(customerTabs[0].component);
const selectedTab = ref(customerTabs[0]);

const selectTab = (tab) => {
    selectedTab.value = tab;
    selectedTabComponent.value = tab.component;
};
</script>

<template>
    <Head title="Dashboard" />
    <div
        class="max-w-screen-xl mx-auto flex flex-col md:flex-row text-gray-800"
    >
        <!-- Sidebar -->
        <aside
            class="hidden md:flex flex-col border-r border-gray-200 w-64 sticky top-0 h-screen bg-white overflow-y-auto"
        >
            <div class="py-4 px-6 text-3xl font-bold text-gray-800">
                BidWise
            </div>
            <ul class="mt-6">
                <li
                    v-for="(tab, index) in customerTabs"
                    :key="index"
                    :class="[
                        'cursor-pointer py-3 px-4 flex items-center gap-3 font-medium transition duration-200 rounded-md',
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
        <main class="flex-grow flex flex-col bg-white h-screen">
            <header
                class="sticky top-0 z-10 flex items-center justify-between px-6 py-4 shadow-sm bg-white"
            >
                <span class="text-lg font-semibold">Header</span>
                <div
                    class="hidden md:flex items-center cursor-pointer hover:bg-primary-100 p-2 rounded-full"
                >
                    <Avatar
                        image="https://primefaces.org/cdn/primevue/images/organization/walter.jpg"
                        class="mr-2"
                        shape="circle"
                    />
                    <h2 class="font-semibold">Johnathan Doetheniel</h2>
                </div>
            </header>
            <div class="flex-grow overflow-auto px-4 pb-16 md:pb-4">
                <component
                    v-if="selectedTabComponent"
                    :is="selectedTabComponent"
                />
            </div>
        </main>

        <!-- Bottom Navbar -->
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
                    <span>{{ tab.name }}</span>
                </li>
            </ul>
        </nav>
    </div>
</template>
