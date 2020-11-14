<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Document</title>
  <style>
    .page-break {
      page-break-after: always;
    }
  </style>
</head>

<body>
  <h2>Laporan Penjualan {{ $nama_umkm }}</h2>
  @isset($nama_cabang)
    <h3>Cabang {{ $nama_cabang }}</h3>
  @endisset

  <hr>
  @foreach ($reports as $report)
    <h3>Laporan Penjualan Bulan {{ $report['month'] }}</h3>
    <table class="table table-bordered" style="width:100%">
      <tr>
        <th style="width: 10%;">Nomor</th>
        <th style="width: 45%;">Produk</th>
        <th style="width: 15%;">Harga</th>
        <th style="width: 15%;">Jumlah Terjual</th>
        <th style="width: 15%;">Total Keuntungan</th>
      </tr>
      @foreach ($report['data'] as $index => $data)
        <tr>
          <td>{{ ($index + 1) }}</td>
          <td>{{ $data['nama_produk'] }}</td>
          <td>{!! Helper::toRupiah($data['harga']) !!}</td>
          <td>{{ $data['jumlah'] }}</td>
          <td>{!! Helper::toRupiah($data['total_harga']) !!}</td>
        </tr>
      @endforeach
      <tr>
        <th colspan="3">Sub Total</th>
        <th>{{ $report['profit']->jumlah_terjual }}</th>
        <th>{!! Helper::toRupiah($report['profit']->total_keuntungan) !!}</th>
      </tr>
    <table>
    <div class="page-break"></div>
  @endforeach 

</body>

</html>