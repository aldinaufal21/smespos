@extends('layouts.app')

@section('extra_head')
<!-- Custom styles for this page -->
<style media="screen">
  #content{
    background-color:#f2f2f2;
  }

  li.transaction-action{
      padding-top:3px;
      padding-bottom:3px;
  }

  .transaction-action button{
      display:block;
      width:100%;
  }

  .center-modal{
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
  }
</style>
@endsection

@section('content')
  <div class="container-fluid" id="transaksi-kasir-content">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Kasir</h1>
      <br>
    </div>

    <div class="row">
      <!-- Product list section start -->
      <div class="col-md-7">
        <div class="row">
          <div class="col-md-6">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-3 small" placeholder="Cari Barang..." aria-label="Search" aria-describedby="basic-addon2" @keyup="searchProduct">
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
            <button type="button"
                    class="d-none d-sm-inline-block btn btn-sm shadow-sm "
                    v-bind:class="{ 'btn-success': selectedCategory == elem.kategori_produk_id }"
                    v-for="elem in category"
                    :key="elem.kategori_produk_id"
                    v-text="elem.nama_kategori"
                    @click="changeTab(elem.kategori_produk_id)"
                    style="margin-right: 5px"></button>
            <br><br>
          </div>
            <div class="col-md-4" v-for="product in filteredProducts" :key="product.produk_id">
              <div class="card" style="margin-bottom:20px;">
                <img :src="`https://loremflickr.com/320/240/snack?lock=${product.produk_id}`" class="card-img-top" alt="...">
                <div class="card-body center">
                  <center>
                  <h6 class="card-title" v-text="product.nama_produk"></h6>
                  <h4 class="card-text">Rp <b v-text="rupiahFormat(product.harga)"></b></h4>
                  <button type="button" class="btn btn-success" @click="addToCart(product)">+ Tambah Keranjang</button>
                  <center>
                </div>
              </div>
            </div>
        </div>
      </div>
      <!-- Product list section end -->
      <div class="col-md-5 sticky-top" id="resume-section">
        <div class="card shadow mb-12" id="sticky-section">
          <div class="card-header py-3">
            <center><h3 class="m-0 font-weight-bold text-primary">Total Barang</h3></center>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <p v-if="!cart.length">Keranjang Kosong</p>
              <li class="list-group-item" v-for="elem in cart" :key="elem.produk_id">
                <h5><b v-text="elem.nama_produk"></b></h5>
                <div class="row">
                  <div class="col-md-2">
                    {{-- <button type="button" class="d-none d-sm-inline-block btn btn-sm shadow-sm btn-primary" style="width:40%;" title="Kurang" @click="subtractQuantity(elem.produk_id)"><i class="fas fa-minus"></i></button> --}}
                    <button type="button" class="d-none d-sm-inline-block btn btn-sm shadow-sm btn-danger"  title="hapus" @click="deleteItem(elem.produk_id)"><i class="fas fa-trash"></i></button>
                  </div>
                  <div class="col-md-3">
                    <input type="number" class="form-control bg-light border-3 large" style="width:100%;" min="1" :value="elem.quantity" @keyup="changeQuantity($event, elem.produk_id)" @change="changeQuantity($event, elem.produk_id)">
                  </div>
                  <div class="col-md-3">
                    <center>@<b v-text="rupiahFormat(elem.harga)"></b></center>
                  </div>
                  <div class="col-md-4">
                    <center>Rp <b v-text="rupiahFormat(elem.harga * elem.quantity)"></b></center>
                  </div>
                </div>
              </li>
              <li class="list-group-item" v-if="cart.length">
                <h4>Total (<span v-text="cart.length"></span> item)<span style="float:right">Rp <b v-text="rupiahFormat(subtotal)"></b></span></h4>
              </li>
              <li class="list-group-item transaction-action">
                  <button type="button" :disabled="!cart.length" class="d-none d-sm-inline-block btn btn-lg shadow-sm btn-success" @click="checkout" title="Bayar">Bayar</button>
              </li>
              <li class="list-group-item transaction-action">
                  <button type="button" :disabled="!cart.length" class="d-none d-sm-inline-block btn btn-lg shadow-sm btn-danger" @click="resetCart" title="Batalkan Transaksi">Batalkan</button>
              </li>
              <li class="list-group-item transaction-action">
                  <button type="button" :disabled="!cart.length" class="d-none d-sm-inline-block btn btn-lg shadow-sm btn-warning" @click="newCart" title="Buat Transaksi baru">Transaksi Baru</button>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Pembayaran start -->
  <div class="modal fade" id="modal-pembayaran" tabindex="-1" role="dialog" aria-labelledby="kasirModal" aria-hidden="true">
    <div class="modal-dialog modal-lg center-modal" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="kasirModal">Kasir Detail</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Page Content -->
          <div class="container">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                Cash
                bsandbahjsdkashjbdkhjasbhdkjahsjk
              </li>
              <li class="list-group-item">
                Debit
              </li>
              <li class="list-group-item">
                Qris
              </li>
            </ul>
          </div>
          <!-- /.container -->
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Pembayaran end -->
@endsection

@section('extra_script')
<!-- Page level plugins -->
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>

<script>
  let user = $auth.userCredentials();

  var vue_kasir = new Vue({
    el: '#transaksi-kasir-content',
    data (){
      return{
        authData: user,
        category: null,
        products: null,
        filteredProducts: null,
        selectedCategory: 0,
        searchedProduct: '',
        cart: [],
        subtotal: 0,
        continue: null
      }
    },

    mounted() {
      //do something after mounting vue instance
      const urlParams = new URLSearchParams(window.location.search);
      const pending_id = urlParams.get('continue'); //return pending_id or null

      if (pendingTransaction.isValidId(pending_id)) {
          this.cart = pendingTransaction.getItem(pending_id).cart_items;
          this.continue = pending_id;
          this.calculateSubtotal();
      }
    },

    created() {
      //do something after creating vue instance
      this.getAllProduct();
      this.getKategori();
    },

    methods: {
      getKategori() {
        categoryStore.UmkmsCategory(this.authData.umkm_id).then((res) => {
          // console.log(res.data);
          this.category = res.data;
          this.category.unshift({
            kategori_produk_id: 0,
            nama_kategori: "All",
          });
        });
      },

      getAllProduct(){
        productStore.UmkmsProduct(this.authData.umkm_id).then((res) => {
          // console.log(res.data);
          this.products = res.data;
          this.filteredProducts = this.products;
        });
      },

      addToCart(produk){
        let index = this.cart.findIndex(cartItem => cartItem.produk_id == produk.produk_id)
        if (index == -1) {
          // insert new item
          let item = {
              produk_id: produk.produk_id,
              nama_produk: produk.nama_produk,
              harga: produk.harga,
              quantity: 1
          }

          this.cart.push(item)
        }else {
          // quantity plus 1
          this.cart[index].quantity++
        }
        this.calculateSubtotal();
      },

      subtractQuantity(produk_id){
        let index = this.cart.findIndex(cartItem => cartItem.produk_id == produk_id)
        if (index != -1) {
          if (this.cart[index].quantity > 1) {
            this.cart[index].quantity--
          }
        }
        this.calculateSubtotal();
      },

      changeQuantity(event, produk_id){
        let index = this.cart.findIndex(cartItem => cartItem.produk_id == produk_id)
        if (index != -1) {
          if (event.target.value) {
            this.cart[index].quantity = event.target.value;
          }
        }
        this.calculateSubtotal();
      },

      deleteItem(produk_id){
        let index = this.cart.findIndex(cartItem => cartItem.produk_id == produk_id)
        if (index != -1) {
            this.cart.splice(index, 1)
        }
        this.calculateSubtotal();
      },

      calculateSubtotal(){
        let sum = 0;

        for (var item of this.cart) {
          sum += item.harga * item.quantity;
        }

        this.subtotal = sum;
      },

      resetCart(){
        $swal({
            title: "Anda yakin?",
            text: `Transaksi akan dibatalkan!`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              if (this.continue) {
                window.location.href = '/kasir/transaksi'; // reset url
              }

              this.cart = [];
            }
          });
      },

      checkout(){
        console.log("tes");
        $('#modal-pembayaran').modal('show');
      },

      newCart(){
        $swal({
            title: "Anda yakin ingin membuat transaksi baru?",
            text: `Transaksi ini akan tetap disimpan di transaksi pending!`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              this.addToPendingCart();
              this.cart = [];
              if (this.continue) {
                // reset url
                window.location.href = '/kasir/transaksi';
              }
            }
          });
      },

      addToPendingCart(){
        if (this.continue) {
          // if pending the continued cart
          // remove and replace it with new one
          pendingTransaction.remove(this.continue);
        }

        const payload = {
          pending_id: new Date().getTime(),
          cart_items: this.cart,
          tanggal_transaksi: new Date(),
          kasir: this.authData.kasir,
          username: this.authData.user.kasir
        };

        pendingTransaction.store(payload);
      },

      changeTab(id_kategori){
        // console.log(id_kategori);
        this.selectedCategory = id_kategori;
        this.doFilterProduct();
      },

      searchProduct(event){
        this.searchedProduct = event.target.value.toLowerCase();
        this.doFilterProduct();
      },

      doFilterProduct(){
        let dataToFilter = this.products;

        if (this.selectedCategory != 0) {
            dataToFilter = dataToFilter.filter(produk => produk.kategori_produk_id == this.selectedCategory);
        }

        if (this.searchedProduct != '') {
            dataToFilter = dataToFilter.filter((product)=>{
              return product.nama_produk.toLowerCase().includes(this.searchedProduct) ||
                     product.harga.toString().includes(this.searchedProduct) ||
                     product.nama_kategori.toLowerCase().includes(this.searchedProduct);
            });
        }

        this.filteredProducts = dataToFilter;
      },

      rupiahFormat(value) {
        let val = (value/1);
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
      },

    }
  });


  /*
    handle sticky section
  */
  window.onscroll = function() {myFunction()};

  var _isSticky = false;

  function myFunction() {
    if (window.pageYOffset >= 100 && !($('#sticky-section').height()>=window.innerHeight)) {
      if (!_isSticky) {
        if ($(window).scrollTop() >= $('#sticky-section').offset().top + $('#sticky-section').outerHeight() - window.innerHeight) {
          $('#sticky-section').css('position', 'fixed');
          var parentwidth = $("#resume-section").width();
          $('#sticky-section').width(parentwidth);
          $('#sticky-section').css('top', 20);
          _isSticky = true
        }
      }
    } else {
      if (_isSticky) {
        $('#sticky-section').css('position', 'relative');
        _isSticky = false;
      }
    }
  }

</script>
@endsection
