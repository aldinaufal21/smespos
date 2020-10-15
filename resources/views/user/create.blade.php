@extends('layouts.app')

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add New User</h1>
  </div>

  <div class="card shadow mb-4">
    <div class="card-body">
      <form>
        <div class="form-group row">
          <label for="js-input-username" class="col-sm-2 col-form-label">Username</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="js-input-username" placeholder="Username">
          </div>
        </div>
        <div class="form-group row">
          <label for="js-input-password" class="col-sm-2 col-form-label">Password</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="js-input-password" placeholder="Password">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-10 offset-2">
            <button type="submit" class="btn btn-primary float-right">Add</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection