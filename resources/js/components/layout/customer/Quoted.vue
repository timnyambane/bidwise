<template>
    <div class="flex flex-col border p-2 rounded-md shadow-md bg-white my-2">
        <!-- Header Section -->
        <div class="flex items-center gap-2 mb-2">
            <Avatar label="P" size="large" shape="circle" />
            <div>
                <h1 class="text-lg font-medium text-gray-900">
                    Title of the Job Posting
                </h1>
                <span class="text-sm text-gray-500">Posted 2 days ago</span>
            </div>
        </div>

        <!-- Content Section -->
        <div class="flex flex-col gap-1 mt-2">
            <div class="flex gap-x-2 text-gray-700 px-2">
                <span class="font-medium">Location:</span>
                <span>40 Broadway London EC03 7WN</span>
            </div>
            <div class="flex gap-x-2 text-gray-700 bg-white px-2">
                <span class="font-medium">Urgency:</span>
                <span>14/03/2025</span>
            </div>
            <div class="text-gray-700 bg-gray-50 py-2 px-2 rounded-md">
                <span class="block font-medium mb-1"> Description: </span>
                <p class="text-sm leading-5 text-gray-700">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Pariatur id nemo quos quis molestias expedita dolorum
                    facilis. Iste molestias dolorem hic at, nam inventore
                    tenetur error, quasi architecto laboriosam veritatis?
                </p>
            </div>
        </div>
    </div>
</template>
