<script setup>
import { useForm } from "@inertiajs/vue3";
import { defineProps, defineEmits, ref, computed, capitalize } from "vue";

defineProps({
    modelValue: Boolean,
});

const emit = defineEmits(["update:modelValue"]);

const emitUpdate = (value) => {
    emit("update:modelValue", value);
};

const formattedDate = computed(() => {
    if (!jobPost.date) return "Not specified";
    return new Intl.DateTimeFormat("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
    }).format(new Date(jobPost.date));
});

const jobPost = useForm({
    title: null,
    desc: null,
    location: null,
    category: null,
    service: null,
    urgency: null,
    property: null,
    type: null,
    date: null,
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
    } else if (jobPostStep.value === 2) {
        return jobPost.title && jobPost.desc;
    }
    return true;
});

const submitJobPost = () => {
    console.log(jobPost);
};
</script>

<template>
    <Dialog
        :visible="modelValue"
        modal
        header="Post a Job"
        @update:visible="emitUpdate(false)"
    >
        <div class="flex flex-col p-2 gap-4 w-sm lg:w-md">
            <div>
                <!-- Step 1 -->
                <div v-if="jobPostStep === 1" class="flex flex-col gap-4">
                    <Select
                        v-model="jobPost.category"
                        placeholder="Select the category"
                        fluid
                    >
                        <template #dropdownicon>
                            <Icon icon="lucide:layers" />
                        </template>
                    </Select>
                    <Select
                        v-model="jobPost.service"
                        placeholder="Select the service"
                        fluid
                    >
                        <template #dropdownicon>
                            <Icon icon="carbon:category" />
                        </template>
                    </Select>
                    <Select
                        v-model="jobPost.location"
                        placeholder="Select your location"
                        fluid
                    >
                        <template #dropdownicon>
                            <Icon icon="lucide:map-pin" />
                        </template>
                    </Select>

                    <div class="flex flex-col flex-wrap mt-2">
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
                    </div>
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
                            v-model="jobPost.type"
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
                <div v-if="jobPostStep === 3" class="flex flex-col gap-4">
                    <div class="flex justify-center gap-1 items-center">
                        <h3 class="text-lg font-semibold">
                            Review Your Job Post
                        </h3>
                        <Icon
                            v-if="jobPost.type"
                            icon="material-symbols-light:verified-rounded"
                            class="text-yellow-500 text-lg"
                            aria-label="Verified"
                        />
                    </div>
                    <p class="flex flex-col">
                        <strong>Title:</strong>
                        {{ jobPost.title }}
                    </p>

                    <p class="flex flex-col">
                        <strong>Description:</strong> {{ jobPost.desc }}
                    </p>
                    <p class="flex gap-2 items-center">
                        <Icon icon="lucide:layers" />
                        {{ jobPost.category }}
                    </p>
                    <p class="flex gap-2 items-center">
                        <Icon icon="carbon:category" />{{ jobPost.service }}
                    </p>
                    <p class="flex gap-2 items-center">
                        <Icon icon="lucide:map-pin" /> {{ jobPost.location }}
                    </p>
                    <p class="flex gap-2 items-center">
                        <Icon icon="lucide:building-2" />
                        {{ capitalize(jobPost.property) }}
                    </p>
                    <p class="flex gap-2 items-center">
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
                />
            </div>
        </div>
    </Dialog>
</template>
