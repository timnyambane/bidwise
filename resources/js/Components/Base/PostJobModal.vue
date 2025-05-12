<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { ref, computed, watch, capitalize } from "vue";
const { locations, categories } = usePage().props;

defineProps({
    modelValue: Boolean,
});

const emit = defineEmits(["update:modelValue"]);
const emitUpdate = (value) => {
    emit("update:modelValue", value);
    jobPost.reset();
    jobPostStep.value = 1;
};

const jobPost = useForm({
    title: null,
    desc: null,
    location: null,
    category: null,
    service: null,
    urgency: null,
    property: null,
    standard: null,
    date: null,
});

const isSuccess = ref(null);
const statusMessage = ref(null);

const services = computed(() => {
    return (
        categories.find((cat) => cat.id == jobPost.category?.id)?.services ?? []
    );
});

watch(
    () => jobPost.category,
    () => (jobPost.service = null)
);

const formattedDate = computed(() => {
    if (!jobPost.date) return "Not specified";
    return new Intl.DateTimeFormat("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
    }).format(new Date(jobPost.date));
});

const today = new Date();
const minDate = ref(new Date());
const maxDate = ref(new Date());
maxDate.value.setDate(today.getDate() + 30);

const jobPostStep = ref(1);

const canProceed = computed(() => {
    if (jobPostStep.value === 1) {
        return (
            jobPost.category &&
            jobPost.service &&
            jobPost.location &&
            jobPost.property
        );
    }
    if (jobPostStep.value === 2) {
        return (
            jobPost.title &&
            jobPost.desc &&
            jobPost.urgency &&
            (jobPost.urgency !== "specificDate" || jobPost.date)
        );
    }
    return true;
});

const submitJobPost = () => {
    if (jobPost.date) {
        const dateObj = new Date(jobPost.date);
        jobPost.date = dateObj.toISOString().slice(0, 19).replace("T", " ");
    }

    jobPost.post(route("job-post.store"), {
        onSuccess: () => {
            isSuccess.value = true;
            statusMessage.value = "Job posted successfully!";
            jobPostStep.value = 4;
            jobPost.reset();
        },
        onError: () => {
            isSuccess.value = false;
            statusMessage.value = "Failed to post job. Please try again.";
            jobPostStep.value = 4;
        },
    });
};
</script>

<template>
    <Dialog
        :visible="modelValue"
        modal
        header="Post a Job"
        @update:visible="emitUpdate(false)"
    >
        <div class="flex flex-col p-2 gap-4 w-sm lg:w-xl">
            <div>
                <!-- Step 1 -->
                <div v-if="jobPostStep === 1" class="flex flex-col gap-4">
                    <Select
                        v-model="jobPost.category"
                        placeholder="Select the category"
                        :options="categories"
                        optionLabel="name"
                        fluid
                    >
                        <template #dropdownicon>
                            <Icon icon="lucide:layers" />
                        </template>
                    </Select>
                    <Select
                        v-model="jobPost.service"
                        placeholder="Select the service"
                        :options="services"
                        optionLabel="name"
                        fluid
                    >
                        <template #dropdownicon>
                            <Icon icon="carbon:category" />
                        </template>
                    </Select>
                    <Select
                        v-model="jobPost.location"
                        placeholder="Select your location"
                        :options="locations"
                        optionLabel="location"
                        fluid
                    >
                        <template #dropdownicon>
                            <Icon icon="lucide:map-pin" />
                        </template>
                    </Select>

                    <Fieldset
                        legend="Property type"
                        class="flex flex-col flex-wrap mt-2"
                    >
                        <div class="flex items-center gap-2 mb-2">
                            <RadioButton
                                v-model="jobPost.property"
                                inputId="commercial"
                                name="property"
                                value="commercial"
                            />
                            <label for="commercial">Commercial</label>
                        </div>
                        <div class="flex items-center gap-2">
                            <RadioButton
                                v-model="jobPost.property"
                                inputId="residential"
                                name="property"
                                value="residential"
                            />
                            <label for="residential">Residential</label>
                        </div>
                    </Fieldset>
                </div>

                <!-- Step 2 -->
                <div v-if="jobPostStep === 2" class="flex flex-col gap-4">
                    <IftaLabel>
                        <InputText v-model="jobPost.title" fluid />
                        <label for="title">Job title</label>
                    </IftaLabel>
                    <IftaLabel>
                        <Textarea v-model="jobPost.desc" fluid autoResize />
                        <label for="desc">Job description</label>
                    </IftaLabel>
                    <div class="flex flex-col gap-1">
                        <div class="flex items-center my-1 justify-around">
                            <div class="flex items-center gap-2">
                                <RadioButton
                                    v-model="jobPost.urgency"
                                    inputId="Flexible"
                                    name="urgency"
                                    value="flexible"
                                />
                                <label for="Flexible">Flexible</label>
                            </div>
                            <div class="flex items-center gap-2">
                                <RadioButton
                                    v-model="jobPost.urgency"
                                    inputId="immediately"
                                    name="urgency"
                                    value="immediately"
                                />
                                <label for="immediately">Immediately</label>
                            </div>
                            <div class="flex items-center gap-2">
                                <RadioButton
                                    v-model="jobPost.urgency"
                                    inputId="specificDate"
                                    name="urgency"
                                    value="specificDate"
                                />
                                <label for="specificDate">Specific date</label>
                            </div>
                        </div>
                        <DatePicker
                            v-if="jobPost.urgency === 'specificDate'"
                            v-model="jobPost.date"
                            :minDate="minDate"
                            :maxDate="maxDate"
                            :manualInput="false"
                            class="w-fit"
                            size="small"
                            placeholder="Choose a date"
                            showIcon
                            showButtonBar
                        />
                    </div>
                    <div class="flex gap-2">
                        <Checkbox
                            v-model="jobPost.standard"
                            inputId="jobType"
                            name="premium"
                            binary
                            class="mt-1.5"
                        />
                        <label for="jobType" class="flex flex-col">
                            <div class="font-semibold">
                                <div class="flex gap-1 items-center">
                                    Premium post
                                    <Icon
                                        icon="material-symbols-light:verified-rounded"
                                        class="text-yellow-500"
                                        aria-label="Verified"
                                    />
                                </div>
                            </div>
                            <span class="text-sm text-wrap"
                                >This will only show your job post to verified
                                local service providers with proven quality
                                customer value.</span
                            >
                        </label>
                    </div>
                </div>

                <!-- Step 3: Summary -->
                <div
                    v-if="jobPostStep === 3"
                    class="flex flex-col gap-2.5 rounded-lg"
                >
                    <!-- Title Section -->
                    <div
                        class="flex justify-center gap-2 items-center border-b pb-2"
                    >
                        <h3 class="text-xl font-bold text-gray-800">
                            Review Your Job Post
                        </h3>
                        <Icon
                            v-if="jobPost.type"
                            icon="material-symbols-light:verified-rounded"
                            class="text-yellow-500 text-xl"
                            aria-label="Verified"
                        />
                    </div>

                    <!-- Job Details -->
                    <div class="space-y-2 text-gray-700">
                        <p>
                            <strong class="text-gray-900">Title:</strong>
                            {{ jobPost.title }}
                        </p>
                        <p>
                            <strong class="text-gray-900">Description:</strong>
                            {{ jobPost.desc }}
                        </p>
                    </div>

                    <!-- Tags Section -->
                    <div class="flex flex-wrap gap-2">
                        <p
                            class="flex items-center gap-2 text-yellow-800 bg-yellow-100 px-2 rounded-full py-0.5"
                        >
                            <Icon icon="lucide:layers" />
                            {{ jobPost.category.name }}
                        </p>
                        <p
                            class="flex items-center gap-2 text-blue-800 bg-blue-100 px-2 rounded-full py-0.5"
                        >
                            <Icon icon="carbon:category" />
                            {{ jobPost.service.name }}
                        </p>
                        <p
                            class="flex items-center gap-2 text-green-800 bg-green-100 px-2 rounded-full py-0.5"
                        >
                            <Icon icon="lucide:map-pin" />
                            {{ jobPost.location.location }}
                        </p>
                        <p
                            class="flex items-center gap-2 text-red-800 bg-red-100 px-2 rounded-full py-0.5"
                        >
                            <Icon icon="lucide:building-2" />
                            {{ capitalize(jobPost.property) }}
                        </p>
                        <p
                            class="flex items-center gap-2 text-purple-800 bg-purple-100 px-2 rounded-full py-0.5"
                        >
                            <Icon icon="lucide:timer" />
                            {{
                                capitalize(
                                    jobPost.urgency === "specificDate"
                                        ? formattedDate
                                        : jobPost.urgency
                                )
                            }}
                        </p>
                    </div>
                </div>

                <div
                    v-if="jobPostStep === 4"
                    class="flex flex-col items-center text-center"
                >
                    <template v-if="isSuccess">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-24 h-24 text-green-500"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm5.707 7.293a1 1 0 00-1.414-1.414L10 14.172l-2.293-2.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l7-7z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </template>

                    <template v-else>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-24 h-24 text-red-500"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm-1 5a1 1 0 012 0v5a1 1 0 01-2 0V7zm1 10a1.5 1.5 0 110-3 1.5 1.5 0 010 3z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </template>

                    <h3 class="text-xl font-bold mt-4">{{ statusMessage }}</h3>
                    <Button
                        label="Close"
                        @click="emitUpdate(false)"
                        class="mt-4"
                    />
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="flex items-center justify-between">
                <!-- Hide Back Button in Step 1 -->
                <Button
                    v-if="jobPostStep > 1"
                    label="Back"
                    size="small"
                    variant="text"
                    icon="fa-solid fa-arrow-left"
                    @click="jobPostStep--"
                />

                <Button
                    v-if="jobPostStep === 3"
                    label="Post"
                    size="small"
                    icon="fa-solid fa-check"
                    iconPos="right"
                    @click="submitJobPost"
                />

                <Button
                    v-if="jobPostStep < 3"
                    label="Next"
                    size="small"
                    variant="text"
                    icon="fa-solid fa-arrow-right"
                    iconPos="right"
                    @click="jobPostStep++"
                    :disabled="!canProceed"
                    :loading="jobPost.processing"
                />
            </div>
        </div>
    </Dialog>
</template>
