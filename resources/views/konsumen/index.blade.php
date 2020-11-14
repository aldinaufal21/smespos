<!DOCTYPE html>
<html lang="en">

<head>

  <title>SMEs - POS</title>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Google fonts include -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,900%7CYesteryear" rel="stylesheet">

  <!-- All Vendor & plugins CSS include -->
  <link href="{{ asset('konsumen_assets/css/vendor.css') }}" rel="stylesheet">
  <!-- Main Style CSS -->
  <link href="{{ asset('konsumen_assets/css/style.css') }}" rel="stylesheet">

</head>

<body>
  <div id="app">
      <app></app>
  </div>

  <script src="{{ asset('js/app.js')}}" defer></script>

  <!-- All vendor & plugins & active js include here -->
  <!--All Vendor Js -->
  <script src="{{ asset('konsumen_assets/js/vendor.js')}}" defer></script>
  <!-- Active Js -->
  <script src="{{ asset('konsumen_assets/js/active.js')}}" defer></script>

</body>

</html>
