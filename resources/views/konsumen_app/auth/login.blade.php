@extends('konsumen_app.layouts.app')

@section('title','Login')

@section('extra_head')
<!-- Custom styles for this page -->
<style media="screen">

</style>
@endsection

@section('content')
  <!-- main wrapper start -->
    <main id="login-vue">
        <breadcrumb :title="'Login'"></breadcrumb>

        <!-- login register wrapper start -->
        <center>
            <div class="login-register-wrapper section-space pb-0">
                <div class="container">
                    <div class="member-area-from-wrap">
                        <!-- Login Content Start -->
                        <div class="col-lg-7 ">
                            <div class="login-reg-form-wrap">
                                <h1 style="margin-bottom:0;">Sign In</h1>
                                <form @submit="submitLogin">
                                    <img src="/img/logo1.png" alt="" width="30%">
                                    <div class="single-input-item">
                                        <input type="username" v-model="login_data.username" placeholder="Username" required />
                                    </div>
                                    <div class="single-input-item">
                                        <input type="password" v-model="login_data.password" placeholder="Enter your Password" required />
                                    </div>
                                    <div class="single-input-item">
                                        <button class="btn btn__bg" type="submit">Login</button>
                                    </div>
                                    <div class="single-input-item">
                                        <p>don't have account? <a href="{{ route('konsumen.register') }}">Register here</a></p>
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
@endsection

@section('extra_script')
<!-- Page level plugins -->
<script>
  var login_vue = new Vue({
    el: '#login-vue',
    data(){
      return{
        login_data: {
          username: '',
          password: ''
        }
      }
    },
    created() {
      //do something after creating vue instance
      $auth.authenticated();
    },
    methods: {
      submitLogin(event) {
        event.preventDefault();

        axios.post('/login', this.login_data).then((res)=>{
          // console.log(res);
          if (res.data.token) {
            localStorage.setItem('token', res.data.token);
            window.location.href = $baseURL + '/';
          }
        }).catch((err)=>{
          console.log(err);
        })
      }
    }
  })

</script>
@endsection
