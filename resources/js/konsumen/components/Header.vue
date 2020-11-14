<template>
  <!-- Start Header Area -->
  <header class="header-area">
      <!-- main header start -->
      <div class="main-header d-none d-lg-block">

          <!-- header middle area start -->
          <div class="header-main-area sticky">
              <div class="container">
                  <div class="row align-items-center position-relative">

                      <!-- start logo area -->
                      <div class="col-lg-3">
                          <div class="logo">
                              <a href="index.html">
                                  <img src="konsumen_assets/img/logo/pos.png" alt="">
                              </a>
                          </div>
                      </div>
                      <!-- start logo area -->

                      <!-- main menu area start -->
                      <div class="col-lg-6 position-static">
                          <div class="main-menu-area">
                              <div class="main-menu">
                                  <!-- main menu navbar start -->
                                  <nav class="desktop-menu">
                                      <ul>
                                          <li>
                                            <router-link :to="{ name: 'home' }">Home</router-link>
                                          </li>
                                          <li>
                                            <router-link :to="{ name: 'shop' }">Shop</router-link>
                                          </li>
                                          <!-- <li><a href="blog-left-sidebar.html">Blog</a>
                                          </li> -->
                                          <li>
                                            <router-link :to="{ name: 'contact' }">Contact Us</router-link>
                                          </li>
                                      </ul>
                                  </nav>
                                  <!-- main menu navbar end -->
                              </div>
                          </div>
                      </div>
                      <!-- main menu area end -->

                      <!-- mini cart area start -->
                      <div class="col-lg-3">
                          <div class="header-configure-wrapper">
                              <div class="header-configure-area">
                                  <ul class="nav justify-content-end">
                                      <li>
                                          <a href="#" class="offcanvas-btn">
                                              <i class="lnr lnr-magnifier"></i>
                                          </a>
                                      </li>
                                      <li class="user-hover">
                                          <a href="#">
                                              <i class="lnr lnr-user"></i>
                                          </a>
                                          <ul class="dropdown-list">
                                              <li><router-link :to="{ name: 'user' }">My Account</router-link></li>
                                              <li><a href="javascript:void(0)" @click="logout">Logout</a></li>
                                          </ul>
                                      </li>
                                      <li>
                                          <router-link :to="{ name: 'wishlist' }">
                                            <i class="lnr lnr-heart"></i>
                                            <div class="notification">0</div>
                                          </router-link>
                                      </li>
                                      <li>
                                        <a href="#" class="minicart-btn">
                                            <i class="lnr lnr-cart"></i>
                                            <div class="notification">2</div>
                                        </a>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                      <!-- mini cart area end -->

                  </div>
              </div>
          </div>
          <!-- header middle area end -->
      </div>
      <!-- main header start -->

      <!-- mobile header start -->
      <div class="mobile-header d-lg-none d-md-block sticky">
          <!--mobile header top start -->
          <div class="container">
              <div class="row align-items-center">
                  <div class="col-12">
                      <div class="mobile-main-header">
                          <div class="mobile-logo">
                              <a href="index.html">
                                  <img src="konsumen_assets/img/logo/logo.png" alt="Brand Logo">
                              </a>
                          </div>
                          <div class="mobile-menu-toggler">
                              <div class="mini-cart-wrap">
                                  <a href="cart.html">
                                      <i class="lnr lnr-cart"></i>
                                  </a>
                              </div>
                              <div class="mobile-menu-btn">
                                  <div class="off-canvas-btn">
                                      <i class="lnr lnr-menu"></i>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- mobile header top start -->
      </div>
      <!-- mobile header end -->
  </header>
  <!-- end Header Area -->
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
    computed: {

    },
    methods: {
        logout() {
            return new Promise((resolve, reject) => {
                localStorage.removeItem('user')
                this.$store.commit('SET_TOKEN', null, { root: true })
                resolve()
            }).then(() => {
                // this.$store.state.token = localStorage.getItem('user')
                this.$router.push('/login')
            })
        }
    }
}
</script>
