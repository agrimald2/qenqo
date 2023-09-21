<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <body class="bg-gray-100">
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="min-h-1/2 bg-[#2A1E36] border border-gray-900 rounded-2xl">
                <div
                    class="mx-4 sm:mx-24 md:mx-34 lg:mx-56 mx-auto  flex items-center space-y-4 py-16 font-semibold text-gray-500 flex-col px-4">
                    <img :src="'/logo.png'" alt="qenqo-logo" style="width: auto;">
                    <h1 class="text-white text-2xl">iniciar sesion en <strong> Qenqo </strong></h1>
                    <form @submit.prevent="submit" class="py-2">
                        <input v-model="form.email"
                            class="my-2 w-full p-2 bg-gray-800 rounded-md border border-gray-700 focus:border-purple-700"
                            placeholder="Usuario" type="email" name="correo" id="">
                        <input v-model="form.password"
                            class="my-2 w-full p-2 bg-gray-800 rounded-md border border-gray-700 " placeholder="Contraseña"
                            type="password" name="correo" id="">
                        <input :disabled="form.processing"
                            class="cursor-pointer my-2 w-full p-2 bg-gray-50 rounded-full font-bold text-gray-900 border border-gray-700 "
                            type="submit" name="correo" id="">
                    </form>
                </div>
            </div>
        </div>
    </body>
</template>
