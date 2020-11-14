@extends('konsumen_app.layouts.app')

@section('title','Login')

@section('extra_head')
<!-- Custom styles for this page -->
<style media="screen">

</style>
@endsection

@section('content')
  <!-- main wrapper start -->
    <main>
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
                                <h1 style="margin-bottom:0;">Sign In</h1>
                                <form>
                                    <img src="/img/logo1.png" alt="" width="30%">
                                    <div class="single-input-item">
                                        <input type="username" placeholder="Username" required />
                                    </div>
                                    <div class="single-input-item">
                                        <input type="password" placeholder="Enter your Password" required />
                                    </div>
                                    <div class="single-input-item">
                                        <button class="btn btn__bg">Login</button>
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


</script>
@endsection
