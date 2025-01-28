<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";

const loginDetails = useForm({
    email: "",
    password: "",
});

const handleLogin = async () => {
    console.log(loginDetails);
    loginDetails.post(route("login.login"));
};
</script>

<template>
    <Head title="Login" />
    <div class="flex flex-col min-h-screen">
        <!-- Main Content -->
        <main class="flex-grow flex items-center justify-center bg-gray-100">
            <div
                class="w-full flex flex-col max-w-md bg-white shadow-lg rounded-lg p-8"
            >
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
                    Welcome back
                </h2>
                <form @submit.prevent="handleLogin">
                    <div class="mb-4">
                        <label
                            for="email"
                            class="block text-sm font-medium text-gray-600"
                            >Email Address</label
                        >
                        <InputText
                            type="email"
                            id="email"
                            v-model="loginDetails.email"
                            required
                            class="w-full mt-1"
                        />
                    </div>
                    <div class="mb-4">
                        <label
                            for="password"
                            class="block text-sm font-medium text-gray-600"
                            >Password</label
                        >
                        <Password
                            required
                            v-model="loginDetails.password"
                            class="w-full mt-1"
                            :feedback="false"
                            toggle-mask
                        />
                    </div>
                    <Button label="Login" class="w-full mb-2" type="submit" />
                </form>

                <Link
                    class="text-gray-800 text-sm text-center my-4"
                    href="/forgot-password"
                    >Forgot Password?
                </Link>
                <div class="mt-6 text-center">
                    <p class="text-gray-800">
                        Don't have an account?
                        <Link
                            href="/register"
                            class="text-primary-600 hover:underline"
                            >Sign up</Link
                        >
                    </p>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div
                    class="flex flex-col md:flex-row justify-between items-center"
                >
                    <p class="text-sm text-gray-600">
                        &copy; 2025 Brand. All rights reserved.
                    </p>
                    <div class="flex space-x-4 mt-2 md:mt-0">
                        <Link
                            href="/privacy"
                            class="text-gray-600 hover:text-gray-800"
                            >Privacy</Link
                        >
                        <Link
                            href="/terms"
                            class="text-gray-600 hover:text-gray-800"
                            >Terms</Link
                        >
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>
