<template>
  <nav class="bg-white border-b border-gray-200 px-4 py-2.5   fixed left-0 right-0 top-0 z-50" v-if="userInfo">
    <div class="flex flex-wrap justify-between items-center">
      <div class="flex justify-start items-center">
        <button @click="$emit('toggle-sidebar')"
          class="hidden p-2 mr-3 text-gray-600 rounded cursor-pointer lg:inline hover:text-gray-900 hover:bg-gray-100   ">
          <i class="fa-solid fa-bars"></i>
        </button>
        <button @click="$emit('toggle-sidebar')"
          class="lg:hidden p-2 mr-3 text-gray-600 rounded cursor-pointer lg:inline hover:text-gray-900 hover:bg-gray-100   ">
          <i class="fa-solid fa-bars"></i>
        </button>
        <a href="" class="flex mr-4">
          <img src="/logo.png" class="mr-3 h-8" alt="FlowBite Logo" /> {{ userInfo.name }}
        </a>
        <div class="hidden ml-10 hidden w-full md:block md:w-auto" id="navbar-default">
          <ul
            class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
            <li>
              <a href="#"
                class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500"
                aria-current="page">Dashboard</a>
            </li>
            <li>
              <a href="#"
                class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Reservas</a>
            </li>
            <li>
              <a href="#"
                class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Clientes</a>
            </li>
            <li>
              <a href="#"
                class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Pagos</a>
            </li>
          </ul>
        </div>
      </div>
      <p class="text-md font-bold">{{ userInfo.role.name }}</p>
    </div>
  </nav>
</template>
<script>
export default {
  components: {

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
