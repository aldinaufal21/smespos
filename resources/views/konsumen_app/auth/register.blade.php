@extends('konsumen_app.layouts.app')

@section('title','Register')

@section('extra_head')
<!-- Custom styles for this page -->
<style media="screen">

</style>
@endsection

@section('content')
  <!-- main wrapper start -->
  <main id="regis-vue">
      <breadcrumb :title="'Register'"></breadcrumb>

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
                              <form @submit="submitRegis">
                                  <div class="single-input-item">
                                      <input type="text" placeholder="Full Name" v-model="regis_data.nama_konsumen" required />
                                  </div>
                                  <div class="single-input-item">
                                      <input type="username" placeholder="Enter your Username" v-model="regis_data.username" required />
                                  </div>
                                  <div class="row">
                                      <div class="col-lg-6">
                                          <div class="single-input-item">
                                              <input type="password" placeholder="Enter your Password" v-model="regis_data.password" required />
                                          </div>
                                      </div>
                                      <div class="col-lg-6">
                                          <div class="single-input-item">
                                              <input type="password" placeholder="Repeat your Password" v-model="regis_data.password_confirmation" required />
                                          </div>
                                      </div>
                                  </div>
                                  <div class="single-input-item">
                                      <button class="btn btn__bg">Register</button>
                                  </div>
                                  <div class="single-input-item">
                                      <p>Already have account? <a href="{{ route('konsumen.login') }}">Login here</a></p>
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
@endsection

@section('extra_script')
<!-- Page level plugins -->
<script>

  var regis_vue = new Vue({
    el: '#regis-vue',
    data(){
      return{
        regis_data: {
          username: '',
          password: '',
          password_confirmation: '',
          nama_konsumen: ''
        }
      }
    },
    created() {
      //do something after creating vue instance
      $auth.authenticated();
    },
    methods: {
      submitRegis(event) {
        $.LoadingOverlay("show");
        event.preventDefault();

        axios.post('/consumer/register', this.regis_data).then((res)=>{
          if (res.status == 201) {
            axios.post('/login', {
              username: res.data.username,
              password: this.regis_data.password
            }).then((result)=>{
              if (result.data.token) {
                localStorage.setItem('token', result.data.token);
                window.location.href = $baseURL + '/';
              }
            }).catch((e)=>{
              console.log(e);
              swal({
                icon: "error",
                title: "Terjadi kesalahan, harap coba beberapa saat lagi."
              })
            }).finally(()=>{
              $.LoadingOverlay("hide");
            });
          }
        }).catch((err)=>{
          console.log(err);
          $helper.errorModal(err);
        }).finally(()=>{
          $.LoadingOverlay("hide");
        });
      }
    }
})

</script>
@endsection
