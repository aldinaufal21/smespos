<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\TransaksiKasir;
use App\TransaksiKasirDetail;
use App\SesiKasir;
use App\Produk;
use App\Kasir;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class KasirTransactionController extends Controller
{
    public function index(Request $request)
    {

    }

    public function store(Request $request)
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'kasir_id' => 'required',
            'metode_bayar' => 'required',
            'total_bayar' => 'required',
            'produk' => 'required|array|min:1',
            'produk.*.produk_id' => 'required',
            'produk.*.jumlah' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $total_harga = 0;
        foreach ($requestData['produk'] as $key => $value) {
            $total_harga += $requestData['produk'][$key]['harga'] = Produk::getProductDetailById($value['produk_id'])->harga * $value['jumlah'];
        }

        $requestData['tanggal_transaksi'] = Carbon::now();
        $requestData['total_harga'] = $total_harga;


        DB::beginTransaction();
        try {

            $order = TransaksiKasir::create($requestData);

            foreach ($requestData['produk'] as $key => $value) {
                $requestData['produk'][$key]['transaksi_kasir_id'] = $order->transaksi_kasir_id;
                $requestData['produk'][$key]['harga'] = Produk::getProductDetailById($value['produk_id'])->harga;
            }

            $orderDetail = TransaksiKasirDetail::insert($requestData['produk']);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => env('APP_ENV') != 'production' ? "Error ".$e : 'Internal Server Error',
            ], 500);
        }

        $this->printReceipt($order->transaksi_kasir_id);
        return response()->json($order, 201);
    }

    public function bukaKasir(Request $request){
      $requestData = $request->all();

      $validator = Validator::make($requestData, [
          'kasir_id' => 'required',
      ]);

      if ($validator->fails()) {
          return response()->json([
              'errors' => $validator->errors()->all()
          ], 400);
      }

      $requestData['waktu_mulai'] = Carbon::now();
      $requestData['waktu_selesai'] = NULL;

      DB::beginTransaction();
      try {
          $order = SesiKasir::create($requestData);
          $kasir = Kasir::where('kasir_id', $requestData['kasir_id'])->update(array(
            'status_kasir' => 'buka'
          ));

          DB::commit();
      } catch (\Exception $e) {
          DB::rollback();
          return response()->json([
              'message' => env('APP_ENV') != 'production' ? "Error ".$e : 'Internal Server Error',
          ], 500);
      }

      return response()->json($order, 201);
    }

    public function tutupKasir(Request $request){
      $requestData = $request->all();

      $validator = Validator::make($requestData, [
          'kasir_id' => 'required',
      ]);

      if ($validator->fails()) {
          return response()->json([
              'errors' => $validator->errors()->all()
          ], 400);
      }

      $requestData['waktu_selesai'] = Carbon::now();

      DB::beginTransaction();
      try {
          $sesi = SesiKasir::where('sesi_kasir_id', $requestData['sesi_kasir_id'])->update($requestData);
          $kasir = Kasir::where('kasir_id', $requestData['kasir_id'])->update(array(
            'status_kasir' => 'tutup'
          ));

          DB::commit();
      } catch (\Exception $e) {
          DB::rollback();
          return response()->json([
              'message' => env('APP_ENV') != 'production' ? "Error ".$e : 'Internal Server Error',
          ], 500);
      }

      return response()->json("Tutup kasir berhasil", 201);
    }

    public function testQuery(){
      $data = TransaksiKasir::where('transaksi_kasir_id', 20)->first();
      // $data = Kasir::where('kasir_id', 1)->first()->cabang()->first();
      // $data = TransaksiKasirDetail::join('produks','transaksi_kasir_details.produk_id', '=', 'produks.produk_id')->where('transaksi_kasir_id', 20)->get();
      print_r($data);
    }

    public function printReceipt($id_transaksi){
      try {
          $transaksi = TransaksiKasir::where('transaksi_kasir_id', $id_transaksi)->first();
          $produk = TransaksiKasirDetail::join('produks','transaksi_kasir_details.produk_id', '=', 'produks.produk_id')
                                          ->where('transaksi_kasir_id', $id_transaksi)->get();
          $kasir = Kasir::where('kasir_id', $transaksi->kasir_id)->first();
          $cabang = $kasir->cabang()->first();

          // Enter the share name for your USB printer here
          $connector = new WindowsPrintConnector("POS-58");
          // $connector = new WindowsPrintConnector("smb://yourPrinterIP");
          $printer = new Printer($connector);
          /* Name of shop */
          // membuat fungsi untuk membuat 1 baris tabel, agar dapat dipanggil berkali-kali dgn mudah
          function buatBaris4Kolom($kolom1, $kolom2, $kolom3, $kolom4) {
              // Mengatur lebar setiap kolom (dalam satuan karakter)
              $lebar_kolom_1 = 10;
              $lebar_kolom_2 = 5;
              $lebar_kolom_3 = 6;
              $lebar_kolom_4 = 8;

              // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n
              $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
              $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
              $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);
              $kolom4 = wordwrap($kolom4, $lebar_kolom_4, "\n", true);

              // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
              $kolom1Array = explode("\n", $kolom1);
              $kolom2Array = explode("\n", $kolom2);
              $kolom3Array = explode("\n", $kolom3);
              $kolom4Array = explode("\n", $kolom4);

              // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
              $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array), count($kolom4Array));

              // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
              $hasilBaris = array();

              // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris
              for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {

                  // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan,
                  $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
                  $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ");

                  // memberikan rata kanan pada kolom 3 dan 4 karena akan kita gunakan untuk harga dan total harga
                  $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_LEFT);
                  $hasilKolom4 = str_pad((isset($kolom4Array[$i]) ? $kolom4Array[$i] : ""), $lebar_kolom_4, " ", STR_PAD_LEFT);

                  // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
                  $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3 . " " . $hasilKolom4;
              }

              // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
              return implode("\n", $hasilBaris) . "\n";
          }

          // Membuat judul
          $printer->initialize();
          //$printer->selectPrintMode(Printer::MODE_DOUBLE_HEIGHT); // Setting teks menjadi lebih besar
          $printer->setJustification(Printer::JUSTIFY_CENTER); // Setting teks menjadi rata tengah
    	    $printer->setPrintLeftMargin(10);
          $printer->text("$cabang->nama_cabang \n");
          $printer->text("\n");

          // Data transaksi
          $printer->initialize();
          $printer->text("Kasir : $kasir->nama_kasir \n");
          $printer->text("Waktu : $transaksi->tanggal_transaksi \n");

          // Membuat tabel
          $printer->initialize(); // Reset bentuk/jenis teks
          $printer->text("-------------------------------\n");
          $printer->text(buatBaris4Kolom("Barang", "qty", "Harga", "Subtotal"));
          $printer->text("-------------------------------\n");

          // items start
          foreach ($produk as $key => $value) {
            $printer->text($value->nama_produk."\n");
            $printer->text(buatBaris4Kolom('', $value->jumlah."x", number_format($value->harga), number_format($value->harga*$value->jumlah)));
            if ($key != count($produk)-1) {
              $printer->text("\n");
            }
          }
          // $printer->text(buatBaris4Kolom("Makaroni 250gr", "2pcs", "15.000", "30.000"));
          // $printer->text(buatBaris4Kolom("Telur", "2pcs", "5.000", "10.000"));
          // $printer->text(buatBaris4Kolom("Tepung terigu", "2pcs", "8.200", "16.400"));

          // total
          $printer->text("-------------------------------\n");
          $printer->text(buatBaris4Kolom("Total", '', '',  number_format($transaksi->total_harga)));
          $printer->text(buatBaris4Kolom("Pembayaran", '', '',  $transaksi->metode_bayar));
          $printer->text(buatBaris4Kolom("Bayar", '', '',  number_format($transaksi->total_bayar)));
          $printer->text(buatBaris4Kolom("Kembali", '', '',  number_format($transaksi->total_bayar - $transaksi->total_harga)));
          $printer->text("\n");

           // Pesan penutup
          $printer->initialize();
          $printer->setJustification(Printer::JUSTIFY_CENTER);
          $printer->text("Terima kasih telah berbelanja.\n");
          $printer->text($cabang->alamat_cabang);

          $printer->feed(4); // mencetak 5 baris kosong agar terangkat (pemotong kertas saya memiliki jarak 5 baris dari toner)

          /* Cut the receipt and open the cash drawer */
          // $printer->cut();
          $printer->pulse();
          /* Close printer */
          $printer->close();
          // echo "Sudah di Print";
          // return "printed";
          return true;
      } catch (Exception $e) {
          $message = "Couldn't print to this printer: " . $e->getMessage() . "\n";
          return false;
          // return $message;
      }
    }

}
