<script setup>
import { Icon } from "@iconify/vue";
import { usePage } from "@inertiajs/vue3";

const jobs = usePage().props.jobPosts;
</script>

<template>
    <main class="space-y-4">
        <section
            v-for="job in jobs"
            :key="job.id"
            class="relative bg-white shadow-md hover:shadow-lg p-2 md:px-4 rounded-lg transition border border-gray-200"
        >
            <header class="flex items-center gap-2">
                <img
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
                    <p class="text-sm text-gray-600">
                        Customer ID: {{ job.customer_id }} &middot;
                        {{ new Date(job.created_at).toLocaleDateString() }}
                    </p>
                </div>
            </header>

            <p class="text-gray-700 text-sm leading-relaxed mt-2">
                {{ job.desc }}
            </p>

            <ul class="flex flex-wrap gap-2 text-sm mt-3">
                <li
                    v-for="(icon, key) in [
                        [
                            'lucide:layers',
                            job.category.name,
                            'bg-orange-100 text-orange-800',
                        ],
                        [
                            'lucide:layers',
                            job.service.name,
                            'bg-blue-100 text-blue-800',
                        ],
                        [
                            'heroicons-outline:map-pin',
                            job.location.location,
                            'bg-green-100 text-green-800',
                        ],
                        [
                            'lucide:timer',
                            job.urgency,
                            'bg-purple-100 text-purple-800',
                        ],
                        [
                            'lucide:building-2',
                            job.property,
                            'bg-red-100 text-red-800',
                        ],
                    ]"
                    :key="key"
                    :class="`flex items-center gap-2 px-3 py-1 rounded-full ${icon[2]}`"
                >
                    <Icon :icon="icon[0]" class="text-lg" />
                    <span>{{ icon[1] }}</span>
                </li>
            </ul>
            <div class="flex items-center justify-end">
                <button
                    class="bg-[#EF4444] px-2 py-1.5 rounded-md text-white text-sm font-medium"
                >
                    Cancel Job
                </button>
            </div>
        </section>
    </main>
</template>
