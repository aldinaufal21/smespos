<template>
    <div>
      <app-header v-if="isAuth" />
      <app-aside v-if="isAuth" />

      <div class="content-wrapper">
          <router-view></router-view>
      </div>
      <app-footer v-if="isAuth" />>
    </div>
</template>
<script>
    import Header from './components/Header.vue'
    import Footer from './components/Footer.vue'
    import Aside from './components/Aside.vue'
    export default {
      data(){
        return {
          isAuth: true
        }
      },
      components: {
            'app-header': Header,
            'app-footer': Footer,
            'app-aside': Aside
        }
    }
</script>
