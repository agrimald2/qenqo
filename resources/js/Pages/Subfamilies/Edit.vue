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
                    <h3 class="mb-4 text-xl font-medium text-gray-900 ">Editar</h3>
                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">
                                Nombre
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                    <i class="fa-solid fa-signature"></i>
                                </div>
                                <input type="text" name="name" id="name" v-model="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full pl-10 p-2.5    dark:placeholder-gray-400  dark:focus:ring-purple-500 dark:focus:border-purple-500"
                                    placeholder="John Doe">
                            </div>
                        </div>
                        <div class="flex justify-between gap-4">
                            <div>
                                <label for="document_number" class="block mb-2 text-sm font-medium text-gray-900 ">
                                    ¿Habilitada?
                                </label>
                                <div class="relative text-center">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" v-model="isEnabled" class="sr-only peer">
                                        <div
                                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600">
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div>
                                <label for="document_number" class="block mb-2 text-sm font-medium text-gray-900 ">
                                    ¿Requiere Permisos de Admin?
                                </label>
                                <div class="relative text-center">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" v-model="requiredAdminPermission" class="sr-only peer">
                                        <div
                                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600">
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button type="button" @click="submit"
                            class="w-full text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center    uppercase">
                            Editar
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
    props: ['id', 'subfamily'],
    data() {
        return {
            subfamily: this.subfamily,
            name: this.subfamily.name,
            data: null
        };
    },
    methods: {
        async submit() {
            try {
                this.subfamily.is_enabled = this.isEnabled;
                this.subfamily.required_admin_permission = this.requiredAdminPermission;
                this.subfamily.name = this.name;
                const response = await axios.put('/subfamilies/' + this.subfamily.id, this.subfamily);
                window.location.reload();
            } catch (error) {
                console.log(error);
                // handle error (e.g., show error message)
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
    mounted() { },
    computed: {
        isEnabled: {
            set(value) {
                this.subfamily.is_enabled = value ? 1 : 0;
            },
            get() {
                return this.subfamily.is_enabled === 1;
            }
        },
        requiredAdminPermission: {
            set(value) {
                this.subfamily.required_admin_permission = value ? 1 : 0;
            },
            get() {
                return this.subfamily.required_admin_permission === 1;
            }
        }
    }
};
</script>