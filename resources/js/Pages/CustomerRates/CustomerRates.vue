<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>
<template>
    <Head title="Clientes" />
    <AuthenticatedLayout>
        <Breadcrumb :breadcrumbs="breadcrumbs" />
        <div class="shadow-md sm:rounded-lg relative">
            <div class="px-2 flex items-center justify-between py-4 bg-white ">
                <div class="flex items-center">
                    <div class="relative w-full">
                        <input type="text" id="simple-search" v-model="searchQuery" @input="fetch"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full pl-10 p-2.5    dark:placeholder-gray-400  dark:focus:ring-purple-500 dark:focus:border-purple-500"
                            placeholder="Nombre | N° Doc" required>
                    </div>
                </div>
                <button type="button" @click="showModal('createCustomer')"
                    class="text-white bg-purple-800 hover:bg-[#050708]/80 focus:ring-4 focus:outline-none focus:ring-[#050708]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center  dark:focus:ring-gray-600 mr-2 mb-2">
                    <span class="hidden md:flex"> Nuevo </span>
                    <i class="ml-2 fa-solid fa-user-plus font-xl"></i>
                </button>
            </div>
            <div class="overflow-x-auto">
                <table v-if="customer_rates" class="w-full text-sm text-left text-gray-500  table">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Tarifa
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Sesiones
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ev. Nutricional
                            </th>
                            <th scope="col" class="px-6 py-3">
                                F. Inicio
                            </th>
                            <th scope="col" class="px-6 py-3">
                                F. Final
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(rate, index) in customer_rates" class="bg-white border-b   hover:bg-gray-50 ">
                            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                                <a :href="'/customers/rates/' + rate.id">
                                    <div class="text-base font-semibold">
                                        {{ rate.rate_name }}
                                        <br>
                                        S/{{ rate.rate_total_price }}
                                    </div>
                                </a>
                            </th>
                            <td class="px-6 py-4">
                                T - {{ rate.rate_total_sessions }} <br>
                                C - {{ (rate.rate_total_sessions * rate.total_consumed) / rate.rate_total_price }} <br>
                                P - {{ (rate.rate_total_sessions * rate.total_payed) / rate.rate_total_price }}
                            </td>
                            <td v-if="rate.nutritional_assessment_total > 0" class="px-6 py-4">
                                P - {{ rate.nutritional_assessment_total }}
                                <br>
                                C - {{ rate.nutritional_assessment_consumed }}
                            </td>
                            <td v-else class="px-6 py-4">
                                NO Incluye
                            </td>
                            <td class="px-6 py-4">
                                {{ rate.start_day }}
                            </td>
                            <td class="px-6 py-4">
                                {{ rate.end_day }}
                            </td>
                            <td class="px-6 py-4">
                                {{ rate.status.name }}
                            </td>
                            <td class="px-6 py-4">
                                <i class="fa-brands fa-cc-apple-pay text-3xl text-yellow-500 cursor-pointer ml-2"
                                    @click="showModal('PayCustomerRate' + rate.id)"></i>
                                <i class="fa-solid fa-face-frown text-3xl text-red-500 cursor-pointer ml-2"></i>
                                <i @click="deleteInsuranceCompany(insurance_company.id)"
                                    class="fa-solid fa-square-xmark text-3xl text-red-800 cursor-pointer ml-2"></i>
                            </td>
                            <PayCustomerRate :id="'PayCustomerRate' + rate.id" :rate="rate" />
                        </tr>
                    </tbody>
                </table>
                <div role="status" class="flex justify-center p-10" v-else>
                    <Loader />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script>
import Breadcrumb from '@/Components/Flowbite/Navigation/Breadcrumb.vue';
import Loader from '@/Components/Loader.vue';
import PayCustomerRate from './PayCustomerRate.vue'
export default {
    components: {
        Breadcrumb,
        Loader
    },
    props: ['breadcrumbs', 'customer_rates'],
    data() {
        return {
            param: null,
            customers: null,
            searchQuery: null,
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
                const response = await axios.delete('/customers/' + id);
                this.fetch();
                // handle success (e.g., show notification, redirect)
            } catch (error) {
                console.log(error);
            }
        },
        async fetch() {
            this.customers = null;
            try {
                const response = await axios.get('/getCustomers', {
                    params: {
                        query: this.searchQuery,
                    },
                });
                this.customers = response.data;
            } catch (error) {
                console.log(error);
            }
        },
    },
    mounted() {
        this.fetch();
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

