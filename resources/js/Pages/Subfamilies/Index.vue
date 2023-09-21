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
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 18 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
                            </svg>
                        </div>
                        <input type="text" id="simple-search" v-model="searchQuery" @input="fetch"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full pl-10 p-2.5 dark:placeholder-gray-400  dark:focus:ring-purple-500 dark:focus:border-purple-500"
                            placeholder="Nombre" required>
                    </div>
                    <select id="families" name="families" v-model="family_id" @change="fetch"
                        class="ml-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:placeholder-gray-400  dark:focus:ring-purple-500 dark:focus:border-purple-500">
                        <option :value="0" class="text-gray-900" selected>Todas</option>
                        <option v-for="family in families" :value="family.id" class="text-gray-900">{{ family.name }}
                        </option>
                    </select>
                </div>
                <button type="button" @click="showModal('createFamily')"
                    class="text-white bg-purple-800 hover:bg-[#050708]/80 focus:ring-4 focus:outline-none focus:ring-[#050708]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center  dark:focus:ring-gray-600 mr-2 mb-2">
                    <span class="hidden md:flex"> Nuevo {{ family_id }}
                    </span>
                    <i class="ml-2 fa-solid fa-user-plus font-xl"></i>
                </button>
            </div>
            <div class="overflow-x-auto">
                <table v-if="subfamilies" class="w-full text-sm text-left text-gray-500  table">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Familia
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3">
                                ¿Habilitada?
                            </th>
                            <th scope="col" class="px-6 py-3">
                                ¿Permiso de Admin?
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(subfamily, index) in subfamilies" class="bg-white border-b   hover:bg-gray-50 ">
                            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap ">
                                <div class="pl-3">
                                    <div class="text-base font-semibold"> {{ subfamily.family.name }} </div>
                                </div>
                            </th>
                            <td class="px-6 py-4">
                                {{ subfamily.name }}
                            </td>
                            <td class="px-6 py-4">
                                <span v-if="subfamily.is_enabled"
                                    class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">SÍ</span>
                                <span v-else
                                    class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">NO</span>
                            </td>
                            <td class="px-6 py-4">
                                <span v-if="subfamily.required_admin_permission"
                                    class="bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">SÍ</span>
                                <span v-else
                                    class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">NO</span>
                            </td>
                            <td class="px-6 py-4">
                                <i @click="showModal('editSubFamily' + subfamily.id)"
                                    class="fa-solid fa-square-pen text-3xl text-yellow-500 cursor-pointer ml-2"></i>
                                <Edit :id="'editSubFamily' + subfamily.id" :subfamily="subfamily" />
                                <i @click="deleteFamily(subfamily.id)"
                                    class="fa-solid fa-square-xmark text-3xl text-red-500 cursor-pointer ml-2"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div role="status" class="flex justify-center p-10" v-else>
                    <Loader />
                </div>
            </div>
            <Create :id="'createFamily'" />
        </div>
    </AuthenticatedLayout>
</template>
<script>
import Breadcrumb from '@/Components/Flowbite/Navigation/Breadcrumb.vue';
import Loader from '@/Components/Loader.vue';
import Edit from './Edit.vue';
import Create from './Create.vue';
export default {
    components: {
        Breadcrumb,
        Loader,
        Edit
    },
    props: ['breadcrumbs'],
    data() {
        return {
            subfamilies: null,
            searchQuery: null,
            family_id: null,
            families: null,
        };
    },
    methods: {
        showModal(id) {
            let modal = document.getElementById(id);
            console.log(id);
            modal.classList.remove('slide-out-bck-center');
            modal.classList.remove('no-display');
        },
        async deleteFamily(id) {
            try {
                const response = await axios.delete('/subfamilies/' + id);
                this.fetch();
                // handle success (e.g., show notification, redirect)
            } catch (error) {
                console.log(error);
            }
        },
        async fetch() {
            this.subfamilies = null;
            try {
                const response = await axios.get('/getSubFamilies', {
                    params: {
                        name: this.searchQuery,
                        family_id: this.family_id,
                    },
                });
                this.subfamilies = response.data;
            } catch (error) {
                console.log(error);
            }
        },
        async getFamilies() {
            this.families = null;
            try {
                const response = await axios.get('/getFamilies', {
                    params: {

                    },
                });
                this.families = response.data;
            } catch (error) {
                console.log(error);
            }
        },
    },
    mounted() {
        this.fetch();
        this.getFamilies();
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
