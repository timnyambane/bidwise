<script setup>
import { capitalize, onMounted, ref } from "vue";
import axios from "axios";

const activeJobs = ref([]);
const isLoading = ref(false);

const fetchJobPosts = async () => {
    isLoading.value = true;
    try {
        const response = await axios.get(route("job-post.index"));
        activeJobs.value = response.data.data.jobPosts;
    } catch (error) {
        console.error("Error fetching job posts:", error);
    } finally {
        isLoading.value = false;
    }
};

onMounted(() => {
    fetchJobPosts();
});
</script>

<template>
    <main class="space-y-4">
        <section
            v-if="!isLoading"
            v-for="job in activeJobs"
            :key="job.id"
            class="relative bg-white shadow-md hover:shadow-lg p-2 md:px-4 rounded-lg transition border border-gray-200"
        >
            <header class="flex items-center gap-2">
                <img
                    src="@/assets/smile.jpg"
                    alt="Customer avatar"
                    class="w-14 h-14 rounded-full border border-gray-300 object-cover"
                    loading="lazy"
                />
                <div>
                    <h2
                        class="text-lg font-semibold text-gray-900 flex items-center gap-1"
                    >
                        {{ job.title }}
                    </h2>
                    <p class="text-sm text-gray-600 flex">
                        {{ job.customer.first_name }}
                        {{ job.customer.last_name }} &middot;
                        {{ new Date(job.created_at).toLocaleDateString() }}
                        <Icon
                            v-if="job.standard"
                            icon="material-symbols-light:verified-rounded"
                            class="text-yellow-500 text-xl"
                            aria-label="Verified"
                        />
                    </p>
                </div>
            </header>

            <p class="text-gray-700 text-sm leading-relaxed mt-2">
                {{ job.desc }}
            </p>

            <ul class="flex flex-wrap gap-2 text-sm mt-3">
                <li
                    v-for="(icon, key) in [
                        // [
                        //     'lucide:layers',
                        //     job.category,
                        //     'bg-orange-100 text-orange-800',
                        // ],
                        [
                            'proicons:branch',
                            job.service,
                            'bg-blue-100 text-blue-800',
                        ],
                        [
                            'heroicons-outline:map-pin',
                            job.location,
                            'bg-green-100 text-green-800',
                        ],
                        [
                            'lucide:timer',
                            job.urgency === 'specificDate'
                                ? job.date || 'N/A'
                                : capitalize(job.urgency),
                            'bg-purple-100 text-purple-800',
                        ],
                        [
                            'lucide:building-2',
                            capitalize(job.property),
                            'bg-red-100 text-red-800',
                        ],
                    ]"
                    :key="job.id + '-' + key"
                    :class="`flex items-center gap-1.5 px-2.5 py-1 rounded-full ${icon[2]}`"
                >
                    <Icon :icon="icon[0]" class="text-lg" />
                    <span>{{ icon[1] }}</span>
                </li>
            </ul>
            <div class="flex items-center justify-end mt-2">
                <button
                    class="bg-[#EF4444] px-2 py-1.5 rounded-md text-white text-sm font-medium"
                >
                    Cancel Job
                </button>
            </div>
        </section>
        <div v-if="isLoading" class="flex justify-center items-center h-40">
            <span class="loader">Loading</span>
        </div>
    </main>
</template>
