<script setup>
import { onMounted, ref } from "vue";
import { usePage } from "@inertiajs/vue3";

// Reactive state
const jobPosts = ref([]);
const loadingJobs = ref(false);
const { locations, work_categories } = usePage().props;
const menu = ref();

// Fetch job posts on mount
onMounted(fetchJobs);

const toggle = (event) => {
    menu.value.toggle(event);
};

const jobActions = ref([
    {
        label: "Options",
        items: [
            { label: "Cancel", icon: "fa-solid fa-xmark" },
            { label: "Edit", icon: "fa-solid fa-pen" },
        ],
    },
]);

async function fetchJobs() {
    loadingJobs.value = true;
    try {
        const { data, status } = await axios.get(route("job-posts.index"), {
            timeout: 5000,
        });

        if (status === 200 && Array.isArray(data.jobs)) {
            jobPosts.value = data.jobs;
        } else {
            console.warn("Unexpected API response format:", data);
        }
    } catch (error) {
        console.error("Error fetching jobs:", error);
        let message = "An unexpected error occurred. Please try again.";

        if (!error.response) {
            message = "Network error. Please check your internet connection.";
        } else {
            const { status } = error.response;
            if (status === 404) message = "Job data not found.";
            else if (status >= 500)
                message = "Server error. Please try again later.";
        }
        alert(message);
    } finally {
        loadingJobs.value = false;
    }
}

const getLocationName = (id) =>
    locations.find((loc) => loc.id === id)?.location || "Unknown Location";
const getServiceName = (workCategoryId, serviceId) => {
    return (
        work_categories
            .find((cat) => cat.id === workCategoryId)
            ?.services?.find((srv) => srv.id === serviceId)?.name ||
        "Unknown Service"
    );
};

const formatDate = (dateString) => {
    return dateString
        ? new Intl.DateTimeFormat("en-GB", {
              year: "numeric",
              month: "short",
              day: "numeric",
          }).format(new Date(dateString))
        : "Unknown Date";
};
</script>

<template>
    <div>
        <div
            v-if="loadingJobs"
            class="flex flex-col items-center min-h-40 justify-center"
        >
            <Icon
                icon="mingcute:loading-line"
                class="animate-spin text-3xl text-primary-500"
            />
            <p class="mt-2 text-gray-500 font-medium">Loading jobs...</p>
        </div>
        <div
            v-else
            v-for="jobPost in jobPosts"
            :key="jobPost.id"
            class="flex flex-col border p-2 rounded-md shadow bg-white my-2"
        >
            <div class="flex items-top gap-2 justify-between">
                <div class="flex gap-2 items-center">
                    <Avatar label="P" size="large" shape="circle" />
                    <div>
                        <h1 class="md:text-lg font-semibold text-gray-900">
                            {{ jobPost.title }}
                        </h1>
                        <span class="text-xs md:text-sm text-gray-500"
                            >Posted on
                            {{ formatDate(jobPost.created_at) }}</span
                        >
                    </div>
                </div>
                <div>
                    <Button
                        type="button"
                        text
                        icon="fa-solid fa-ellipsis-vertical"
                        @click="toggle($event)"
                        aria-haspopup="true"
                        aria-controls="overlay_menu"
                    />

                    <Menu
                        ref="menu"
                        id="overlay_menu"
                        :model="jobActions"
                        :popup="true"
                    />
                </div>
            </div>
            <div class="flex flex-col gap-1">
                <table class="min-w-full mt-2 text-sm md:text-base">
                    <tbody>
                        <tr>
                            <td class="px-4 py-1.5 text-primary-800">
                                Service:
                            </td>
                            <td class="px-4 py-1.5">
                                {{
                                    getServiceName(
                                        jobPost.work_category_id,
                                        jobPost.service_id
                                    )
                                }}
                            </td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="px-4 py-1.5 text-primary-800">
                                Urgency:
                            </td>
                            <td class="px-4 py-1.5">
                                {{
                                    jobPost.urgency === "specificDate"
                                        ? formatDate(jobPost.specificDate)
                                        : jobPost.urgency
                                }}
                            </td>
                        </tr>
                        <tr class="bg-white">
                            <td class="px-4 py-1.5 text-primary-800">
                                Property:
                            </td>
                            <td class="px-4 py-1.5">Residential</td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="px-4 py-1.5 text-primary-800">
                                Location:
                            </td>
                            <td class="px-4 py-1.5">
                                {{ getLocationName(jobPost.location_id) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-gray-700 py-2 px-2 rounded-md">
                    <span class="block font-medium mb-1 text-primary-800"
                        >Description:</span
                    >
                    <p class="text-sm leading-5 text-gray-700">
                        {{ jobPost.description }}
                    </p>
                </div>
            </div>
            <div class="flex justify-end mt-2">
                <Button
                    label="Cancel Job"
                    class="w-fit"
                    size="small"
                    severity="danger"
                />
            </div>
        </div>
    </div>
</template>
