<template>
    <div class="flex flex-col border p-2 rounded-md shadow bg-white my-2">
        <!-- Header Section -->
        <div class="flex items-center gap-2 mb-2">
            <Avatar label="P" size="large" shape="circle" />
            <div>
                <h1 class="text-lg font-semibold text-gray-900">
                    Title of the Job Posting
                </h1>
                <span class="text-sm text-gray-500">Posted 2 days ago</span>
            </div>
        </div>

        <!-- Content Section -->
        <div class="flex flex-col gap-1 mt-2">
            <table class="min-w-full mt-2 rounded">
                <tbody>
                    <tr class="bg-white">
                        <td class="px-4 py-1.5 font-medium text-primary-800">
                            Service:
                        </td>
                        <td class="px-4 py-1.5">Bathroom floor tiling</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <td class="px-4 py-1.5 font-medium text-primary-800">
                            Urgency:
                        </td>
                        <td class="px-4 py-1.5">14/03/2025</td>
                    </tr>
                    <tr class="bg-white">
                        <td class="px-4 py-1.5 font-medium text-primary-800">
                            Property:
                        </td>
                        <td class="px-4 py-1.5">Residential</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <td class="px-4 py-1.5 font-medium text-primary-800">
                            Location:
                        </td>
                        <td class="px-4 py-1.5">40 Broadway London EC03 7WN</td>
                    </tr>
                </tbody>
            </table>
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

        <div class="flex justify-end mt-2">
            <Button
                label="Cancel Job"
                class="w-fit"
                size="small"
                severity="danger"
            />
        </div>
    </div>
</template>
