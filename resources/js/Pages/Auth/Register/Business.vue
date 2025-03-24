<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import Layout from "@/Layouts/Default.vue";

defineOptions({ layout: Layout });

const registerForm = useForm({
    full_name: "",
    email: "",
    phone: "",
    password: "",
    confirmPassword: "",
});

const handleSubmit = () => {};
</script>

<template>
    <Head title="Register Customer" />
    <div
        class="flex items-center justify-center px-4 container mx-auto gap-8 mt-10"
    >
        <div class="flex items-center justify-center py-6">
            <form class="flex flex-col w-xl gap-6">
                <h1 class="font-bold text-3xl text-center">
                    Register as Business
                </h1>

                <div class="flex flex-col gap-1">
                    <IconField>
                        <InputIcon class="fa-solid fa-user" />
                        <InputText
                            id="full_name"
                            v-model="registerForm.full_name"
                            placeholder="Full Name"
                            type="text"
                            fluid
                        />
                    </IconField>
                    <p
                        v-if="registerForm.errors.full_name"
                        id="full_name_error"
                        class="text-red-500 text-sm"
                    >
                        {{ registerForm.errors.full_name }}
                    </p>
                </div>

                <div class="flex flex-col gap-1">
                    <IconField>
                        <InputIcon class="fa-solid fa-envelope" />
                        <InputText
                            id="email"
                            v-model="registerForm.email"
                            placeholder="Email"
                            type="email"
                            fluid
                        />
                    </IconField>
                    <p
                        v-if="registerForm.errors.email"
                        id="full_name_error"
                        class="text-red-500 text-sm"
                    >
                        {{ registerForm.errors.email }}
                    </p>
                </div>
                <div class="flex flex-col gap-1">
                    <IconField>
                        <InputIcon class="fa-solid fa-phone" />
                        <InputText
                            id="tel"
                            v-model="registerForm.phone"
                            placeholder="Phone Number"
                            type="tel"
                            fluid
                        />
                    </IconField>
                    <p
                        v-if="registerForm.errors.phone"
                        id="full_name_error"
                        class="text-red-500 text-sm"
                    >
                        {{ registerForm.errors.phone }}
                    </p>
                </div>

                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex flex-col gap-1 flex-1">
                        <IconField class="w-full">
                            <InputIcon class="fa-solid fa-lock" />
                            <Password
                                id="password"
                                v-model="registerForm.password"
                                placeholder="Password"
                                :feedback="false"
                                toggle-mask
                                fluid
                            />
                        </IconField>
                        <p
                            v-if="registerForm.errors.password"
                            id="full_name_error"
                            class="text-red-500 text-sm"
                        >
                            {{ registerForm.errors.password }}
                        </p>
                    </div>
                    <div class="flex flex-col flex-1 gap-1">
                        <IconField class="w-full">
                            <InputIcon class="fa-solid fa-lock" />
                            <Password
                                id="confirm_password"
                                v-model="registerForm.confirmPassword"
                                placeholder="Confirm Password"
                                :feedback="false"
                                fluid
                            />
                        </IconField>
                        <p
                            v-if="registerForm.errors.confirmPassword"
                            id="full_name_error"
                            class="text-red-500 text-sm"
                        >
                            {{ registerForm.errors.confirmPassword }}
                        </p>
                    </div>
                </div>

                <Button
                    label="Create Account"
                    class="mt-4"
                    @click="handleSubmit"
                    :loading="registerForm.processing"
                />

                <Button
                    label="Register as a Customer"
                    as="a"
                    variant="link"
                    class="lg:mt-10 w-fit mx-auto"
                    :href="route('register.customer.create')"
                />
            </form>
        </div>
    </div>
</template>
