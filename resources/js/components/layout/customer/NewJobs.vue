<script setup>
import { onMounted, ref } from "vue";
import { usePage } from "@inertiajs/vue3";

const jobPosts = ref(null);
const { locations, work_categories } = usePage().props;

onMounted(() => {
    fetchJobs();
});

const fetchJobs = async () => {
    const response = await axios.get(route("job-posts.index"));
    jobPosts.value = response.data.jobs;
};

const getLocationName = (id) => {
    const location = locations.find((loc) => loc.id === id);
    return location ? location.town : "Unknown Location";
};

const getWorkCategoryName = (id) => {
    const category = work_categories.find((cat) => cat.id === id);
    return category ? category.name : "Unknown Category";
};

const getServiceName = (workCategoryId, serviceId) => {
    const category = work_categories.find((cat) => cat.id === workCategoryId);
    if (category) {
        const service = category.services.find((srv) => srv.id === serviceId);
        return service ? service.name : "Unknown Service";
    }
    return "Unknown Service";
};
</script>

<template>
    <div
        v-for="(jobPost, index) in jobPosts"
        :key="index"
        class="flex flex-col border p-2 rounded-md shadow bg-white my-2"
    >
        <!-- Header Section -->
        <div class="flex items-center gap-2">
            <Avatar label="P" size="large" shape="circle" />
            <div>
                <h1 class="text-lg font-semibold text-gray-900">
                    {{ jobPost.title }}
                </h1>
                <span class="text-sm text-gray-500">Posted 2 days ago</span>
            </div>
        </div>

        <!-- Content Section -->
        <div class="flex flex-col gap-1">
            <table class="min-w-full mt-2 rounded">
                <tbody>
                    <tr class="">
                        <td class="px-4 py-1.5 font-medium text-primary-800">
                            Service:
                        </td>
                        <td class="px-4 py-1.5">
                            {{ getWorkCategoryName(jobPost.work_category_id) }}
                            -> {{ getServiceName(jobPost.service_id) }}
                        </td>
                    </tr>
                    <tr class="bg-gray-50">
                        <td class="px-4 py-1.5 font-medium text-primary-800">
                            Urgency:
                        </td>
                        <td class="px-4 py-1.5">{{ jobPost.urgency }}</td>
                    </tr>
                    <tr class="bg-white">
                        <td class="px-4 py-1.5 font-medium text-primary-800">
                            Property:
                        </td>
                        <td class="px-4 py-1.5">Residential</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <td class="px-4 py-1.5 font-medium text-primary-800">
                            Location:
                        </td>
                        <td class="px-4 py-1.5">
                            {{ getLocationName(jobPost.location_id) }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="text-gray-700 py-2 px-2 rounded-md">
                <span class="block font-medium mb-1 text-primary-800">
                    Description:
                </span>
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
</template>
