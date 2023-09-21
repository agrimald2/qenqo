<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>
<template>
    <Head title="Familias" />
    <AuthenticatedLayout>
        <Breadcrumb :breadcrumbs="breadcrumbs" />
        <div class="shadow-md sm:rounded-lg relative grid grid-cols-2">
            <div class="p-4 flex items-center justify-between bg-white col-span-2 ">
                Horarios del entrenador - {{ user.name }} {{ user.lastname }}
            </div>
            <div class="overflow-x-auto p-4 col-span-2">
                <div class="grid grid-cols-4 gap-6">
                    <label class="block col-span-2 md:col-span-1">
                        <span class="text-gray-700">Modalidad</span>
                        <select
                            class="mt-1 block w-full rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm border-gray-300"
                            v-model="newSchedule.modality_id">
                            <option v-for="modality in modalities" :value="modality.id">{{ modality.name }}</option>
                        </select>
                    </label>
                    <label class="block col-span-2 md:col-span-1">
                        <span class="text-gray-700">Día de la semana</span>
                        <select
                            class="mt-1 block w-full rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm border-gray-300"
                            v-model="newSchedule.week_day">
                            <option v-for="(day, index) in days_of_the_week" :value="index + 1">{{ day.name }}</option>
                        </select>
                    </label>
                    <label class="block col-span-4 md:col-span-1 text-center">
                        <span class="text-gray-700">Hora de Inicio</span> <br>
                        <div class="inline-flex text-lg border rounded-md shadow-lg p-2">
                            <select name="" id="" class="px-2 outline-none appearance-none bg-transparent rounded" v-model="newSchedule.start_hour">
                                <option value="00">00</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                            </select>
                            <span class="px-2">:</span>
                            <select name="" id="" class="px-2 outline-none appearance-none bg-transparent rounded" v-model="newSchedule.start_minute">
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="15">30</option>
                            </select>
                        </div>
                    </label>
                    <label class="block col-span-4 md:col-span-1 text-center">
                        <span class="text-gray-700">Hora de Final</span> <br>
                        <div class="inline-flex text-lg border rounded-md shadow-lg p-2">
                            <select name="" id="" class="px-2 outline-none appearance-none bg-transparent rounded" v-model="newSchedule.end_hour">
                                <option value="00">00</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                            </select>
                            <span class="px-2">:</span>
                            <select name="" id="" class="px-2 outline-none appearance-none bg-transparent rounded" v-model="newSchedule.end_minute">
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="15">30</option>
                            </select>
                        </div>
                    </label>
                    <button @click="addScheduleToUser()"
                        class="col-span-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        Añadir Bloque
                    </button>
                </div>
            </div>
        </div>
        <div class="shadow-md sm:rounded-lg relative mt-10">
            <div class="card-container overflow-x-auto grid md:grid-cols-1 lg:grid-cols-3">

                <div v-for="(day, index) in days_of_the_week" :key="index" class="card my-2 mx-2">
                    <div
                        class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                        <div
                            class="w-full text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                            {{ day.name }}</div>
                        <ul>
                            <li v-if="groupedSchedules[index + 1] && groupedSchedules[index + 1].length"
                                class="items-center">
                                <div v-for="schedule in groupedSchedules[index + 1]" :key="schedule.id"
                                    class="cursor-pointer w-full text-white bg-purple-800 hover:bg-purple-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                                    {{ formatTime(schedule.start_time) }} - {{ formatTime(schedule.end_time) }} | {{
                                        schedule.modality.name }} <i class="ml-4 fa-solid fa-trash-can text-xl hover:text-red-500" @click="deleteSchedule(schedule.id)"></i>
                                </div>
                            </li>
                            <li v-else>
                                No hay horarios para este día
                            </li>
                            <div v-if="schedules.length == 0" role="status" class="flex justify-center p-10">
                                <Loader />
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script>
import Breadcrumb from '@/Components/Flowbite/Navigation/Breadcrumb.vue';
import Loader from '@/Components/Loader.vue';

export default {
    components: {
        Breadcrumb,
        Loader
    },
    props: ['breadcrumbs', 'user_id', 'user'],
    data() {
        return {
            param: null,
            schedules: [],
            days_of_the_week: [
                { name: "Lunes" },
                { name: "Martes" },
                { name: "Miércoles" },
                { name: "Jueves" },
                { name: "Viernes" },
                { name: "Sábado" },
                { name: "Domingo" },
            ],
            modalities: [],
            newSchedule: {
                user_id: this.user_id,
                modality_id: 1,
                week_day: 1,
                start_hour: '06',
                start_minute: '00',
                end_hour: '06',
                end_minute: '00',
            },
        }
    },
    methods: {
        showModal(id) {
            let modal = document.getElementById(id);
            modal.classList.remove('slide-out-bck-center');
            modal.classList.remove('no-display');
        },
        async delete(id) {
            try {
                const response = await axios.delete('/rates/' + id);
                this.fetch();
                // handle success (e.g., show notification, redirect)
            } catch (error) {
                console.log(error);
            }
        },
        async addScheduleToUser() {
            this.newSchedule.start_time= this.newSchedule.start_hour + ':' + this.newSchedule.start_minute;  
            this.newSchedule.end_time= this.newSchedule.end_hour + ':' + this.newSchedule.end_minute;  
            try {
                const response = await axios.post('/addScheduleToUser', this.newSchedule);
                this.fetch();
                // handle success (e.g., show notification, redirect)
            } catch (error) {
                console.log(error);
            }
        },
        async deleteSchedule(id) {
            try {
                const response = await axios.delete('/deleteSchedule/' + id);
                this.fetch();
                // handle success (e.g., show notification, redirect)
            } catch (error) {
                console.log(error);
            }
        },
        

        async fetch() {
            try {
                const response = await axios.get('/getUserSchedules', {
                    params: {
                        user_id: this.user_id
                    },
                });
                this.schedules = response.data;
            } catch (error) {
                console.log(error);
            }
        },
        async getModalities() {
            try {
                const response = await axios.get('/api/getModalities', {
                    params: {
                    },
                });
                this.modalities = response.data;
            } catch (error) {
                console.log(error);
            }
        },
        formatTime(time) {
            const date = new Date(`1970-01-01T${time}`);
            return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        },
    },
    mounted() {
        this.fetch();
        this.getModalities();
    },
    watch: {
        searchQuery: {
            handler() {
                this.fetch();
            },
            immediate: true
        }
    },
    computed: {
        groupedSchedules() {
            return this.schedules.reduce((groups, schedule) => {
                const day = schedule.week_day;
                if (!groups[day]) {
                    groups[day] = [];
                }
                groups[day].push(schedule);
                return groups;
            }, {});
        },
    },
};
</script>
<style scoped>
.card-container {
    display: grid;
    align-items: start;
}
</style>