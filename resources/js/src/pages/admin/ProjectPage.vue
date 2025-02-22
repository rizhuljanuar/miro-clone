<script lang="ts" setup>
import {App} from '../../App/APP';

// icons
import PlusIcon from '../../components/icons/PlusIcon.vue';
import LogoutIcon from '../../components/icons/LogoutIcon.vue';
import QueueListIcon from '../../components/icons/QueueListIcon.vue';

</script>

<template>
    <div class="bg-slate-100">
        <!-- <ProjectModal
            @closeModal="closeModal"
            @get-projects="getProjects"
            :showModal="showModal"
        /> -->

        <div class="flex">
            <div class="bg-white h-screen w-[250px]">
                <div class="flex justify-center py-4">
                    <img
                        :src="App.baseUrl+'/img/logo.png'"
                        width="50"
                        alt="logo"
                    />
                    <!-- <UserMenu
                        :showMenu="showMenu"
                        @logout="logout(user?.user?.userId)"
                        :user="user"
                    /> -->
                </div>
                <div>
                    <ul class="flex flex-col px-2 gap-2">
                        <li
                            class="flex flex-row py-2 px-2 bg-slate-200 rounded-md gap-2 cursor-pointer"
                        >
                            <span class="icon pt-1">
                                <QueueListIcon />
                            </span>
                            <span>Projects</span>
                        </li>
                        <li

                            class="flex flex-row py-2 px-2 text-red-500 hover:bg-gray-200 rounded-md gap-2 cursor-pointer"
                        >
                            <span class="icon pt-1">
                                <LogoutIcon />
                            </span>
                            <span>Logout</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="bg-slate-200 w-screen">
                <div class="flex justify-end px-4 py-2">
                    <img
                        :src="App.baseUrl+'/img/avatar.webp'"
                        width="30"
                        class="rounded-full border-2 border-white cursor-pointer hover:border-blue-500"
                        alt=""
                    />
                </div>

                <div class="flex px-4">
                    <h1 class="text-2xl">Projects</h1>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 p-4">
                    <!-- list of ceated projects  -->

                    <div

                        class="flex justify-center bg-white items-center min-h-60 shadow-md p-4 rounded-md cursor-pointer hover:bg-slate-100"
                    >
                        <div class="px-6 text-indigo-700">
                            <div class="flex justify-center">
                                <PlusIcon />
                            </div>
                            <div class="flex justify-center d">
                                <span>New Project</span>
                            </div>
                        </div>
                    </div>

                    <!-- <ProjectList
                        :projects="serverData?.data"
                        @update-project="updateProject"
                    /> -->
                </div>

                <div>
                    <!-- <TailwindPagination
                        class="_pagination px-4"
                        :data="serverData"
                        @pagination-change-page="getProjects"
                    /> -->
                </div>
            </div>
        </div>
    </div>
</template>
