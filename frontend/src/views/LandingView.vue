<script setup>
import { useRouter } from 'vue-router';

const router = useRouter()
const handleFindARide = () => {
    router.push({
        name: 'location'
    })

}
</script>

<template>
<div class="pt-16">
    <h1 class="text-3xl font-semibold mb-4">Mobiber</h1>
    <div class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left">
        <div class="bg-white px-4 py-5 sm:p-6">
            <div class="flex justify-between">
                <button class="rounded-md border border-transparent bg-black py-2 px-4 text-sm font-medium text-white px-3">
                    Start Driving
                </button>
                <button
                @click="handleFindARide"
                 class="rounded-md border border-transparent bg-black py-2 px-4 text-sm font-medium text-white px-3">
                    Find a Ride
                </button>
            </div>
        </div>
    </div>
</div>

</template>