<template>
  <!-- main wrapper start -->
  <div>
      <!-- breadcrumb area start -->
      <div class="breadcrumb-area common-bg">
          <div class="container">
              <div class="row">
                  <div class="col-12">
                      <div class="breadcrumb-wrap">
                          <nav aria-label="breadcrumb">
                              <h1>Login</h1>
                              <ul class="breadcrumb">
                                  <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                  <li class="breadcrumb-item active" aria-current="page">Login</li>
                              </ul>
                          </nav>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- breadcrumb area end -->

      <!-- login register wrapper start -->
      <center>
          <div class="login-register-wrapper section-space pb-0">
              <div class="container">
                  <div class="member-area-from-wrap">
                      <!-- Login Content Start -->
                      <div class="col-lg-7 ">
                          <div class="login-reg-form-wrap">
                              <h2>Sign In</h2>
                              <form action="#" method="post">
                                  <div class="single-input-item">
                                      <input type="email" placeholder="Email or Username" required />
                                  </div>
                                  <div class="single-input-item">
                                      <input type="password" placeholder="Enter your Password" required />
                                  </div>
                                  <div class="single-input-item">
                                      <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                          <div class="remember-meta">
                                              <div class="custom-control custom-checkbox">
                                                  <input type="checkbox" class="custom-control-input" id="rememberMe">
                                                  <label class="custom-control-label" for="rememberMe">Remember Me</label>
                                              </div>
                                          </div>
                                          <a href="#" class="forget-pwd">Forget Password?</a>
                                      </div>
                                  </div>
                                  <div class="single-input-item">
                                      <button class="btn btn__bg">Login</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                      <!-- Login Content End -->
                  </div>
              </div>
          </div>
      </center>
      <!-- login register wrapper end -->
  </div>
  <!-- main wrapper end -->
</template>

<script>
import { mapActions, mapMutations, mapGetters, mapState } from 'vuex';
export default {
    data() {
        return {
            data: {
                email: '',
                password: '',
                remember_me: false
            }
        }
    },
    created() {
      console.log("login created");
        if (this.isAuth) {
            this.$router.push({ name: 'home' })
        }
    },
    // computed: {
    //     ...mapGetters(['isAuth']),
    //     ...mapState(['errors'])
    // },
    // methods: {
    //     ...mapActions('auth', ['submit']),
    //     ...mapActions('user', ['getUserLogin']),
    //     ...mapMutations(['CLEAR_ERRORS']),
    //     postLogin() {
    //         this.submit(this.data).then(() => {
    //             if (this.isAuth) {
    //                 this.CLEAR_ERRORS()
    //                 this.$router.push({ name: 'home' })
    //             }
    //         })
    //     }
    // },
    // destroyed() {
    //     this.getUserLogin()
    // }
}
</script>
