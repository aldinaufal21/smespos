@extends('konsumen_app.layouts.app')

@section('title','User Profile')

@section('extra_head')
<!-- Custom styles for this page -->
<style media="screen">

</style>
@endsection

@section('content')
<!-- main wrapper start -->
<main id="profile-vue">
  <breadcrumb :title="'Profile'"></breadcrumb>

  <!-- my account wrapper start -->
  <div class="my-account-wrapper section-space pb-0">
    <div class="container">
      <div class="section-bg-color">
        <div class="row">
          <div class="col-lg-12">
            <!-- My Account Page Start -->
            <div class="myaccount-page-wrapper">
              <!-- My Account Tab Menu Start -->
              <div class="row">
                <div class="col-lg-3 col-md-4">
                  <div class="myaccount-tab-menu nav" role="tablist">
                    <a href="#account-info" class="active" data-toggle="tab"><i class="fa fa-user"></i> Account
                      Details</a>
                    <a href="#reset-password" data-toggle="tab"><i class="fa fa-key"></i> Password change</a>
                    <a href="#orders" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i>
                      Orders</a>
                    <a href="#address-edit" data-toggle="tab"><i class="fa fa-map-marker"></i>
                      address</a>
                    <a href="javascript:void(0)" onclick="logoutAction()"><i class="fa fa-sign-out"></i> Logout</a>
                  </div>
                </div>
                <!-- My Account Tab Menu End -->

                <!-- My Account Tab Content Start -->
                <div class="col-lg-9 col-md-8">
                  <div class="tab-content" id="myaccountContent">

                    <!-- Single Tab Content Start -->
                    <div class="tab-pane fade" id="orders" role="tabpanel">
                      <div class="myaccount-content">
                        <h3>Orders</h3>
                        <div class="myaccount-table table-responsive text-center">
                          <table class="table table-bordered">
                            <thead class="thead-light">
                              <tr>
                                <th>Order</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr v-for="(elem, i) in orders" :key="i">
                                <td>@{{ i+1 }}</td>
                                <td>@{{ elem.tanggal_transaksi }}</td>
                                <td>@{{ elem.status }}</td>
                                <td>Rp @{{ rupiahFormat(elem.total_biaya) }}</td>
                                <td v-html="getOrderAction(elem.status, elem.transaksi_konsumen_id)"></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <!-- Single Tab Content End -->

                    <!-- Single Tab Content Start -->
                    <div class="tab-pane fade" id="address-edit" role="tabpanel">
                      <div class="myaccount-content">
                        <h3>Billing Address</h3>
                        <a href="#" class="btn btn__bg btn-success" v-if="!address.length" @click="addNewAddress"><i class="fa fa-edit"></i>Add New Address</a>
                        <address v-for="item in address" :key="item.alamat_pengiriman_id">
                          {{-- <p v-text="item.alamat"></p> --}}
                          <textarea name="name" v-model="item.alamat" rows="4" cols="70"></textarea><br>
                          <a href="#" class="btn btn__bg" @click="editAlamat(item)"><i class="fa fa-edit"></i>Edit Address</a>
                          <hr>
                        </address>
                      </div>
                    </div>
                    <!-- Single Tab Content End -->

                    <!-- Single Tab Content Start -->
                    <div class="tab-pane fade show active" id="account-info" role="tabpanel">
                      <div class="myaccount-content">
                        <h3>Account Details</h3>
                        <div class="account-details-form">
                          <form @submit="changeProfileActionForm" enctype="multipart/form-data">
                            <div class="row">
                              <div class="col-lg-6">
                                <div class="single-input-item">
                                  <label for="first-name" class="required">Nama</label>
                                  <input type="text" v-model="profile_detail.nama_konsumen" placeholder="Nama" />
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="single-input-item">
                                  <label for="last-name" class="required">No Telpon</label>
                                  <input type="text" v-model="profile_detail.nomor_hp" placeholder="No Telpon" />
                                </div>
                              </div>
                            </div>
                            <div class="single-input-item">
                              <label for="display-name" class="required">Alamat</label>
                              <input type="text" v-model="profile_detail.alamat_konsumen" placeholder="Alamat" />
                            </div>
                            <!-- <div class="single-input-item">
                              <label for="avatar" class="required">Avatar</label>
                              <input type="file" @change="imageSelect($event)" accept="image/*" placeholder="Gambar" />
                            </div> -->
                            <div class="single-input-item">
                              <label for="username" class="required">Username</label>
                              <input type="text" v-model="profile_detail.username" placeholder="Username" readonly />
                            </div>
                            <div class="single-input-item">
                              <button class="btn btn__bg">Save Changes</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div> <!-- Single Tab Content End -->

                    <!-- Single Tab Content Start -->
                    <div class="tab-pane fade" id="reset-password" role="tabpanel">
                      <div class="myaccount-content">
                        {{-- <h3>Reset Password</h3> --}}
                        <div class="account-details-form">
                          <form @submit="changePasswordActionForm">
                            <fieldset>
                              <legend>Password change</legend>
                              <div class="single-input-item">
                                <label for="current-pwd" class="required">Password lama</label>
                                <input type="password" v-model="password_changes.existing_password" id="current-pwd" placeholder="Current Password" />
                              </div>
                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="single-input-item">
                                    <label for="new-pwd" class="required">Password Baru</label>
                                    <input type="password" v-model="password_changes.new_password" id="new-pwd" placeholder="New Password" />
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="single-input-item">
                                    <label for="confirm-pwd" class="required">Konfirmasi Password Baru</label>
                                    <input type="password" v-model="password_changes.new_password_confirmation" id="confirm-pwd" placeholder="Confirm Password" />
                                  </div>
                                </div>
                              </div>
                            </fieldset>
                            <div class="single-input-item">
                              <button class="btn btn__bg">Save Changes</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div> <!-- Single Tab Content End -->
                  </div>
                </div> <!-- My Account Tab Content End -->
              </div>
            </div> <!-- My Account Page End -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- my account wrapper end -->
</main>
<!-- main wrapper end -->
@endsection

@section('extra_script')
<!-- Page level plugins -->
<script>
  $auth.needAuthentication();

  var vue_profile = new Vue({
    el: '#profile-vue',
    data() {
      return {
        profile_detail: {
          nama_konsumen: '',
          nomor_hp: '',
          alamat_konsumen: '',
          username: ''
        },
        password_changes: {
          existing_password: '',
          new_password: '',
          new_password_confirmation: '',
        },
        orders: [],
        address: []
      }
    },
    mounted() {
      //do something after mounting vue instance
    },
    created() {
      //do something after creating vue instance
      this.getUserDetails();
      this.getAddress();
      this.getOrders();
    },
    methods: {
      getUserDetails() {
        profileStore.getProfile()
          .then((res) => {
            // console.log(res);
            this.profile_detail = res.data;
          })
      },

      getAddress() {
        axios.get('consumer/addresses').then((res) => {
          // console.log(res);
          this.address = res.data;
        }).catch((err) => {
          console.log(err);
          $helper.errorModal(err);
        })
      },

      getOrders() {
        axios.get('getTransaksiKonsumen').then((res) => {
          // console.log(res);
          this.orders = res.data;
        }).catch((err) => {
          console.log(err);
          $helper.errorModal(err);
        })
      },

      getOrderAction(status, transaksi_id) {
        if (status == 'belum_bayar') {
          return `<a href="${ $baseURL + '/payment?id=' + transaksi_id }" class="btn btn__bg">View</a>`;
        } else {
          return '';
        }
      },

      imageSelect(e) {
        this.profile_detail.gambar = e.target.files[0];
      },

      changeProfileActionForm(e) {
        $.LoadingOverlay("show");
        e.preventDefault();

        let payload = {
          data: {
            nama_konsumen: this.profile_detail.nama_konsumen,
            nomor_hp: this.profile_detail.nomor_hp,
            alamat_konsumen: this.profile_detail.alamat_konsumen,
          }
        }

        profileStore.updateProfile(payload)
          .then((res) => {
            // console.log(res.data);
            this.profile_detail = res.data;
          }).finally(()=>{
            $.LoadingOverlay("hide");
          });
      },

      changePasswordActionForm(e) {
        $.LoadingOverlay("show");
        e.preventDefault();

        let payload = {
          data: this.password_changes
        }

        profileStore.updatePassword(payload)
          .then((res) => {
            this.password_changes.existing_password = '';
            this.password_changes.new_password = '';
            this.password_changes.new_password_confirmation = '';
          }).finally(()=>{
            $.LoadingOverlay("hide");
          });
      },

      editAlamat(addres){
        const payload = {
            alamat: addres.alamat,
        };

        axios.patch('consumer/addresses/' + addres.alamat_pengiriman_id, payload).then((res)=>{
          console.log(res);
          this.getAddress();
          swal({
            icon: "success",
            title: "Berhasil mengubah alamat."
          });
        }).catch((err)=>{
          console.log(err);
          $helper.errorModal(err);
        })
      },

      addNewAddress(){
        swal({
          content: {
            element: "input",
            attributes: {
              placeholder: "Masukan alamt baru",
              type: "text",
            },
          },
        }).then((alamat)=>{
          const payload = {
              alamat: alamat,
          };

          axios.post('consumer/addresses', payload).then((res)=>{
            this.getAddress();
            swal({
              icon: "success",
              title: "Berhasil menambahkan alamat baru."
            });
          }).catch((err)=>{
            console.log(err);
            $helper.errorModal(err);
          })
        });
      },

      rupiahFormat(value){
        return $helper.rupiahFormat(value);
      },

    }
  });
</script>
@endsection
