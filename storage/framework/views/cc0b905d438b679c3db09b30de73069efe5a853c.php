<?php $__env->startSection('title','Wishlist'); ?>

<?php $__env->startSection('extra_head'); ?>
<!-- Custom styles for this page -->
<style media="screen">

</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <!-- main wrapper start -->
  <main id="vue-wishlist">
      <breadcrumb :title="'Wishlist'"></breadcrumb>

      <!-- wishlist main wrapper start -->
      <div class="wishlist-main-wrapper section-space pb-0">
          <div class="container">
              <!-- Wishlist Page Content Start -->
              <div class="section-bg-color">
                  <div class="row">
                      <div class="col-lg-12">
                          <!-- Wishlist Table Area -->
                          <div class="cart-table table-responsive">
                              <table class="table table-bordered" >
                                  <thead>
                                      <tr>
                                          <th class="pro-thumbnail">Thumbnail</th>
                                          <th class="pro-title">Product</th>
                                          <th class="pro-price">Price</th>
                                          
                                          <th class="pro-subtotal">Add to Cart</th>
                                          <th class="pro-remove">Remove</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr v-for="item in wishlists" :key="item.produk_id">
                                          <td class="pro-thumbnail"><a href="#"><img class="img-fluid" :src="item.gambar_produk" alt="Product" /></a></td>
                                          <td class="pro-title"><a href="#" v-text="item.nama_produk"></a></td>
                                          <td class="pro-price">Rp <span v-text="rupiahFormat(item.harga)"></span></td>
                                          
                                          <td class="pro-subtotal"><a href="#" @click="addToCart(item.produk_id)" class="btn btn__bg">Add to Cart</a></td>
                                          <td class="pro-remove"><a href="#" @click="deleteItem(item.produk_id)"><i class="fa fa-trash-o"></i></a></td>
                                      </tr>
                                  </tbody>
                              </table>
                              <br>
                              <center><h4 v-if="!wishlists.length">Wishlist anda kosong, silahkan pilih produk favorit anda <a href="<?php echo e(route('konsumen.shop')); ?>">disini</a> </h4></center>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra_script'); ?>
<!-- Page level plugins -->
<script>
  $auth.needAuthentication();

  var vue_wishlist = new Vue({
    el: '#vue-wishlist',
    data(){
      return {
        wishlists: [],
      }
    },
    mounted() {
      //do something after mounting vue instance
    },
    created() {
      //do something after creating vue instance
      this.getWishlist();
    },
    methods: {
      getWishlist() {
        axios.get('favorite-product').then((res)=>{
          // console.log(res);
          this.wishlists = res.data;
          mini_cart_vue.countWishlist();
        }).catch((err)=>{
          console.log(err);
          $helper.errorModal(err);
        })
      },

      deleteItem(produk_id){
        $swal({
            title: "Anda yakin?",
            text: "Data akan dihapus secara permanen!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((deleteData)=>{
            if (deleteData) {
              $.LoadingOverlay("show");
              axios.delete(`favorite-product/${produk_id}`).then((res)=>{
                this.getWishlist();
              }).catch((err)=>{
                console.log(err);
                $helper.errorModal(err);
              }).finally(()=>{
                $.LoadingOverlay("hide");
              });
            }
          });

      },

      addToCart(produk_id){
        $.LoadingOverlay("show");

        const payload = {
          produk_id: produk_id,
          quantity: 1
        }

        cartStore.addCart(payload).then((res)=>{
          // console.log(res);
          mini_cart_vue.updateCart();
        }).finally(()=>{
          $.LoadingOverlay("hide");
        });
      },

      rupiahFormat(value){
        return $helper.rupiahFormat(value);
      },
    }
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('konsumen_app.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/fit-iduka.com/ptviduka_pos/resources/views/konsumen_app/user/wishlist.blade.php ENDPATH**/ ?>