<script setup>
import { Head } from "@inertiajs/vue3";
import Layout from "../Layouts/Default.vue";

defineOptions({ layout: Layout });
</script>
<template>
    <Head title="Welcome" />
    <div class="flex pt-10 container mx-auto items-center">
        <div class="flex-1 flex flex-col gap-4">
            <h1 class="font-bold text-4xl">
                Ditch the DIY, Discover the Pros.
            </h1>
            <h2 class="font-medium text-base">
                Seamlessly connect with top local professionals to get your
                tasks done right—effortlessly, efficiently, and right in your
                neighborhood
            </h2>
            <div class="flex gap-4">
                <Button label="Join Now" />
                <Button
                    label="Learn More"
                    variant="outlined"
                    icon="fa-solid fa-arrow-right"
                    iconPos="right"
                />
            </div>
        </div>

        <div class="flex-1">
            <img src="@/Assets/landing-img.svg" alt="Landing page" />
        </div>
    </div>
</template>
