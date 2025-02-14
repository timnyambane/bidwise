<script setup>
import { ref, watch, computed, defineEmits } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import DatePicker from "primevue/datepicker";

const { work_categories, locations } = usePage().props;

// Set up the form with useForm
const jobPost = useForm({
    selectedCategory: null,
    selectedService: null,
    selectedLocation: null,
    title: null,
    desc: null,
    urgency: null,
    specificDate: null,
});

const minDate = ref(new Date());
let today = new Date();
let month = today.getMonth();
let year = today.getFullYear();
let prevMonth = month === 0 ? 11 : month - 1;
let prevYear = prevMonth === 11 ? year - 1 : year;
minDate.value.setMonth(prevMonth);
minDate.value.setFullYear(prevYear);

const filteredServices = ref([]);
const step = ref(1);

// Emit event to parent component
const emit = defineEmits();

const updateServices = () => {
    const selected = work_categories.find(
        (category) => category.id === jobPost.selectedCategory
    );
    filteredServices.value = selected?.services || [];
};

watch(() => jobPost.selectedCategory, updateServices);

// Step navigation functions
const nextStep = () => {
    if (step.value < 3) step.value++;
};

const prevStep = () => {
    if (step.value > 1) step.value--;
};

// Step validation
const isNextDisabled = computed(() => {
    if (step.value === 1) {
        return (
            !jobPost.selectedCategory ||
            !jobPost.selectedService ||
            !jobPost.selectedLocation
        );
    }
    if (step.value === 2) {
        if (!jobPost.title || !jobPost.desc || !jobPost.urgency) {
            return true;
        }
        if (jobPost.urgency === "specificDate" && !jobPost.specificDate) {
            return true;
        }
    }
    return false;
});

// Computed property to get the selected category name
const selectedCategoryName = computed(() => {
    return (
        work_categories.find((cat) => cat.id === jobPost.selectedCategory)
            ?.name || ""
    );
});

// Computed property to get the selected service name
const selectedServiceName = computed(() => {
    return (
        filteredServices.value.find((srv) => srv.id === jobPost.selectedService)
            ?.name || ""
    );
});

const selectedLocationName = computed(() => {
    return (
        locations.find((loc) => loc.id === jobPost.selectedLocation)?.location || ""
    );
});

// Post the job when ready
const postJob = async () => {
    await jobPost.post(route("job-posts.store"), {
        onSuccess: () => {
            emit("jobPosted");
        },
    });
};
</script>

<template>
    <div class="flex flex-col gap-6 items-center w-full mx-auto text-gray-700">
        <!-- Step 1 -->
        <div v-if="step === 1" class="flex flex-col gap-6 w-[95%]">
            <Select
                v-model="jobPost.selectedCategory"
                :options="work_categories"
                optionLabel="name"
                optionValue="id"
                placeholder="Select a work category"
                class="w-full"
            />
            <Select
                v-model="jobPost.selectedService"
                :options="filteredServices"
                optionLabel="name"
                optionValue="id"
                placeholder="Select a service"
                class="w-full"
            />
            <Select
                v-model="jobPost.selectedLocation"
                :options="locations"
                optionLabel="location"
                optionValue="id"
                placeholder="Select your location"
                class="w-full"
            />
        </div>

        <!-- Step 2 -->
        <div v-if="step === 2" class="flex flex-col gap-6 w-[95%]">
            <InputText
                type="text"
                v-model="jobPost.title"
                placeholder="Job title"
            />
            <Textarea
                v-model="jobPost.desc"
                rows="5"
                cols="30"
                placeholder="Description"
            />

            <!-- Urgency Selection -->
            <fieldset class="flex flex-col gap-2.5 p-2">
                <legend class="font-medium text-gray-700">Urgency</legend>
                <div class="flex items-center">
                    <RadioButton
                        v-model="jobPost.urgency"
                        inputId="immediately"
                        value="immediately"
                        name="urgency"
                    />
                    <label for="immediately" class="ml-2">Immediately</label>
                </div>
                <div class="flex items-center">
                    <RadioButton
                        v-model="jobPost.urgency"
                        inputId="flexible"
                        value="flexible"
                        name="urgency"
                    />
                    <label for="flexible" class="ml-2">Flexible</label>
                </div>
                <div class="flex items-center">
                    <RadioButton
                        v-model="jobPost.urgency"
                        inputId="specificDate"
                        value="specificDate"
                        name="urgency"
                    />
                    <label for="specificDate" class="mx-2">Specific date</label>
                </div>
                <DatePicker
                    v-if="jobPost.urgency === 'specificDate'"
                    v-model="jobPost.specificDate"
                    placeholder="Pick a date"
                    class="w-fit"
                    :minDate="minDate"
                    showButtonBar
                />
            </fieldset>
        </div>

        <!-- Step 3 (Summary) -->
        <div v-if="step === 3" class="flex flex-col gap-6 w-[95%]">
            <div class="flex flex-col gap-2">
                <p>
                    <strong>Work Category:</strong> {{ selectedCategoryName }}
                </p>
                <p><strong>Service:</strong> {{ selectedServiceName }}</p>
                <p><strong>Location:</strong> {{ selectedLocationName }}</p>
                <p><strong>Job Title:</strong> {{ jobPost.title }}</p>
                <p>
                    <strong>Urgency:</strong>
                    {{
                        jobPost.urgency === "specificDate"
                            ? new Date(jobPost.specificDate).toLocaleDateString(
                                  "en-GB",
                                  {
                                      month: "short",
                                      year: "numeric",
                                      day: "numeric",
                                  }
                              )
                            : jobPost.urgency
                    }}
                </p>
                <p>
                    <strong>Description:</strong><br />
                    {{ jobPost.desc }}
                </p>
            </div>
        </div>

        <!-- Step Navigation -->
        <div class="flex justify-between w-full">
            <Button
                text
                icon="fa-solid fa-arrow-left"
                size="small"
                @click="prevStep"
                :disabled="step === 1"
            />
            <Button
                v-if="step === 3"
                label="Post job"
                @click="postJob"
                :disabled="isNextDisabled"
            />
            <Button
                v-if="step < 3"
                text
                icon="fa-solid fa-arrow-right"
                size="small"
                @click="nextStep"
                :disabled="isNextDisabled"
            />
        </div>
    </div>
</template>
