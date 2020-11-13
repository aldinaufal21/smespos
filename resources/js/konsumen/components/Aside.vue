<template>
  <!-- off-canvas menu start -->
  <aside class="off-canvas-wrapper">
      <div class="off-canvas-overlay"></div>
      <div class="off-canvas-inner-content">
          <div class="btn-close-off-canvas">
              <i class="lnr lnr-cross"></i>
          </div>

          <div class="off-canvas-inner">
              <!-- search box start -->
              <div class="search-box-offcanvas">
                  <form>
                      <input type="text" placeholder="Search Here...">
                      <button class="search-btn"><i class="lnr lnr-magnifier"></i></button>
                  </form>
              </div>
              <!-- search box end -->

              <!-- mobile menu start -->
              <div class="mobile-navigation">

                  <!-- mobile menu navigation start -->
                  <nav>
                      <ul class="mobile-menu">
                          <li class="menu-item-has-children"><a href="index.html">Home</a></li>
                          <li class="menu-item-has-children "><a href="shop.html">Shop</a></li>
                          <li class="menu-item-has-children "><a href="blog-left-sidebar.html">Blog</a></li>
                          <li><a href="contact-us.html">Contact us</a></li>
                      </ul>
                  </nav>
                  <!-- mobile menu navigation end -->
              </div>
              <!-- mobile menu end -->

              <div class="mobile-settings">
                  <ul class="nav">
                      <li>
                          <div class="dropdown mobile-top-dropdown">
                              <a href="#" class="dropdown-toggle" id="myaccount" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  My Account
                                  <i class="fa fa-angle-down"></i>
                              </a>
                              <div class="dropdown-menu" aria-labelledby="myaccount">
                                  <a class="dropdown-item" href="my-account.html">my account</a>
                                  <a class="dropdown-item" href="login.html"> login</a>
                                  <a class="dropdown-item" href="register.html">register</a>
                              </div>
                          </div>
                      </li>
                  </ul>
              </div>

              <!-- offcanvas widget area start -->
              <div class="offcanvas-widget-area">
                  <div class="off-canvas-contact-widget">
                      <ul>
                          <li><i class="fa fa-mobile"></i>
                              <a href="#">0123456789</a>
                          </li>
                          <li><i class="fa fa-envelope-o"></i>
                              <a href="#">info@yourdomain.com</a>
                          </li>
                      </ul>
                  </div>
                  <div class="off-canvas-social-widget">
                      <a href="#"><i class="fa fa-facebook"></i></a>
                      <a href="#"><i class="fa fa-twitter"></i></a>
                      <a href="#"><i class="fa fa-pinterest-p"></i></a>
                      <a href="#"><i class="fa fa-linkedin"></i></a>
                      <a href="#"><i class="fa fa-youtube-play"></i></a>
                  </div>
              </div>
              <!-- offcanvas widget area end -->
          </div>
      </div>
  </aside>
  <!-- off-canvas menu end -->
</template>

<script>
export default {
    data(){
      return {
        
      }
    },
    methods: {

    }
}
</script>
