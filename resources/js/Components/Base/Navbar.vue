<script setup>
import { ref } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

const isDrawerOpen = ref(false);

const navLinks = [
    { name: "Create Account", route: "register.customer.create" },
    { name: "Join as Business", route: "register.business.create" },
];
</script>

<template>
    <nav class="shadow">
        <div class="container flex items-center justify-between mx-auto p-2">
            <Link :href="route('home')" class="flex-1">
                <img src="@/assets/bidwise-full.svg" alt="Logo" class="h-10" />
            </Link>

            <div
                class="lg:flex items-center gap-4 flex-1 hidden justify-center"
            >
                <Link
                    :href="route('register.customer.create')"
                    :class="{
                        'text-primary-600 hover:text-primary-500 transition':
                            $page.url.startsWith('/register/customer'),
                    }"
                >
                    Create Account
                </Link>
                <Link
                    :href="route('register.business.create')"
                    :class="{
                        'text-primary-600 hover:text-primary-500 transition':
                            $page.url.startsWith('/register/business'),
                    }"
                >
                    Join as Business
                </Link>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center gap-6 flex-1 justify-end">
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
                    :href="route(link.route)"
                    :key="link.name"
                    class="text-gray-700 text-lg hover:text-primary-600 transition"
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
