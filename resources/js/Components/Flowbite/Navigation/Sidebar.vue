<template>
    <aside
        class="slide-in-left fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0  ">
        <div class="overflow-y-auto py-5 px-3 h-full bg-white ">
            <ul class="space-y-2">
                <NavLink href="/dashboard" text="Dashboard" icon="fa-solid fa-dashboard" />
                <NavLink href="/appointments" text="Reservas" icon="fa-solid fa-user-tie" />
                <NavLink href="/customers" text="Clientes" icon="fa-solid fa-user-tie" />
                <NavLink href="/payments" text="Pagos" icon="fa-solid fa-user-tie" />
            </ul>
            <ul class="pt-5 mt-5 space-y-2 border-t border-gray-200">
                <NavLink href="/users" text="Usuarios" icon="fa-solid fa-user-tie" />
                <NavLink href="/branchs" text="Sucursales" icon="fa-solid fa-user-tie" />
                <NavLinkDropdown text="Tarifas y Planes" icon="fa-solid fa-gear"
                    :childs="[{ name: 'Familia', href: '/families' }, { name: 'Subfamilia', href: '/subfamilies' },{ name: 'Tarifas', href: '/rates' }]" />
            </ul>
        </div>
        <div class="absolute bottom-0 left-0 justify-center p-4 space-x-4 w-full lg:flex bg-white  z-20">
            <div class="inline-flex rounded-md shadow-sm" role="group">
                <button type="button"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-purple-700 focus:z-10 focus:ring-2 focus:ring-purple-700 focus:text-purple-700      dark:focus:ring-purple-500 dark:focus:text-white">
                    <i class="fa-solid fa-gear"></i>
                </button>
                <button type="button"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-purple-700 focus:z-10 focus:ring-2 focus:ring-purple-700 focus:text-purple-700      dark:focus:ring-purple-500 dark:focus:text-white">
                    <i class="fa-solid fa-user"></i>
                </button>
                <button type="button" @click="goTo('')"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-purple-700 focus:z-10 focus:ring-2 focus:ring-purple-700 focus:text-purple-700      dark:focus:ring-purple-500 dark:focus:text-white">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </button>
            </div>
        </div>
    </aside>
</template>
<script>
import NavLink from '@/Components/Flowbite/Navigation/NavLink.vue';
import NavLinkDropdown from '@/Components/Flowbite/Navigation/NavLinkDropdown.vue';
export default {
    name: 'SideBar',
    components: {
        NavLink,
        NavLinkDropdown,
    },
    props: ['userInfo'],
    data() {
        return {
        };
    },
    methods: {

    },
    mounted() {
    },
};
</script>