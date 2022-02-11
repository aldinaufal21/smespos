<?php $__env->startSection('title','Shop'); ?>

<?php $__env->startSection('extra_head'); ?>
<!-- Custom styles for this page -->
<style media="screen">
  .my-nice-select {
    height: 36px;
    line-height: 34px;
    width: 200px;
    padding: 0 10px;
  }

  .my-nice-select {
    -webkit-tap-highlight-color: transparent;
    background-color: #fff;
    border-radius: 5px;
    border: solid 1px #e8e8e8;
    box-sizing: border-box;
    clear: both;
    cursor: pointer;
    display: block;
    float: left;
    font-family: inherit;
    font-size: 14px;
    font-weight: normal;
    height: 42px;
    line-height: 40px;
    outline: none;
    padding-left: 18px;
    padding-right: 30px;
    position: relative;
    text-align: left !important;
    -webkit-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    white-space: nowrap;
    width: auto;
  }

  .my-nice-select:hover {
    border-color: #dbdbdb;
  }

  .my-nice-select:active,
  .my-nice-select.open,
  .my-nice-select:focus {
    border-color: #999;
  }

  .my-nice-select:after {
    border-bottom: 2px solid #999;
    border-right: 2px solid #999;
    content: '';
    display: block;
    height: 5px;
    margin-top: -4px;
    pointer-events: none;
    position: absolute;
    right: 12px;
    top: 50%;
    -webkit-transform-origin: 66% 66%;
    -ms-transform-origin: 66% 66%;
    transform-origin: 66% 66%;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
    -webkit-transition: all 0.15s ease-in-out;
    transition: all 0.15s ease-in-out;
    width: 5px;
  }

  .my-nice-select.open:after {
    -webkit-transform: rotate(-135deg);
    -ms-transform: rotate(-135deg);
    transform: rotate(-135deg);
  }

  .my-nice-select.disabled {
    border-color: #ededed;
    color: #999;
    pointer-events: none;
  }

  .my-nice-select.disabled:after {
    border-color: #cccccc;
  }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div id="vue-shop">
  <!-- main wrapper start -->
  <main>

    <breadcrumb :title="'Shop'"></breadcrumb>

    <!-- PILIH UMKM -->
    <div class="shop-main-wrapper section-space pb-0">
      <div class="container">
        <div class="row">
          <!-- shop main wrapper start -->
          <div class="col-lg-12 order-1 order-lg-2">
            <div class="shop-product-wrapper">
              <!-- shop product top wrap start -->
              <div class="shop-top-bar">
                <div class="row align-items-center">
                  <div class="col-lg-7 col-md-6 order-2 order-md-1">
                    <div class="top-bar-left">
                      <div class="product-view-mode">
                        <a class="active" href="#" data-target="grid-view" data-toggle="tooltip" title="Grid View"><i class="fa fa-th"></i></a>
                        <a href="#" data-target="list-view" data-toggle="tooltip" title="List View"><i class="fa fa-list"></i></a>
                      </div>
                      <div class="product-amount">
                        <p>Showing {{ umkm.length }} results</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-5 col-md-6 order-1 order-md-2">
                    <div class="top-bar-right">
                      <div class="product-short">
                        <p>Sort By : </p>
                        <select class="my-nice-select" id="reset-this" v-model="sortKey">
                          <option value="name-asc">Name (A - Z)</option>
                          <option value="name-desc">Name (Z - A)</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- shop product top wrap start -->

              <!-- product item list wrapper start -->
              <div class="shop-product-wrap grid-view row mbn-40">
                <!-- product single item start -->
                <div class="col-md-4 col-sm-6" v-for="(elem, index) in umkm" :key="elem.umkm.umkm_id">
                  <!-- product grid start -->
                  <div class="product-item">
                    <figure class="product-thumb">
                      <a href="javascript:void(0)" @click="pilihCabang(index)">
                        <img class="pri-img" :src="elem.umkm.gambar" alt="product">
                        <img class="sec-img" :src="elem.umkm.gambar" alt="product">
                      </a>
                      <div class="button-group">
                        <a href="javascript:void(0)" @click="showUmkmDetail(elem.umkm.umkm_id)">
                          <span data-toggle="tooltip" data-placement="left" title="Quick View">
                            <i class="lnr lnr-magnifier"></i>
                          </span>
                        </a>
                      </div>
                    </figure>
                    <div class="product-caption">
                      <p class="product-name">
                        <a href="javascript:void(0)" @click="pilihCabang(index)" v-text="elem.umkm.nama_umkm"></a>
                      </p>
                    </div>
                  </div>
                  <!-- product grid end -->

                  <!-- product list item end -->
                  <div class="product-list-item">
                    <figure class="product-thumb">
                      <a href="javascript:void(0)" @click="pilihCabang(index)">
                        <img class="pri-img" :src="elem.umkm.gambar" alt="product">
                        <img class="sec-img" :src="elem.umkm.gambar" alt="product">
                      </a>
                    </figure>
                    <div class="product-content-list">
                      <h5 class="product-name"><a href="javascript:void(0)" @click="pilihCabang(index)" v-text="elem.umkm.nama_umkm"></a></h5>
                      <p v-text="elem.umkm.deskripsi"></p>
                      <div class="button-group-list">
                        <a href="javascript:void(0)" @click="showUmkmDetail(elem.umkm.umkm_id)">
                          <span data-toggle="tooltip" title="Quick View">
                            <i class="lnr lnr-magnifier"></i>
                          </span>
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- product list item end -->
                </div>
                <!-- product single item start -->
              </div>
              <!-- product item list wrapper end -->
            </div>
          </div>
          <!-- shop main wrapper end -->
        </div>
      </div>
    </div>
    <!-- /PILIH UMKM -->
  </main>
  <!-- main wrapper end -->

  <!-- Quick view modal start -->
  <div class="modal" id="quick_view">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <!-- product details inner end -->
          <div class="product-details-inner">
            <div class="row">
              <div class="col-lg-5 col-md-5">
                <div class="pro-large-img">
                  <img :src="umkmDetail ? umkmDetail.umkm.gambar : ''" alt="umkm-pic" />
                </div>
              </div>
              <div class="col-lg-7 col-md-7">
                <div class="product-details-des quick-details">
                  <h3 class="product-name">{{ umkmDetail ? umkmDetail.umkm.nama_umkm : "" }}</h3>
                  <p class="pro-desc">{{ umkmDetail ? umkmDetail.umkm.deskripsi : "" }}</p>
                </div>
              </div>
            </div>
          </div> <!-- product details inner end -->
        </div>
      </div>
    </div>
  </div>
  <!-- Quick view modal end -->

  <!-- PILIH CABANG -->
  <div class="modal" id="pilih-cabang">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <h1>Pilih cabang, dimana anda ingin berbelanja: </h1>
          <br>
          <div class="list-group">
            <a :href="`<?php echo e(route('konsumen.produk')); ?>?cabang=${cabang.cabang_id}`" class="list-group-item list-group-item-action" v-for="cabang in cabangs" :key="cabang.cabang_id"><b>{{ cabang.nama_cabang }}</b> <br> {{ cabang.alamat_cabang }}</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- PILIH CABANG -->
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra_script'); ?>
<!-- Page level plugins -->
<script>
  var vue_shop = new Vue({
    el: '#vue-shop',
    // components: {
    //   breadcrumb: $breadcrumb
    // },
    data() {
      return {
        umkm: [],
        cabangs: [],
        umkmDetail: null,
        sortKey: null,
      }
    },
    mounted() {
      //do something after mounting vue instance
      // console.log(this.$options.components);
    },
    created() {
      //do something after creating vue instance
      this.getUmkm();
    },
    methods: {
      getUmkm() {
        axios.get('umkm-konsumen').then((res) => {
          this.umkm = res.data;
        }).catch((err) => {
          console.log(err);
        })
      },

      pilihCabang(index_umkm) {
        this.cabangs = this.umkm[index_umkm].cabang;
        $('#pilih-cabang').modal('show');
      },

      showUmkmDetail(umkmId) {
        axios.get('umkm-konsumen/?umkm_id=' + umkmId).then((res) => {
          this.umkmDetail = res.data;
          console.log(this.umkmDetail);
          $('#quick_view').modal('show');
        }).catch((err) => {
          console.log(err);
          $helper.errorModal(err);
        })
      },

      sortUmkm() {
        switch (this.sortKey) {
          case 'name-asc':
            this.sortName('asc');
            break;
          case 'name-desc':
            this.sortName('desc');
            break;
        }
      },

      sortName(sortType) {
        if (sortType == 'asc') {
          this.umkm.sort(function(a, b) {
            if (a.umkm.nama_umkm < b.umkm.nama_umkm) {
              return -1;
            }
            if (a.umkm.nama_umkm > b.umkm.nama_umkm) {
              return 1;
            }
            return 0;
          });
        } else {
          this.umkm.sort(function(a, b) {
            if (a.umkm.nama_umkm < b.umkm.nama_umkm) {
              return 1;
            }
            if (a.umkm.nama_umkm > b.umkm.nama_umkm) {
              return -1;
            }
            return 0;
          });
        }
      },
    },

    watch: {
      sortKey: function(newVal, oldVal) {
        this.sortUmkm();
      }
    }
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('konsumen_app.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/izharauliataqwa/Documents/project/idukafix/resources/views/konsumen_app/shop/shop.blade.php ENDPATH**/ ?>