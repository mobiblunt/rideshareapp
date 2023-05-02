<script setup>
</script>
<template>

<div class="pt-16">
    <h1 class="text-3xl font-semibold mb-4">Where are you going to?</h1>
    <form action="#" >
        <div class="overflow-hidden shadow sm-rounded-md max-w-sm mx-auto text-left">
            <div class="bg-white px-4 py-5 sm:p-6">
                <div>
                <GMapAutocomplete
                @place_changed="setPlace"
                 type="text" placeholder="Enter a destination" class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm">

                </GMapAutocomplete>
            </div>
            </div>
           <div class="bg-gray-50 px-4 py-3 text-right sm:p-6">
            <button type="button" class="inline-flex justify-center rounded-md border border-transparent bg-black py-2 text-white px-3">Find A Ride</button>
           </div> 
            
        </div>

    </form>
</div>



</template>