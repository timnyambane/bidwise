<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { ref, computed, watch } from "vue";

const { locations, work_categories } = usePage().props;
const isLoading = ref(false);
const step = ref(1);

const registrationForm = useForm({
    full_name: "",
    email: "",
    password: "",
    confirmPassword: "",
    business_name: "",
    phone: "",
    location: "",
    work_category: "",
    services: [],
});

const handleRegister = async () => {
    if (step.value === 1) {
        isLoading.value = true;

        await registrationForm.post(route("register.business.validate-user"), {
            onSuccess: () => {
                step.value = 2;
                isLoading.value = false;
            },
            onError: () => {
                isLoading.value = false;
            },
        });
    } else if (step.value === 2) {
        isLoading.value = true;

        await registrationForm.post(
            route("register.business.validate-business"),
            {
                onSuccess: async () => {
                    await registrationForm.post(
                        route("register.business.store"),
                        {
                            onSuccess: () => {
                                console.log("Business successfully stored!");
                                isLoading.value = false;
                            },
                            onError: () => {
                                console.log("Error storing business.");
                                isLoading.value = false;
                            },
                        }
                    );
                },
                onError: () => {
                    console.log("Error occurred during validation.");
                    isLoading.value = false;
                },
            }
        );
    }
};

const filteredServices = computed(() => {
    const selectedCategory = work_categories.find(
        (cat) => cat.id === registrationForm.work_category?.id
    );
    return selectedCategory ? selectedCategory.services : [];
});

// Reset services when work_category changes
watch(
    () => registrationForm.work_category,
    () => {
        registrationForm.services = [];
    }
);
</script>

<template>
    <Head title="Register Business" />
    <div class="flex min-h-screen">
        <div
            class="hidden md:flex w-1/2 bg-gray-200 items-center justify-center"
        >
            <img
                src="https://img.freepik.com/free-vector/business-man-described-showing-graph-stock-financial-trade-market-diagram-vector-illustration-flat-design_1150-39768.jpg?t=st=1738582212~exp=1738585812~hmac=ac557951b80e5ee76041519be26589bbae6b439c67ef073b51335ed28c25cf61&w=1380"
                alt="Register Image"
                class="w-3/4 h-auto rounded-lg shadow-lg"
            />
        </div>
        <div
            class="w-full md:w-1/2 flex items-center justify-center bg-white px-8 py-12"
        >
            <div class="w-full max-w-md">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
                    Create your Business Account
                </h2>
                <form @submit.prevent="handleRegister">
                    <div v-if="step === 1" class="space-y-4">
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-600"
                                >Full Name</label
                            >
                            <InputText
                                v-model="registrationForm.full_name"
                                class="w-full"
                                id="full_name"
                                type="text"
                            />
                            <p
                                v-if="registrationForm.errors.full_name"
                                class="text-red-500 text-sm"
                            >
                                {{ registrationForm.errors.full_name }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-600"
                                >Email</label
                            >
                            <InputText
                                v-model="registrationForm.email"
                                class="w-full"
                                id="email"
                                type="email"
                            />
                            <p
                                v-if="registrationForm.errors.email"
                                class="text-red-500 text-sm"
                            >
                                {{ registrationForm.errors.email }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-600"
                                >Phone</label
                            >
                            <InputText
                                v-model="registrationForm.phone"
                                class="w-full"
                                id="phone"
                                type="tel"
                            />
                            <p
                                v-if="registrationForm.errors.phone"
                                class="text-red-500 text-sm"
                            >
                                {{ registrationForm.errors.phone }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-600"
                                >Password</label
                            >
                            <Password
                                v-model="registrationForm.password"
                                class="w-full"
                                toggle-mask
                                :feedback="false"
                            />
                            <p
                                v-if="registrationForm.errors.password"
                                class="text-red-500 text-sm"
                            >
                                {{ registrationForm.errors.password }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-600"
                                >Confirm Password</label
                            >
                            <Password
                                v-model="registrationForm.confirmPassword"
                                class="w-full"
                                :feedback="false"
                            />
                            <p
                                v-if="registrationForm.errors.confirmPassword"
                                class="text-red-500 text-sm"
                            >
                                {{ registrationForm.errors.confirmPassword }}
                            </p>
                        </div>
                    </div>

                    <div v-if="step === 2" class="space-y-4">
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-600"
                                >Business Name</label
                            >
                            <InputText
                                v-model="registrationForm.business_name"
                                class="w-full"
                                id="company"
                                type="text"
                            />
                            <p
                                v-if="registrationForm.errors.business_name"
                                class="text-red-500 text-sm"
                            >
                                {{ registrationForm.errors.business_name }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-600"
                                >Location</label
                            >
                            <Select
                                v-model="registrationForm.location"
                                :options="locations"
                                optionLabel="town"
                                placeholder="Select a Location"
                                class="w-full"
                            />
                            <p
                                v-if="registrationForm.errors.location"
                                class="text-red-500 text-sm"
                            >
                                {{ registrationForm.errors.location }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-600"
                                >Work Category</label
                            >
                            <Select
                                v-model="registrationForm.work_category"
                                :options="work_categories"
                                optionLabel="name"
                                placeholder="Select a Category"
                                class="w-full"
                            />
                            <p
                                v-if="registrationForm.errors.work_category"
                                class="text-red-500 text-sm"
                            >
                                {{ registrationForm.errors.work_category }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-600"
                                >Services</label
                            >
                            <MultiSelect
                                v-model="registrationForm.services"
                                :options="filteredServices"
                                optionLabel="name"
                                placeholder="Select a Service"
                                class="w-full"
                            />

                            <p
                                v-if="registrationForm.errors.services"
                                class="text-red-500 text-sm"
                            >
                                {{ registrationForm.errors.services }}
                            </p>
                        </div>
                    </div>

                    <Button
                        type="submit"
                        :label="step === 1 ? 'Next Step' : 'Register'"
                        class="w-full mt-4"
                        :loading="registrationForm.processing"
                        icon="fa-solid fa-arrow-right"
                        iconPos="right"
                    />
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-800">
                        Already have an account?
                        <Link
                            href="/login"
                            class="text-primary-600 hover:underline font-semibold"
                            >Login</Link
                        >
                    </p>
                    <span v-if="step > 1" class="cursor-pointer" @click="step--"
                        >Back</span
                    >
                </div>
            </div>
        </div>
    </div>
</template>
