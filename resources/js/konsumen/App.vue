<template>
    <div>
      <app-header v-if="isAuth && !checkoutMode" />
      <app-aside v-if="isAuth && !checkoutMode" />

      <div class="content-wrapper">
          <router-view></router-view>
      </div>

      <!-- <app-footer v-if="isAuth && !checkoutMode" /> -->
      <app-footer/>
      <app-mini-cart v-if="isAuth && !checkoutMode" />

      <!-- Scroll to top start -->
      <div class="scroll-top not-visible">
          <i class="fa fa-angle-up"></i>
      </div>
      <!-- Scroll to Top End -->

      <!-- offcanvas search form start -->
      <div class="offcanvas-search-wrapper">
          <div class="offcanvas-search-inner">
              <div class="offcanvas-close">
                  <i class="lnr lnr-cross"></i>
              </div>
              <div class="container">
                  <div class="offcanvas-search-box">
                      <form class="d-flex bdr-bottom w-100">
                          <input type="text" placeholder="Search entire storage here...">
                          <button class="search-btn"><i class="lnr lnr-magnifier"></i>search</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
      <!-- offcanvas search form end -->
    </div>
</template>
<script>
    import { mapActions, mapMutations, mapGetters, mapState } from 'vuex';
    import Header from './components/Header.vue';
    import Footer from './components/Footer.vue';
    import Aside from './components/Aside.vue';
    import MiniCart from './components/MiniCart.vue';
    // import Breadcrumb from './components/Breadcrumb.vue';

    export default {
      data(){
        return {
          checkoutMode: false
        }
      },
      computed: {
          ...mapGetters(['isAuth']),
          ...mapState(['errors'])
      },
      components: {
            'app-header': Header,
            'app-footer': Footer,
            'app-aside': Aside,
            'app-mini-cart': MiniCart,
            // 'breadcrumb': Breadcrumb,
        }
    }
</script>
