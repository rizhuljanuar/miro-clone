<script lang="ts" setup>

import {App} from '../../App/APP'


function loginWithGoogle(){
    window.location.href=App.baseUrl+'/auth/redirect'
}
</script>
<template>
    <div class="bg-state-50">

        <div class="flex flex-row justify-between mt-40">

            <div></div>
            <div class=" w-[400px]">
                <button @click="loginWithGoogle" class="flex w-full shadow-md justify-center flex-row px-4 gap-4 py-2 rounded-md bg-slate-200 ">
                    <img :src="App.baseUrl+'/img/google.svg'" width="20" alt="">
                    <span class="text-sm font-medium">Login with Google</span>
                </button>
            </div>
            <div></div>
        </div>
    </div>
</template>
