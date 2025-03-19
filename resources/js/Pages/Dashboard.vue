<script setup>
import { ref, computed, markRaw, shallowRef, onMounted, watch } from "vue";
import { Head, Link, usePage, router } from "@inertiajs/vue3";
import Footer from "@/Components/Base/Footer.vue";
import { customerTabs, businessTabs } from "@/data.js";
import PostJobModal from "../Components/Base/PostJobModal.vue";

const user = computed(() => usePage().props.auth?.user);

const tabs = computed(() =>
    user.value?.role === "business" ? businessTabs : customerTabs
);

const activeTab = ref("");
const jobPostModal = ref(false);
const selectedTabComponent = shallowRef(null);
const op = ref();

const initializeTab = () => {
    const storedTabName = localStorage.getItem("activeTab");
    const defaultTab =
        tabs.value.find((tab) => tab.name === storedTabName) || tabs.value[0];

    if (defaultTab) {
        activeTab.value = defaultTab.name;
        selectedTabComponent.value = markRaw(defaultTab.component);
    }
};

const logout = () => {
    router.post(route("logout"));
};

const togglePopover = (event) => {
    op.value.toggle(event);
};

const selectTab = (tab) => {
    activeTab.value = tab.name;
    selectedTabComponent.value = markRaw(tab.component);
    localStorage.setItem("activeTab", tab.name);
};

onMounted(() => {
    initializeTab();
});

watch(tabs, () => {
    initializeTab();
});

const isFilterSidebarOpen = ref(false);

const selectedFilters = ref({
    jobType: null,
    urgency: null,
    location: null,
});

const jobTypes = ["Full-Time", "Part-Time", "Freelance", "Contract"];
const urgencies = ["Immediate", "Urgent", "Flexible", "Within Two Weeks"];
const locations = [
    "Remote",
    "San Francisco, CA",
    "New York, NY",
    "Los Angeles, CA",
];

const applyFilters = () => {
    console.log("Filters Applied:", selectedFilters.value);
};
</script>

<template>
    <Head title="Dashboard" />
    <Toast />
    <div class="min-h-screen bg-gray-50 flex flex-col text-gray-800">
        <!-- Header -->
        <header class="fixed top-0 w-full bg-white shadow-md z-50">
            <nav
                class="container mx-auto flex items-center justify-between py-2 px-4 lg:px-10"
            >
                <Link :href="route('home')">
                    <img src="@/assets/bidwise-full.svg" alt="" class="h-10" />
                </Link>
                <div class="flex items-center gap-4 lg:hidden">
                    <Button
                        icon="fa-solid fa-filter"
                        variant="text"
                        rounded
                        @click="isFilterSidebarOpen = true"
                    />

                    <Button
                        icon="fa-regular fa-comment-dots"
                        variant="text"
                        rounded
                        raised
                        title="Inbox"
                    />
                </div>
                <img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSIn-gE6j6sjvg0ekFgFBIzVP5VdN3aBu9dLg&s"
                    alt="User profile"
                    class="size-10 rounded-full object-center object-cover cursor-pointer"
                    @click="togglePopover"
                />
                <Popover ref="op">
                    <div
                        class="p-1 text-center border-b border-gray-600 mb-1 gap-1 flex flex-col items-start text-gray-600"
                    >
                        <p class="flex items-center gap-2">
                            <i class="fa-solid fa-envelope" /> {{ user.email }}
                        </p>
                        <p class="flex items-center gap-2">
                            <i class="fa-solid fa-user" /> {{ user.role }}
                        </p>
                    </div>
                    <Button
                        label="Logout"
                        size="small"
                        variant="link"
                        icon="fa-solid fa-right-from-bracket"
                        @click="logout"
                        severity="danger"
                    />
                </Popover>
            </nav>
        </header>

        <!-- Main Content -->
        <main
            class="flex-grow pt-[4.5rem] pb-16 container mx-auto p-4 flex flex-col lg:flex-row gap-4"
        >
            <!-- Sidebar -->
            <aside
                class="w-64 p-2 lg:block hidden sticky top-[4.5rem] self-start bg-white shadow rounded-lg flex-shrink-0"
            >
                <nav
                    aria-label="Sidebar Navigation"
                    class="flex flex-col gap-1"
                >
                    <h2 class="text-lg font-semibold mb-2">Navigation</h2>

                    <button
                        v-for="tab in tabs"
                        :key="tab.name"
                        @click="selectTab(tab)"
                        :class="[
                            'flex items-center gap-2 p-2 w-full transition rounded-lg font-medium cursor-pointer',
                            activeTab === tab.name
                                ? 'text-blue-600 bg-primary-50 font-medium'
                                : 'text-gray-700 hover:bg-primary-50',
                        ]"
                    >
                        <Icon
                            :icon="
                                tab.component === selectedTabComponent
                                    ? tab.icon.active
                                    : tab.icon.default
                            "
                            class="text-lg"
                        />
                        <span>{{ tab.name }}</span>
                    </button>

                    <Button
                        v-if="user.role === 'customer'"
                        label="Post job"
                        icon="fa-solid fa-plus"
                        size="small"
                        aria-label="Post Job"
                        title="Post a new job"
                        class="mt-4"
                        @click="jobPostModal = true"
                    />
                </nav>
            </aside>

            <!-- Main Section -->
            <section class="flex-grow rounded-lg">
                <component :is="selectedTabComponent" />
            </section>

            <!-- Filters (Right Sidebar for Desktop) -->
            <aside
                class="w-64 p-2 lg:block hidden sticky top-[4.5rem] self-start bg-white shadow rounded-lg flex-shrink-0 overflow-hidden"
            >
                <h2 class="text-lg font-semibold mb-3">Filter Jobs</h2>

                <div class="mb-3">
                    <label class="text-sm font-medium block mb-1"
                        >Job Type</label
                    >
                    <Select
                        v-model="selectedFilters.jobType"
                        :options="jobTypes"
                        placeholder="Select Job Type"
                        fluid
                        size="small"
                    />
                </div>

                <div class="mb-3">
                    <label class="text-sm font-medium block mb-1"
                        >Urgency</label
                    >
                    <Select
                        v-model="selectedFilters.urgency"
                        :options="urgencies"
                        placeholder="Select Urgency"
                        fluid
                        size="small"
                    />
                </div>

                <div class="mb-3">
                    <label class="text-sm font-medium block mb-1"
                        >Location</label
                    >
                    <Select
                        v-model="selectedFilters.location"
                        :options="locations"
                        placeholder="Select Location"
                        fluid
                        size="small"
                    />
                </div>

                <Button
                    label="Apply Filters"
                    class="w-full mt-2"
                    @click="applyFilters"
                    size="small"
                    icon="fa-solid fa-filter"
                />
            </aside>
        </main>

        <!-- Mobile Navbar -->
        <nav
            class="fixed bottom-0 left-0 w-full bg-white shadow-md flex items-center justify-around lg:hidden"
            aria-label="Mobile Navigation"
        >
            <template
                v-for="(tab, index) in tabs.filter(
                    (tab) => tab.showMobileNav !== false
                )"
                :key="tab.name"
            >
                <!-- Render the first half of the tabs -->
                <button
                    v-if="index === Math.ceil(tabs.length / 3)"
                    @click="jobPostModal = true"
                    aria-label="Post Job"
                    title="Post a new job"
                    class="bg-primary-600 text-white rounded-full size-12 flex items-center justify-center shadow-lg transform -translate-y-3"
                >
                    <Icon icon="material-symbols:add" class="text-2xl" />
                </button>

                <button
                    @click="selectTab(tab)"
                    class="flex flex-col items-center p-2 transition duration-200 ease-in-out flex-1 font-medium"
                    :class="{
                        'text-blue-600': activeTab === tab.name,
                        'text-gray-600': activeTab !== tab.name,
                    }"
                >
                    <Icon
                        :icon="
                            tab.component === selectedTabComponent
                                ? tab.icon.active
                                : tab.icon.default
                        "
                        class="text-lg"
                    />
                    <span class="text-sm">{{ tab.name }}</span>
                </button>
            </template>
        </nav>

        <!-- Mobile Filter Sidebar -->
        <Drawer v-model:visible="isFilterSidebarOpen" position="right">
            <h2 class="text-lg font-semibold mb-2">Filter Jobs</h2>

            <div class="mb-2">
                <label class="text-sm font-medium block mb-1">Job Type</label>
                <Select
                    v-model="selectedFilters.jobType"
                    :options="jobTypes"
                    placeholder="Select Job Type"
                    fluid
                    size="small"
                />
            </div>

            <div class="mb-2">
                <label class="text-sm font-medium block mb-1">Urgency</label>
                <Select
                    v-model="selectedFilters.urgency"
                    :options="urgencies"
                    placeholder="Select Urgency"
                    fluid
                    size="small"
                />
            </div>

            <div class="mb-2">
                <label class="text-sm font-medium block mb-1">Location</label>
                <MultiSelect
                    v-model="selectedFilters.location"
                    :options="locations"
                    placeholder="Select Location"
                    :maxSelectedLabels="3"
                    fluid
                    size="small"
                />
            </div>

            <Button
                label="Apply Filters"
                class="w-full mt-2"
                @click="applyFilters"
                size="small"
            />
        </Drawer>

        <!-- Footer -->
        <Footer class="hidden md:block bg-gray-100" />
    </div>

    <PostJobModal v-model:modelValue="jobPostModal" />
</template>
