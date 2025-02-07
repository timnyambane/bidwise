<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const isLoading = ref(false);

const registerForm = useForm({
    full_name: "",
    email: "",
    phone: "",
    password: "",
    confirmPassword: "",
});

const handleRegister = () => {
    isLoading.value = true;
    registerForm.post(route("register.customer.store"), {
        onFinish: () => (isLoading.value = false),
    });
};
</script>

<template>
    <Head title="Register" />
    <div class="flex min-h-screen">
        <!-- Left Section: Image -->
        <div
            class="hidden md:flex w-1/2 bg-gray-200 items-center justify-center"
        >
            <img
                src="https://img.freepik.com/free-vector/youth-day-with-jumping-people_23-2148599669.jpg?t=st=1738153234~exp=1738156834~hmac=52ee7d094d0629698f9c2995c2e1df964b6982b1bdf1ad4f0521cbc852ab6b01&w=1380"
                alt="Register Image"
                class="w-3/4 h-auto rounded-lg shadow-lg"
            />
        </div>

        <!-- Right Section: Registration Form -->
        <div
            class="w-full md:w-1/2 flex items-center justify-center bg-white px-8 py-12"
        >
            <div class="w-full max-w-md">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
                    Create an Account
                </h2>

                <!-- Registration Form -->
                <form @submit.prevent="handleRegister" class="space-y-4">
                    <!-- Full Name -->
                    <div>
                        <label
                            for="full_name"
                            class="block text-sm font-medium text-gray-600"
                            >Full Name</label
                        >
                        <InputText
                            id="full_name"
                            v-model="registerForm.full_name"
                            class="w-full"
                            type="text"
                            aria-describedby="full_name_error"
                        />
                        <p
                            v-if="registerForm.errors.full_name"
                            id="full_name_error"
                            class="text-red-500 text-sm"
                        >
                            {{ registerForm.errors.full_name }}
                        </p>
                    </div>

                    <!-- Email -->
                    <div>
                        <label
                            for="email"
                            class="block text-sm font-medium text-gray-600"
                            >Email</label
                        >
                        <InputText
                            id="email"
                            v-model="registerForm.email"
                            class="w-full"
                            type="email"
                            aria-describedby="email_error"
                        />
                        <p
                            v-if="registerForm.errors.email"
                            id="email_error"
                            class="text-red-500 text-sm"
                        >
                            {{ registerForm.errors.email }}
                        </p>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label
                            for="phone"
                            class="block text-sm font-medium text-gray-600"
                            >Phone</label
                        >
                        <InputText
                            id="phone"
                            v-model="registerForm.phone"
                            class="w-full"
                            type="tel"
                            aria-describedby="phone_error"
                        />
                        <p
                            v-if="registerForm.errors.phone"
                            id="phone_error"
                            class="text-red-500 text-sm"
                        >
                            {{ registerForm.errors.phone }}
                        </p>
                    </div>

                    <!-- Password -->
                    <div>
                        <label
                            for="password"
                            class="block text-sm font-medium text-gray-600"
                            >Password</label
                        >
                        <Password
                            id="password"
                            v-model="registerForm.password"
                            class="w-full"
                            toggle-mask
                            :feedback="false"
                        />
                        <p
                            v-if="registerForm.errors.password"
                            class="text-red-500 text-sm"
                        >
                            {{ registerForm.errors.password }}
                        </p>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label
                            for="confirmPassword"
                            class="block text-sm font-medium text-gray-600"
                            >Confirm Password</label
                        >
                        <Password
                            id="confirmPassword"
                            v-model="registerForm.confirmPassword"
                            class="w-full"
                            :feedback="false"
                        />
                        <p
                            v-if="registerForm.errors.confirmPassword"
                            class="text-red-500 text-sm"
                        >
                            {{ registerForm.errors.confirmPassword }}
                        </p>
                    </div>

                    <!-- Submit Button -->
                    <Button
                        type="submit"
                        label="Register"
                        class="w-full"
                        :loading="registerForm.processing || isLoading"
                    />
                </form>

                <!-- Login Redirect -->
                <div class="mt-6 text-center">
                    <p class="text-gray-800">
                        Already have an account?
                        <Link
                            href="/login"
                            class="text-primary-600 hover:underline font-semibold"
                            >Login</Link
                        >
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
