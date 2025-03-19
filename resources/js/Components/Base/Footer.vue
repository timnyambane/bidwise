<script setup>
import { Link } from "@inertiajs/vue3";
const appName = import.meta.env.VITE_APP_NAME || "Laravel";
</script>

<template>
    <footer class="bg-gray-50 text-gray-800 py-10">
        <div class="container mx-auto px-6">
            <div
                class="flex flex-col md:flex-row justify-around items-start gap-4"
            >
                <!-- Logo & About -->
                <div>
                    <img
                        src="@/assets/bidwise-txt.svg"
                        alt="Logo"
                        class="h-5"
                    />

                    <p class="text-sm mt-2 text-gray-600">
                        Delivering innovative solutions for modern businesses.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h2 class="text-lg font-bold text-primary-60">
                        Quick Links
                    </h2>
                    <ul class="mt-2 space-y-2 text-sm flex gap-2">
                        <li>
                            <a href="#" class="hover:text-blue-600 transition"
                                >Home</a
                            >
                        </li>
                        <li>
                            <a href="#" class="hover:text-blue-600 transition"
                                >Services</a
                            >
                        </li>
                        <li>
                            <a href="#" class="hover:text-blue-600 transition"
                                >About</a
                            >
                        </li>
                        <li>
                            <a href="#" class="hover:text-blue-600 transition"
                                >Contact</a
                            >
                        </li>
                    </ul>
                </div>

                <!-- Newsletter Subscription -->
                <div>
                    <h2 class="text-lg font-bold">Newsletter</h2>
                    <p class="text-sm my-2 text-gray-600">
                        Subscribe to get the latest updates and news.
                    </p>
                    <InputGroup>
                        <InputText placeholder="E-mail" size="small" />
                        <Button label="Subscribe" size="small" />
                    </InputGroup>
                </div>

                <!-- Social Media -->
                <div>
                    <h2 class="text-lg font-semibold">Follow Us</h2>
                    <div class="flex gap-4 mt-3">
                        <Link
                            href="#"
                            class="hover:text-primary-600 transition"
                        >
                            <Icon icon="fa-brands:facebook" class="text-xl" />
                        </Link>
                        <Link
                            href="#"
                            class="hover:text-primary-600 transition"
                        >
                            <Icon icon="fa-brands:twitter" class="text-xl" />
                        </Link>
                        <Link
                            href="#"
                            class="hover:text-primary-600 transition"
                        >
                            <Icon icon="fa-brands:instagram" class="text-xl" />
                        </Link>
                        <Link
                            href="#"
                            class="hover:text-primary-600 transition"
                        >
                            <Icon icon="fa-brands:linkedin" class="text-xl" />
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t mt-6 pt-4 text-center text-sm text-gray-600">
                &copy; {{ new Date().getFullYear() }} {{ appName }}. All rights
                reserved.
            </div>
        </div>
    </footer>
</template>
