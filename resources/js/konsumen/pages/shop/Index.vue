<template>
  <main>
    <breadcrumb></breadcrumb>

    <router-view></router-view>
  </main>
</template>

<script>
import { mapActions, mapMutations, mapGetters, mapState } from 'vuex';
import Breadcrumb from '../../components/Breadcrumb.vue';

export default {
    name: 'ShopIndex',
    data() {
        return {

        }
    },
    components: {
      'breadcrumb': Breadcrumb
    },
    methods: {

    },
}
</script>
