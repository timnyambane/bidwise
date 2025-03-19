<script setup>
import { Head } from "@inertiajs/vue3";
import Navbar from "../Components/Base/Navbar.vue";
import Footer from "../Components/Base/Footer.vue";
</script>
<template>
    <Head title="Welcome" />
    <div class="flex flex-col min-h-screen">
        <Navbar />
        <div class="flex-grow">
            <slot />
        </div>
        <Footer />
    </div>
</template>
