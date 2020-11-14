<!DOCTYPE html>
<html lang="en">

<head>

  <title>SMEs POS - @yield('title', '')</title>

  @include('konsumen_app.layouts.partials.head')
  @yield('extra_head')
</head>

<body>
  @include('konsumen_app.layouts.partials.header')

  @include('konsumen_app.layouts.partials.sidebar')

  @yield('content')

  @include('konsumen_app.layouts.partials.footer')

  <!-- offcanvas search form start -->
  <div class="offcanvas-search-wrapper">
      <div class="offcanvas-search-inner">
          <div class="offcanvas-close">
              <i class="lnr lnr-cross"></i>
          </div>
          <div class="container">
              <div class="offcanvas-search-box">
                  <form class="d-flex bdr-bottom w-100">
                      <input type="text" placeholder="Search entire storage here...">
                      <button class="search-btn"><i class="lnr lnr-magnifier"></i>search</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
  <!-- offcanvas search form end -->

  <!-- offcanvas mini cart start -->
  <div class="offcanvas-minicart-wrapper">
      <div class="minicart-inner">
          <div class="offcanvas-overlay"></div>
          <div class="minicart-inner-content">
              <div class="minicart-close">
                  <i class="lnr lnr-cross"></i>
              </div>
              <div class="minicart-content-box">
                  <div class="minicart-item-wrapper">
                      <ul>
                          <li class="minicart-item">
                              <div class="minicart-thumb">
                                  <a href="product-details.html">
                                      <img src="{{ asset('konsumen_assets/img/cart/cart-1.jpg') }}" alt="product">
                                  </a>
                              </div>
                              <div class="minicart-content">
                                  <h3 class="product-name">
                                      <a href="product-details.html">Flowers bouquet pink for all flower lovers</a>
                                  </h3>
                                  <p>
                                      <span class="cart-quantity">1 <strong>&times;</strong></span>
                                      <span class="cart-price">$100.00</span>
                                  </p>
                              </div>
                              <button class="minicart-remove"><i class="lnr lnr-cross"></i></button>
                          </li>
                          <li class="minicart-item">
                              <div class="minicart-thumb">
                                  <a href="product-details.html">
                                      <img src="{{ asset('konsumen_assets/img/cart/cart-2.jpg') }}" alt="product">
                                  </a>
                              </div>
                              <div class="minicart-content">
                                  <h3 class="product-name">
                                      <a href="product-details.html">Jasmine flowers white for all flower lovers</a>
                                  </h3>
                                  <p>
                                      <span class="cart-quantity">1 <strong>&times;</strong></span>
                                      <span class="cart-price">$80.00</span>
                                  </p>
                              </div>
                              <button class="minicart-remove"><i class="lnr lnr-cross"></i></button>
                          </li>
                      </ul>
                  </div>

                  <div class="minicart-pricing-box">
                      <ul>
                          <li>
                              <span>sub-total</span>
                              <span><strong>$300.00</strong></span>
                          </li>
                          <li>
                              <span>Eco Tax (-2.00)</span>
                              <span><strong>$10.00</strong></span>
                          </li>
                          <li>
                              <span>VAT (20%)</span>
                              <span><strong>$60.00</strong></span>
                          </li>
                          <li class="total">
                              <span>total</span>
                              <span><strong>$370.00</strong></span>
                          </li>
                      </ul>
                  </div>

                  <div class="minicart-button">
                      <a href="{{ route('konsumen.cart') }}"><i class="fa fa-shopping-cart"></i> view cart</a>
                      <a href="{{ route('konsumen.checkout') }}"><i class="fa fa-share"></i> checkout</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- offcanvas mini cart end -->

  <!-- Scroll to top start -->
  <div class="scroll-top not-visible">
      <i class="fa fa-angle-up"></i>
  </div>
  <!-- Scroll to Top End -->

  @include('konsumen_app.layouts.partials.footer-scripts')

  <script>
    // let _user = $auth.userCredentials();
    // switch (_user.user.role) {
    //   case 'kasir':
    //     $('.nav-kasir').show();
    //     break;
    //   case 'pemilik':
    //     $('.nav-pemilik').show();
    //     break;
    //   case 'cabang':
    //     $('.nav-cabang').show();
    //     break;
    //   case 'pengelola':
    //     $('.nav-pengelola').show();
    //     break;
    //   case 'umkm':
    //     $('.nav-umkm').show();
    //     break;
    //   default:
    // }
    //
    // $('#js-usersname-display').text(_user.user.username);

    // const logoutOperation = () => {
    //   // localStorage.clear();
    //   localStorage.removeItem('user');
    //   window.location.href = $baseURL + '/login';
    // }
  </script>

  @yield('extra_script')

</body>

</html>
