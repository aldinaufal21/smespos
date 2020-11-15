@extends('konsumen_app.layouts.app')

@section('title','Wishlist')

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
                              <h1>wishlist</h1>
                              <ul class="breadcrumb">
                                  <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                  <li class="breadcrumb-item active" aria-current="page">wishlist</li>
                              </ul>
                          </nav>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- breadcrumb area end -->

      <!-- wishlist main wrapper start -->
      <div class="wishlist-main-wrapper section-space pb-0">
          <div class="container">
              <!-- Wishlist Page Content Start -->
              <div class="section-bg-color">
                  <div class="row">
                      <div class="col-lg-12">
                          <!-- Wishlist Table Area -->
                          <div class="cart-table table-responsive">
                              <table class="table table-bordered">
                                  <thead>
                                      <tr>
                                          <th class="pro-thumbnail">Thumbnail</th>
                                          <th class="pro-title">Product</th>
                                          <th class="pro-price">Price</th>
                                          <th class="pro-quantity">Stock Status</th>
                                          <th class="pro-subtotal">Add to Cart</th>
                                          <th class="pro-remove">Remove</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <td class="pro-thumbnail"><a href="#"><img class="img-fluid" src="{{ asset('konsumen_assets/img/product/product-5.jpg') }}" alt="Product" /></a></td>
                                          <td class="pro-title"><a href="#">Rose bouquet white</a></td>
                                          <td class="pro-price"><span>$295.00</span></td>
                                          <td class="pro-quantity"><span class="text-success">In Stock</span></td>
                                          <td class="pro-subtotal"><a href="cart.html" class="btn btn__bg">Add to
                                                  Cart</a></td>
                                          <td class="pro-remove"><a href="#"><i class="fa fa-trash-o"></i></a></td>
                                      </tr>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- Wishlist Page Content End -->
          </div>
      </div>
      <!-- wishlist main wrapper end -->
  </main>
  <!-- main wrapper end -->
@endsection

@section('extra_script')
<!-- Page level plugins -->
<script>

</script>
@endsection
