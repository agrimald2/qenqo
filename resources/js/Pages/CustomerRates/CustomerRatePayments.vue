<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>
<template>
    <Head title="Clientes" />
    <AuthenticatedLayout>
        <Breadcrumb :breadcrumbs="breadcrumbs" />
        <div class="shadow-md sm:rounded-lg relative">
            <div class="overflow-x-auto">
                <table v-if="customer_rate" class="w-full text-sm text-left text-gray-500  table">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Fecha
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Monto Pagado
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Método de Pago
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Usuario
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <tr v-for="(payment, index) in customer_rate.customer_payments" class="bg-white border-b   hover:bg-gray-50 ">
                            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                                <div class="text-base font-semibold">
                                    {{ new Date(payment.created_at).toLocaleString() }}
                                </div>
                            </th>
                            <td class="px-6 py-4">
                                S/{{ payment.total_payed }}
                            </td>
                            <td class="px-6 py-4">
                                <span v-if="payment.payment_status_id == 1" class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300"> {{ payment.payment_status.name }}</span>
                                <span v-else class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300"> {{ payment.payment_status.name }}</span>
                            </td>
                            <td class="px-6 py-4">
                                {{ payment.payment_method }}
                            </td>
                            <td class="px-6 py-4">
                                {{ payment.added_by }}
                            </td>
                            <td class="px-6 py-4">
                                <i @click="deletePayment(payment.id)"
                                    class="fa-solid fa-square-xmark text-3xl text-red-800 cursor-pointer ml-2"></i>
                            </td>
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
    props: ['breadcrumbs', 'customer_rate'],
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
        async deletePayment(id) {
            try {
                const response = await axios.post('/customers/rates/payment/' + id);
                if (response.data.message === 'Payment deleted successfully.') {
                    location.reload();
                }
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

