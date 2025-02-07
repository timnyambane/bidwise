<script setup>
import { Link, Head } from "@inertiajs/vue3";
</script>

<template>
    <div class="flex flex-col">
        <Head title="Home" />
        <Link href="/dashboard">Dashboard</Link>
        <Link href="/register/business">Business Reg</Link>
    </div>
</template>
