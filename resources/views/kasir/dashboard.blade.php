@extends('layouts.app')

@section('title','Dashboard Kasir')

@section('extra_head')
<!-- Custom styles for this page -->
<style media="screen">
  #content{
    background-color:#f2f2f2;
  }
</style>
@endsection

@section('content')
  <div class="container-fluid" id="kasir-dashboard-content">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard Kasir</h1>
      <br>
      {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <div class="row">
      <div class="card shadow col-xl-5 col-md-12 mb-12">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Kasir Info</h6>
        </div>
        <div class="card-body">
          <p>Hi <b v-text="userData.kasir.nama_kasir"></b>,</p>
          <div class="row">
            <div class="col-md-6">
              <img width="100%" class="rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
            </div>
            <div class="col-md-6">
              <p>Nama Toko: <b v-text="userData.cabang.nama_cabang"></b></p>
              <p>Alamat Toko: <b v-text="userData.cabang.alamat_cabang"></b></p>
              <p>Status Kasir:
                <span v-if="userData.kasir.status_kasir == 'tutup'" style="color:red">Tutup</span>
                <span v-else="userData.kasir.status_kasir == 'buka'" style="color:#1cc88a">Buka</span>
              </p>
              <button v-if="userData.kasir.status_kasir == 'tutup'"
                      class="d-none d-sm-inline-block btn btn-lg btn-success shadow-sm"
                      type="button"
                      @click="bukaKasir">
                      Buka Kasir</button>
              <button v-else="userData.kasir.status_kasir == 'buka'"
                      class="d-none d-sm-inline-block btn btn-lg btn-danger shadow-sm"
                      type="button"
                      @click="tutupKasir">
                      Tutup Kasir</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>

    <!-- Content Row -->
    <div class="row">

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-4 col-md-12 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Transaksi</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">23</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-4 col-md-12 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Income</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-4 col-md-12 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <a href="/kasir/transaksi-pending" style="text-decoration: none;">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Transaksi Pending</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800" v-text="pendingTransaction.length"></div>
                </a>
              </div>
              <div class="col-auto">
                <i class="fas fa-clock fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('extra_script')
<!-- Page level plugins -->
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>

<script>
  $auth.needRole(['kasir']);
  var user = $auth.userCredentials();

  var vue_dashboard_kasir = new Vue({
    el: '#kasir-dashboard-content',
    data(){
      return {
        userData: user,
        pendingTransaction: []
      }
    },

    mounted() {
      //do something after mounting vue instance
      console.log(this.userData);
      this.pendingTransaction = pendingTransaction.getAll();
    },

    methods: {
      bukaKasir(){
        $swal({
          title: 'Apakah yakin ingin membuka kasir?',
          buttons: ["Tidak", "Ya!"],
        }).then((answer)=>{
          if (answer) {
            console.log("kasir dibuka");
            cashierStore.openCashier({
              kasir_id: this.userData.kasir.kasir_id
            })
          }
        });
      },

      tutupKasir(){
        $swal({
          title: 'Apakah yakin ingin menutup kasir?',
          buttons: true,
          dangerMode: true,
        }).then((answer)=>{
          if (answer) {
            console.log("kasir ditutup");
            cashierStore.closeCashier({
              kasir_id: this.userData.kasir.kasir_id,
              sesi_kasir_id: this.userData.sesi_kasir.sesi_kasir_id
            })
          }
        });
      },
    }
  });

</script>
@endsection
