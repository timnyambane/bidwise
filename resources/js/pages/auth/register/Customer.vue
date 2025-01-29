<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const isLoading = ref(false);

const registerForm = useForm({
    full_name: "",
    email: "",
    phone: "",
    password: "",
    password_confirmation: "",
    photo: null,
});

const handleRegister = () => {
    isLoading.value = true;
    registerForm.post(route("register.store"), {
        onFinish: () => (isLoading.value = false),
    });
};

const handlePhotoUpload = (event) => {
    registerForm.photo = event.target.files[0];
};
</script>

<template>
    <Head title="Register" />
    <div class="flex min-h-screen">
        <!-- Left Section - Image -->
        <div
            class="hidden md:flex w-1/2 bg-gray-200 items-center justify-center"
        >
            <img
                src="https://img.freepik.com/free-vector/youth-day-with-jumping-people_23-2148599669.jpg?t=st=1738153234~exp=1738156834~hmac=52ee7d094d0629698f9c2995c2e1df964b6982b1bdf1ad4f0521cbc852ab6b01&w=1380"
                alt="Register Image"
                class="w-3/4 h-auto rounded-lg shadow-lg"
            />
        </div>

        <!-- Right Section - Registration Form -->
        <div
            class="w-full md:w-1/2 flex items-center justify-center bg-white px-8 py-12"
        >
            <div class="w-full max-w-md">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
                    Create an Account
                </h2>
                <form @submit.prevent="handleRegister" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600"
                            >Full Name</label
                        >
                        <InputText
                            type="text"
                            v-model="registerForm.full_name"
                            class="w-full"
                        />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600"
                            >Email</label
                        >
                        <InputText
                            type="email"
                            v-model="registerForm.email"
                            class="w-full"
                        />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600"
                            >Phone</label
                        >
                        <InputText
                            type="tel"
                            v-model="registerForm.phone"
                            class="w-full"
                        />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600"
                            >Password</label
                        >
                        <Password
                            v-model="registerForm.password"
                            class="w-full"
                            toggle-mask
                            :feedback="false"
                        />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600"
                            >Confirm Password</label
                        >
                        <Password
                            v-model="registerForm.password_confirmation"
                            class="w-full"
                            :feedback="false"
                        />
                    </div>
                    <Button type="submit" label="Register" class="w-full" />
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-800">
                        Already have an account?
                        <Link
                            href="/login"
                            class="text-blue-600 hover:underline"
                            >Login</Link
                        >
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
