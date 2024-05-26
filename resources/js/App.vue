<template>
    <div class="flex justify-center min-h-screen bg-bgColor pt-100px">
        <div class="flex flex-col gap-100px w-800px">
            <div class="flex flex-col items-baseline">
                <h1 class="text-48px text-center text-veryDarkPurple text-uppercase" v-show="choosenService == ''">Pasirinkite pageidaujamą paslaugą</h1>
                <div class="flex flex-col gap-16px text-veryDarkPurple text-24px">
                    <button type="button" v-show="choosenService != ''" class="flex items-center gap-16px">
                        <p class="flex gap-32px">Paslauga: <span class="underline">{{ choosenService }}</span></p>
                        <img src="/assets/icons/close-rounded.svg" class="h-25px" @click="choosenService = ''; goBack(0)">
                    </button>
                    <button type="button" v-show="domain !== null && step > 0" class="flex items-center gap-16px">
                        <p class="flex gap-32px">Domenas: <span class="underline">{{ domain ? 'Taip' : 'Ne' }}</span></p>
                        <img src="/assets/icons/close-rounded.svg" class="h-25px" @click="goBack(1)">
                    </button>
                    <button type="button" v-show="virtualServerPlan !== null && step > 1" class="flex items-center gap-16px">
                        <p class="flex gap-32px">Virtualus planas: <span class="underline">{{ virtualServerPlan ? virtualServerPlan : 'Nereikalingas' }}</span></p>
                        <img src="/assets/icons/close-rounded.svg" class="h-25px" @click="goBack(2)">
                    </button>
                    <button type="button" v-show="emailSecurity !== null && step > 2" class="flex items-center gap-16px">
                        <p class="flex gap-32px">El. pašto apsauga: <span class="underline">{{ emailSecurity ? 'Taip' : 'Ne' }}</span></p>
                        <img src="/assets/icons/close-rounded.svg" class="h-25px" @click="goBack(3)">
                    </button>
                </div>
            </div>
            <div class="flex gap-32px" v-show="step === 0">
                <button @click="choosenService = 'Nauja paslauga'; step = 1" type="button" class="px-64px py-32px rounded-12px text-28px text-veryDarkPurple bg-purpleButton border-2 border-purpleButton hover:bg-transparent hover:border-veryDarkPurple transition-all">Nauja paslauga</button>
                <button @click="choosenService = 'Padidinti serverio resursus'; step = 5" type="button" class="px-64px py-32px rounded-12px text-28px text-veryDarkPurple bg-purpleButton border-2 border-purpleButton hover:bg-transparent hover:border-veryDarkPurple transition-all">Padidinti serverio resursus</button>
            </div>
            <div class="flex flex-col gap-32px" v-show="step === 1">
                <p class="text-48px text-veryDarkPurple">Ar reikalingas domenas?</p>
                <div class="flex gap-32px">
                    <button @click="domain = true; step = 2" type="button" class="px-64px py-32px rounded-12px text-28px text-veryDarkPurple bg-purpleButton border-2 border-purpleButton hover:bg-transparent hover:border-veryDarkPurple transition-all">Taip</button>
                    <button @click="domain = false; step = 2" type="button" class="px-64px py-32px rounded-12px text-28px text-veryDarkPurple border-2 border-purpleButton hover:bg-transparent hover:border-veryDarkPurple transition-all">Ne</button>
                </div>
                <p v-show="domain === true" class="text-48px text-veryDarkPurple">Domeno vardas</p>
                <input v-show="domain === true" type="text" v-model="domainName" class="px-64px py-32px rounded-12px text-28px text-veryDarkPurple border-2 border-purpleButton" placeholder="Įveskite domeno vardą">
            </div>
            <div class="flex flex-col gap-32px" v-show="step === 2">
                <p class="text-48px text-veryDarkPurple">Virtualaus serverio planas?</p>
                <div class="flex gap-32px" v-show="virtualServerPlan === null">
                    <template v-for="plan in plans">
                        <button @click="virtualServerPlan = plan.id; step = 3" type="button" class="px-64px py-32px rounded-12px text-28px text-veryDarkPurple bg-purpleButton border-2 border-purpleButton hover:bg-transparent hover:border-veryDarkPurple transition-all">{{ plan.title }}</button>
                    </template>
                    <button @click="virtualServerPlan = ''; step = 3" type="button" class="px-64px py-32px rounded-12px text-28px text-veryDarkPurple border-2 border-purpleButton hover:bg-transparent hover:border-veryDarkPurple transition-all">Nereikalingas</button>
                </div>
            </div>
            <div class="flex flex-col gap-32px" v-show="step === 3">
                <p class="text-48px text-veryDarkPurple" v-show="step === 3">El. pašto apsauga?</p>
                <div class="flex gap-32px" v-show="step === 3">
                    <button @click="emailSecurity = true; step = 4" type="button" class="px-64px py-32px rounded-12px text-28px text-veryDarkPurple bg-purpleButton border-2 border-purpleButton hover:bg-transparent hover:border-veryDarkPurple transition-all">Taip</button>
                    <button @click="emailSecurity = false; step = 4" type="button" class="px-64px py-32px rounded-12px text-28px text-veryDarkPurple border-2 border-purpleButton hover:bg-transparent hover:border-veryDarkPurple transition-all">Ne</button>
                </div>
            </div>
            <div class="flex flex-col gap-32px" v-show="choosenService === 'Padidinti serverio resursus'">
                <input type="number" v-model="serverCapacity" @keyup="getServicePrice()" class="px-64px py-32px rounded-12px text-28px text-veryDarkPurple border-2 border-purpleButton" placeholder="Įveskite GB skaičių">
            </div>
            <div class="flex items-end gap-16px text-veryDarkPurple" v-show="step > 0">
                <span>Kaina:</span>
                <p class="text-48px leading-48px font-bold">{{ CountingHelper.formatPrice(finalPrice) }}</p>
            </div>
            <button type="button" v-show="step >= 4 && finalPrice > 0" @click="orderServerService" class="bg-black py-16px rounded-10px text-48px font-bold text-white transition-all hover:bg-transparent hover:text-black border-4 border-black">Užsakyti</button>
        </div>
    </div>
</template>
<script setup lang="ts">

//Imports
import { ref, onMounted, watch } from 'vue';
import axios from 'axios';
import CountingHelper from '@/Functions/CountingHelper';

//Refs
const step = ref(0);
const serverCapacity = ref(0);
const choosenService = ref('');
const plans = ref({});
const domain = ref<number>(null);
const domainName = ref('');
const virtualServerPlan = ref(null);
const emailSecurity = ref<number>(null);
const finalPrice = ref(0);

//Methods 
onMounted(() => {
    getPlans();
});

watch([
        domain,
        virtualServerPlan,
        emailSecurity,
    ], async (newValue, OldValue) => {
        
    getServicePrice();
});

function getPlans()
{
    axios.get('/api/plans'
        )
        .then(response => {
            plans.value = response.data.data;
        })
        .catch(function (error) {
        if (error.response.status === 422) {
            
        }
    });
}

function getServicePrice()
{   
    axios.post('/api/getServerServicePrice', {            
            'serverCapacity': serverCapacity.value,
            'domain': domain.value,
            'domainName': domainName.value,
            'plan': virtualServerPlan.value,
            'emailSecurity': emailSecurity.value            
        } 
    )
    .then(response => {
        finalPrice.value = response.data.data;
    })
    .catch(function (error) {
        if (error.response.status === 422) {
            
        }
    });
}

async function orderServerService()
{
    const response = await axios.post('');
}

function goBack(stepValue: number) 
{
    switch (stepValue) {
    case 0:
        serverCapacity.value = 0,
        domain.value = null,
        domainName.value = '',
        virtualServerPlan.value = null,
        emailSecurity.value = null,
        step.value = 0;
        break;
    case 1:
        domain.value = null,
        domainName.value = '',
        virtualServerPlan.value = null,
        emailSecurity.value = null,
        step.value = 1;
        break;
    case 2:
        virtualServerPlan.value = null,
        emailSecurity.value = null,
        step.value = 2;
        break;
    case 3:
        emailSecurity.value = null 
        step.value = 3;
        break;
    default:
        serverCapacity.value = 0,
        domain.value = null,
        domainName.value = '',
        virtualServerPlan.value = null,
        emailSecurity.value = null,
        step.value = 0;
    }
}

</script>