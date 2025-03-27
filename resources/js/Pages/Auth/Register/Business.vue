<script setup>
import { Head, useForm, usePage } from "@inertiajs/vue3";
import Layout from "@/Layouts/Default.vue";
import { ref, computed, watch } from "vue";

defineOptions({ layout: Layout });

const { locations, categories } = usePage().props;

const registerForm = useForm({
    full_name: null,
    email: null,
    phone: null,
    password: null,
    confirmPassword: null,
    location: null,
    business_name: null,
    category: null,
    services: [],
});

const regStep = ref(2);

const handleNextStep = () => {
    if (regStep.value === 1) {
        regStep.value = 2;
    } else {
        console.log(registerForm);
    }
};

const handleBackStep = () => {
    if (regStep.value > 1) regStep.value--;
};

// Computed property to filter services based on the selected category
const services = computed(() => {
    return (
        categories.find((cat) => cat.id === registerForm.category?.id)
            ?.services ?? []
    );
});

// Watch for changes in category selection and reset selected services
watch(
    () => registerForm.category,
    () => {
        registerForm.services = [];
    }
);
</script>

<template>
    <Head title="Register Customer" />

    <div
        class="flex items-center justify-center px-4 container mx-auto gap-8 mt-10"
    >
        <div class="flex items-center justify-center py-6">
            <form class="flex flex-col w-sm lg:w-xl gap-6">
                <h1 class="font-bold text-3xl text-center">
                    Register as Business
                </h1>

                <!-- Stepper -->
                <div class="flex items-center justify-center gap-6">
                    <template
                        v-for="(step, index) in [
                            'Personal Details',
                            'Business Details',
                        ]"
                        :key="index"
                    >
                        <div
                            class="flex gap-1 items-center"
                            :class="
                                regStep === index + 1
                                    ? 'text-primary-600'
                                    : 'text-gray-800'
                            "
                        >
                            <Icon
                                :icon="
                                    index === 0
                                        ? 'lucide:circle-user-round'
                                        : 'material-symbols:business-center-outline'
                                "
                                class="text-2xl"
                            />
                            <p>{{ step }}</p>
                        </div>
                        <Icon
                            v-if="index === 0"
                            icon="lsicon:right-filled"
                            class="text-2xl text-gray-800"
                        />
                    </template>
                </div>

                <!-- Step 1: Personal Details -->
                <div v-if="regStep === 1" class="flex flex-col gap-4">
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
                            class="text-red-500 text-sm"
                        >
                            {{ registerForm.errors.email }}
                        </p>
                    </div>

                    <div class="flex flex-col gap-1">
                        <IconField>
                            <InputIcon class="fa-solid fa-phone" />
                            <InputText
                                id="phone"
                                v-model="registerForm.phone"
                                placeholder="Phone Number"
                                type="tel"
                                fluid
                            />
                        </IconField>
                        <p
                            v-if="registerForm.errors.phone"
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
                                class="text-red-500 text-sm"
                            >
                                {{ registerForm.errors.confirmPassword }}
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Step 2: Business Details -->
                <div v-if="regStep === 2" class="flex flex-col gap-4">
                    <div class="flex flex-col gap-1">
                        <IconField>
                            <InputIcon class="fa-solid fa-briefcase" />
                            <InputText
                                id="company name"
                                v-model="registerForm.business_name"
                                placeholder="Business Name"
                                type="text"
                                fluid
                            />
                        </IconField>
                    </div>
                    <div class="flex flex-col gap-1">
                        <Select
                            v-model="registerForm.location"
                            placeholder="Select your business location"
                            :options="locations"
                            optionLabel="location"
                            fluid
                        />
                    </div>
                    <div class="flex flex-col gap-1">
                        <Select
                            v-model="registerForm.category"
                            placeholder="Select your category"
                            :options="categories"
                            optionLabel="name"
                            fluid
                        />
                    </div>
                    <div class="flex flex-col gap-1">
                        <MultiSelect
                            v-model="registerForm.services"
                            placeholder="Select all services you provide"
                            :options="services"
                            optionLabel="name"
                            :maxSelectedLabels="3"
                            fluid
                        />
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-between mt-4">
                    <Button
                        v-if="regStep > 1"
                        label="Back"
                        variant="outlined"
                        icon="fa-solid fa-arrow-left"
                        @click.prevent="handleBackStep"
                    />
                    <Button
                        :icon="regStep === 1 ? 'fa-solid fa-arrow-right' : ''"
                        iconPos="right"
                        :label="regStep === 1 ? 'Next' : 'Create Account'"
                        @click.prevent="handleNextStep"
                        :loading="registerForm.processing"
                    />
                </div>
            </form>
        </div>
    </div>
</template>
