<template>
  <div class="antialiased bg-gray-50 ">
    <NavBar @toggle-sidebar="sidebarVisible = !sidebarVisible" :userInfo="userInfo" />
    <Sidebar v-if="sidebarVisible" :userInfo="userInfo" />
    <main :class="`p-4 h-auto pt-20 ${sidebarVisible ? 'md:ml-64' : 'md:ml-0'}`">
      <slot />
    </main>
  </div>
</template>
<script>
import Sidebar from '@/Components/Flowbite/Navigation/Sidebar.vue';
import NavBar from '@/Components/Flowbite/Navigation/NavBar.vue';
import GridExample from '@/Components/Flowbite/Layout/GridExample.vue';
export default {
  name: 'AdminLayout',
  components: {
    Sidebar,
    NavBar,
    GridExample
  },
  props: [''],
  data() {
    return {
      sidebarVisible: window.innerWidth > 768 ? true : false,
      userInfo: null,
    };
  },
  methods: {
    getAuthUserInformation() {
      axios.get('/user-information')
        .then(response => {
          this.userInfo = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },

  },
  mounted() {
    this.getAuthUserInformation();
  },
};
</script>
<style>
.no-display {
  display: none;
}

@media (max-width: 640px) {
  .table {
    width: max-content;
  }
}
</style>