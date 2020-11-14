<template>
  <!-- main wrapper start -->
  <main>
      <!-- login register wrapper start -->
      <center>
          <div class="login-register-wrapper section-space pb-0">
              <div class="container">
                  <div class="member-area-from-wrap">
                      <!-- resgiter Content Start -->
                      <div class="col-lg-7">
                          <div class="login-reg-form-wrap sign-up-form">
                              <h1 style="margin-bottom:0;">Registrasi</h1>
                              <img src="/img/logo1.png" alt="" width="30%">
                              <!-- <div class="icons">
                              </div> -->
                              <form action="#" method="post">
                                  <div class="single-input-item">
                                      <input type="text" placeholder="Full Name" required />
                                  </div>
                                  <div class="single-input-item">
                                      <input type="email" placeholder="Enter your Email" required />
                                  </div>
                                  <div class="row">
                                      <div class="col-lg-6">
                                          <div class="single-input-item">
                                              <input type="password" placeholder="Enter your Password" required />
                                          </div>
                                      </div>
                                      <div class="col-lg-6">
                                          <div class="single-input-item">
                                              <input type="password" placeholder="Repeat your Password" required />
                                          </div>
                                      </div>
                                  </div>
                                  <div class="single-input-item">
                                      <button class="btn btn__bg">Register</button>
                                  </div>
                                  <div class="single-input-item">
                                      <p>Already have account? <router-link :to="{ name: 'login' }">Login here</router-link></p>
                                  </div>
                              </form>
                          </div>
                      </div>
                      <!-- register Content End -->
                  </div>
              </div>
          </div>
      </center>
      <!-- login register wrapper end -->
  </main>
  <!-- main wrapper end -->
</template>

<script>
import { mapActions, mapMutations, mapGetters, mapState } from 'vuex';
export default {
    data() {
        return {
            login_data: {
                username: '',
                password: ''
            }
        }
    },
    created() {
        if (this.isAuth) {
            this.$router.push({ name: 'home' })
        }
    },
    computed: {
        ...mapGetters(['isAuth']),
        ...mapState(['errors'])
    },
    methods: {
        ...mapActions('auth', ['submit']),
        ...mapMutations(['CLEAR_ERRORS']),
        postLogin(event) {
            event.preventDefault();
            this.submit(this.login_data).then(() => {
                if (this.isAuth) {
                    this.CLEAR_ERRORS()
                    this.$router.push({ name: 'home' })
                }
            })
        }
    },
    destroyed() {
        // this.getUserLogin()
    }
}
</script>
