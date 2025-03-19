<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";

import Layout from "@/Layouts/Default.vue";

defineOptions({ layout: Layout });

const loginDetails = useForm({
    email: "",
    password: "",
    remember: false,
});

const handleSubmit = () => {
    loginDetails.post(route("login"));
};
</script>

<template>
    <Head title="Login" />
    <div class="flex items-center justify-center px-4 container mx-auto">
        <form
            @submit.prevent="handleSubmit"
            class="flex flex-col gap-5 w-full max-w-md p-8 mt-16"
        >
            <!-- Title -->
            <h2 class="text-4xl font-extrabold text-gray-800 text-center">
                Welcome back
            </h2>
            <p class="text-sm text-gray-500 text-center">
                Welcome back! Please enter your details to sign in.
            </p>

            <div class="flex flex-col gap-1">
                <IconField class="w-full">
                    <InputIcon class="fa-solid fa-envelope" />
                    <InputText
                        id="email"
                        v-model="loginDetails.email"
                        placeholder="Enter your email"
                        type="email"
                        fluid
                    />
                </IconField>
                <p
                    v-if="loginDetails.errors.email"
                    id="full_name_error"
                    class="text-red-500 text-sm"
                >
                    {{ loginDetails.errors.email }}
                </p>
            </div>
            <div class="flex flex-col gap-1">
                <IconField class="w-full">
                    <InputIcon class="fa-solid fa-lock" />
                    <Password
                        id="password"
                        v-model="loginDetails.password"
                        placeholder="Enter your password"
                        :feedback="false"
                        toggle-mask
                        fluid
                    />
                </IconField>
                <p
                    v-if="loginDetails.errors.password"
                    id="full_name_error"
                    class="text-red-500 text-sm"
                >
                    {{ loginDetails.errors.password }}
                </p>
            </div>

            <div class="flex items-center justify-start w-full text-sm">
                <div class="flex gap-2">
                    <Checkbox
                        binary
                        v-model="loginDetails.remember"
                        inputId="remember"
                    />
                    <label for="remember" class="text-gray-800 text-sm"
                        >Remember Me</label
                    >
                </div>
            </div>

            <!-- Login Button -->
            <Button
                type="submit"
                label="Login"
                :loading="loginDetails.processing"
            />

            <!-- Signup Link -->
            <Link
                href="#"
                class="text-primary-600 text-center text-sm hover:underline my-10"
            >
                Forgot Password?
            </Link>
        </form>
    </div>
</template>
