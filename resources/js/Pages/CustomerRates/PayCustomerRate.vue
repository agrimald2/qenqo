<template>
    <div :id="id" tabindex="-1"
        class="no-display slide-in-fwd-center fixed inset-0 flex items-center justify-center z-50 w-full p-2 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full">
        <div class="relative max-w-xl max-h-full m-auto" style="min-width: 30%;">
            <div class="relative bg-white rounded-lg shadow ">
                <button type="button" @click="hideModal"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center  ">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 ">Pagar {{ rate.rate_name }}</h3>
                    <h6 class="mb-4 text-md font-medium text-gray-900 ">
                        Costo x Sesión S/{{ rate.rate_total_price / rate.rate_total_sessions }} <br>
                        Pagado: {{ (rate.rate_total_sessions * rate.total_payed) / rate.rate_total_price }} |
                        Total: {{ rate.rate_total_sessions }}
                    </h6>
                    <div class="space-y-3">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                                Número de Sesiones
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                    <i class="fa-solid fa-hashtag"></i>
                                </div>
                                <input type="text" name="name" id="name" v-model="form.sessions"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full pl-10 p-2.5    dark:placeholder-gray-400  dark:focus:ring-purple-500 dark:focus:border-purple-500"
                                    placeholder="1">
                            </div>
                        </div>
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">
                                Monto a Pagar
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                    <i class="fa-solid fa-money-bill"></i>
                                </div>
                                <input type="text" name="name" id="name" v-model="form.total_payed" disabled
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full pl-10 p-2.5    dark:placeholder-gray-400  dark:focus:ring-purple-500 dark:focus:border-purple-500"
                                    placeholder="50">
                            </div>
                        </div>
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">
                                Método de Pago
                            </label>
                            <div class="relative">
                                <select id="payment_method" name="payment_method_id" v-model="form.payment_method"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5   dark:placeholder-gray-400  dark:focus:ring-purple-500 dark:focus:border-purple-500">
                                    <option v-for="payment_method in payment_methods" :value="payment_method.name"
                                        class="text-gray-900">
                                        {{ payment_method.name }}</option>
                                </select>
                            </div>
                        </div>
                        <button type="button" @click="submit" :disabled="!this.form.total_payed > 0"
                            class="w-full text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center    uppercase">
                            PAGAR S/.{{ this.form.total_payed }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    components: {},
    props: ['id', 'rate'],
    data() {
        return {
            payment_methods: [],
            form: {
                customer_rate_id: this.rate.id,
                payment_method: null,
                total_payed: null,
                sessions: null,
            }
        };
    },
    methods: {
        async submit() {
            try {
                const response = await axios.post('/addPaymentToCustomerRate', {
                    customer_rate_id: this.form.customer_rate_id,
                    total_payed: this.form.total_payed,
                    payment_method: this.form.payment_method
                });
                window.location.reload();
            } catch (error) {
                console.log(error);
            }
        },
        async fetchPaymentMethods() {
            try {
                const response = await axios.get('/api/getPaymentMethods', {});
                this.payment_methods = response.data;
            } catch (error) {
                console.log(error);
            }
        },
        hideModal() {
            let element = document.getElementById(this.id);
            element.classList.add('slide-out-bck-center');
            setTimeout(() => {
                element.classList.add('no-display');
            }, 500);
        }
    },
    mounted() {
        this.fetchPaymentMethods();
    },
    computed: {
        computedTotalPayed() {
            return this.form.sessions * (this.rate.rate_total_price / this.rate.rate_total_sessions);
        },
        remainingSessions() {
            let totalSessions =  this.rate.rate_total_sessions;
            let unitPrice = this.rate.rate_total_price / this.rate.rate_total_sessions;
            let totalPayed = this.rate.total_payed;
            return totalSessions - (totalPayed / unitPrice);
        }
    },
    watch: {
        'form.sessions': function (newVal, oldVal) {
            if(this.form.sessions > this.remainingSessions){
                this.form.sessions = this.remainingSessions
            }
            this.form.total_payed = this.computedTotalPayed;
        }
    }
};
</script>