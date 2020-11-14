<template>
    <!-- <ol class="breadcrumb">
        <li><router-link :to="{ name: 'home' }"><i class="fa fa-dashboard"></i> Home</router-link>
        <li class="active">{{ $route.meta.title }}</li>
    </ol> -->
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area common-bg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <h1>{{ $route.meta.title }}</h1>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><router-link :to="{ name: 'home' }"><i class="fa fa-home"></i></router-link></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $route.meta.title }}</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->
</template>

<script>
export default {
  
}
</script>
