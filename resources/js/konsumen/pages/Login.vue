<template>
  <!-- main wrapper start -->
  <main>
    <!-- <breadcrumb></breadcrumb> -->

      <!-- login register wrapper start -->
      <center>
          <div class="login-register-wrapper section-space pb-0">
              <div class="container">
                  <div class="member-area-from-wrap">
                      <!-- Login Content Start -->
                      <div class="col-lg-7 ">
                          <div class="login-reg-form-wrap">
                              <h1 style="margin-bottom:0;">Sign In</h1>
                              <form @submit="postLogin">
                                  <img src="/img/logo1.png" alt="" width="30%">
                                  <div class="single-input-item">
                                      <input type="username" v-model="login_data.username" placeholder="Username" required />
                                  </div>
                                  <div class="single-input-item">
                                      <input type="password" v-model="login_data.password" placeholder="Enter your Password" required />
                                  </div>
                                  <div class="single-input-item">
                                      <button class="btn btn__bg">Login</button>
                                  </div>
                                  <div class="single-input-item">
                                      <p>don't have account? <router-link :to="{ name: 'register' }">Register here</router-link></p>
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
  </main>
  <!-- main wrapper end -->
</template>

<script>
import { mapActions, mapMutations, mapGetters, mapState } from 'vuex';
import Breadcrumb from '../components/Breadcrumb.vue';

export default {
    data() {
        return {
            login_data: {
                username: '',
                password: ''
            }
        }
    },
    components: {
          'breadcrumb': Breadcrumb,
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
