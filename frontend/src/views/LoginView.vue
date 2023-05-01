<script setup>
import {vMaska} from 'maska'
import { computed, reactive, ref, onMounted } from 'vue';
import axios from 'axios'
import { useRouter } from 'vue-router';

const router = useRouter()

const data = reactive({
    phone: null
})

const waitingOnVerification = ref(false)
const regex = /[^\d]/g;

onMounted(() => {
    if(localStorage.getItem('token')) {
        router.push({
            name: 'landing'
        })
    }
})

const getFormattedCred = () => {
    
    return {
        phone: data.phone.replace(regex, ''),
        login_code: data.login_code
    }
}


const handleLogin = () => {
    const regex = /[^\d]/g;
    axios.post('http://localhost:8000/api/login', {
        phone: data.phone.replace(regex, '')
    })
        .then((response) => {
            console.log(response.data)
            waitingOnVerification.value = true
        })
        .catch((error) => {
            console.error(error)
            alert(error.response.data.message)
        })
}

const handleVerification = () => {

    const regex = /\D/g;
    axios.post('http://localhost:8000/api/login/verify', {
        phone: data.phone.replace(regex, ''),
        login_code: data.login_code
    })
        .then((response) => {
            console.log(response.data)
            localStorage.setItem('token', response.data)
            router.push({
                name: 'landing'
            })
        })
        .catch((error) => {
            console.error(error)
            alert(error.response.data.message)
        })

}
</script>


<template>
    <div class="pt-16">
        <h1 class="text-3xl font-semi-bold mb-4">Enter your phone number</h1>
        <form v-if="!waitingOnVerification" action="#" @submit.prevent="handleLogin">
            <div class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left">
                <div class="bg-white px-4 py-5 sm:p-6">
                    <div>
                        <input type="text" v-model="data.phone" v-maska data-maska="### (###) ###-####" name="phone" id="phone" class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm">
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                    <button type="submit" @submit.prevent="handleLogin" class="inline-flex justify-center rounded-md border border-transparent bg-black py-2 text-white px-3">Continue</button>
                </div>
            </div>


        </form>


        <form v-else action="#" @submit.prevent="handleVerification">
            <div class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left">
                <div class="bg-white px-4 py-5 sm:p-6">
                    <div>
                        <input type="text" v-model="data.login_code" v-maska data-maska="######" name="login_code" id="login_code" class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm">
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                    <button type="submit" @submit.prevent="handleVerification" class="inline-flex justify-center rounded-md border border-transparent bg-black py-2 text-white px-3">Verify</button>
                </div>
            </div>


        </form>
    </div>
</template>

