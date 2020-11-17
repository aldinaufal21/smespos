<template>
  <!-- breadcrumb area start -->
  <div class="breadcrumb-area common-bg">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <div class="breadcrumb-wrap">
                      <nav aria-label="breadcrumb">
                          <h1>{{ title }}</h1>
                          <ul class="breadcrumb">
                              <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                              <li class="breadcrumb-item active" aria-current="page">{{ title }}</li>
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
    name: 'breadcrumb',
    data: function() {
        return {

        }
    },
    props: ['title']
}
</script>
