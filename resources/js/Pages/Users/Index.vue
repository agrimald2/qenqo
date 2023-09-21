<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>
<template>
    <Head title="Familias" />
    <AuthenticatedLayout>
        <Breadcrumb :breadcrumbs="breadcrumbs" />
        <div class="shadow-md sm:rounded-lg relative">
            <div class="px-2 flex items-center justify-between py-4 bg-white ">
                <div class="flex items-center">
                    <div class="relative w-full">
                        <input type="text" id="simple-search" v-model="search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full pl-10 p-2.5    dark:placeholder-gray-400  dark:focus:ring-purple-500 dark:focus:border-purple-500"
                            placeholder="Nombre | N° Doc" required>
                    </div>
                    <select id="roles" name="roles" v-model="role_id" @change="fetch"
                        class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:placeholder-gray-400  dark:focus:ring-purple-500 dark:focus:border-purple-500">
                        <option :value="0" class="text-gray-900" selected>Todas</option>
                        <option v-for="role in roles" :value="role.id" class="text-gray-900">{{ role.name }}
                        </option>
                    </select>
                </div>
                <button type="button" @click="showModal('createCustomer')"
                    class="text-white bg-purple-800 hover:bg-[#050708]/80 focus:ring-4 focus:outline-none focus:ring-[#050708]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center  dark:focus:ring-gray-600 mr-2 mb-2">
                    <span class="hidden md:flex"> Nuevo </span>
                    <i class="ml-2 fa-solid fa-user-plus font-xl"></i>
                </button>
            </div>
            <div class="overflow-x-auto">
                <table v-if="customers != ''" class="w-full text-sm text-left text-gray-500  table">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Celular
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                ROL
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(user, index) in users" class="bg-white border-b   hover:bg-gray-50 ">
                            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                                <div class="text-base font-semibold"> {{ user.name }} {{ user.lastname }} </div>
                            </th>
                            <td class="px-6 py-4">
                                {{ user.phone }}
                            </td>
                            <td class="px-6 py-4">
                                {{ user.email }}
                            </td>
                            <td class="px-6 py-4 text-gray-800 whitespace-nowrap">
                                {{ user.role.name }}
                            </td>
                            <td class="px-6 py-4">
                                <label class="my-2 relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" :checked="user.is_enabled === 1" class="sr-only peer" disabled>
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600">
                                    </div>
                                </label>
                                <i @click="showModal('editInsuranceCompany' + insurance_company.id)"
                                    class="fa-solid fa-square-pen text-3xl text-yellow-500 cursor-pointer ml-2"></i>
                                <i @click="deleteInsuranceCompany(insurance_company.id)"
                                    class="fa-solid fa-square-xmark text-3xl text-red-500 cursor-pointer ml-2"></i>
                                <i v-if="user.role.id == 2"
                                    @click="showModal('editInsuranceCompany' + insurance_company.id)"
                                    class="fa-solid fa-calendar-days text-3xl text-green-500 cursor-pointer ml-2"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- 
                    <div role="status" class="flex justify-center" v-else>
                        <svg aria-hidden="true"
                            class="w-24 h-24 mr-2 mt-5 text-gray-200 animate-spin dark:text-gray-600 fill-purple-600"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill" />
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                -->
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script>
import Breadcrumb from '@/Components/Flowbite/Navigation/Breadcrumb.vue';
export default {
    components: {
        Breadcrumb,
    },
    props: ['breadcrumbs'],
    data() {
        return {
            param: null,
            users: null,
            searchQuery: null,
            role_id: null,
            roles: null,
        };
    },
    methods: {
        showModal(id) {
            let modal = document.getElementById(id);
            modal.classList.remove('slide-out-bck-center');
            modal.classList.remove('no-display');
        },
        async delete(id) {
            try {
                const response = await axios.delete('/users/' + id);
                this.fetch();
                // handle success (e.g., show notification, redirect)
            } catch (error) {
                console.log(error);
            }
        },
        async fetch() {
            this.users = null;
            try {
                const response = await axios.get('/getUsers', {
                    params: {
                        name: this.param,
                        role_id: this.role_id
                    },
                });
                this.users = response.data;
            } catch (error) {
                console.log(error);
            }
        },
        async getRoles() {
            try {
                const response = await axios.get('/api/getRoles', {});
                this.roles = response.data;
            } catch (error) {
                console.log(error);
            }
        },
    },
    mounted() {
        this.fetch();
        this.getRoles();
    },
    watch: {
        searchQuery: {
            handler() {
                this.fetch();
            },
            immediate: true
        }
    },
};
</script>
