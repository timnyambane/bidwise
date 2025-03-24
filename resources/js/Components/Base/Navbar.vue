<script setup>
import { ref } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

const isDrawerOpen = ref(false);

const navLinks = [
    { name: "Home", route: "home" },
    { name: "Services", route: "home" },
    { name: "About", route: "register.customer" },
    { name: "Contact", route: "register.business" },
];
</script>

<template>
    <nav class="shadow">
        <div class="container flex items-center justify-between mx-auto p-2">
            <Link :href="route('home')">
                <img src="@/assets/bidwise-full.svg" alt="Logo" class="h-10" />
            </Link>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center gap-6">
                <Button
                    v-if="usePage().props.auth.user"
                    label="Contact Us"
                    size="small"
                    icon="fa-solid fa-phone"
                    variant="outlined"
                    as="a"
                    href="tel:0706783789"
                />
                <Button
                    v-if="!usePage().props.auth.user"
                    label="Login"
                    size="small"
                    icon="fa-solid fa-right-to-bracket"
                    as="a"
                    :href="route('login')"
                />
                <Button
                    v-if="usePage().props.auth.user"
                    label="Dashboard"
                    size="small"
                    as="a"
                    :href="route('dashboard')"
                />
            </div>

            <!-- Mobile Menu Button -->
            <div class="lg:hidden">
                <Button variant="text" @click="isDrawerOpen = true">
                    <Icon icon="lucide:menu" class="text-2xl" />
                </Button>
            </div>
        </div>

        <!-- Mobile Drawer -->
        <Drawer v-model:visible="isDrawerOpen" position="right">
            <div class="flex flex-col gap-4 p-2">
                <Link
                    v-for="link in navLinks"
                    :key="link.name"
                    class="text-gray-700 text-lg hover:text-blue-600 transition"
                >
                    {{ link.name }}
                </Link>

                <Button
                    label="Contact Us"
                    size="small"
                    icon="fa-solid fa-phone"
                    variant="outlined"
                    class="w-full"
                />
                <Button
                    label="Login"
                    size="small"
                    icon="fa-solid fa-right-to-bracket"
                    as="a"
                    :href="route('login')"
                    class="w-full"
                />
            </div>
        </Drawer>
    </nav>
</template>
