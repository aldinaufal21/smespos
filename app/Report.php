<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Report extends Model
{
    public static function getTransaksiKasirReport($cabangId = null, $umkmId = null, $beforeDate = null, $afterDate = null)
    {
        $dateCondition = [];
        $whereCondition = '';

        if ($beforeDate) {
            array_push($dateCondition, ' (MONTH(tk.tanggal_transaksi) >= MONTH(\''. $beforeDate .'\') AND YEAR(tk.tanggal_transaksi) >= YEAR(\''. $beforeDate .'\')) ');
        }

        if ($afterDate) {
            array_push($dateCondition, ' (MONTH(tk.tanggal_transaksi) <= MONTH(\''. $afterDate .'\') AND YEAR(tk.tanggal_transaksi) <= YEAR(\''. $afterDate .'\')) ');
        }

        if (count($dateCondition) > 0) {
            $whereCondition .= 'WHERE';
            $condition = join("OR",$dateCondition);
            $whereCondition .= $condition;
        }

        /**
         * code above will produce where clause like this
         * 
         * WHERE (MONTH(tk.tanggal_transaksi) >= MONTH('2020-10-12') AND YEAR(tk.tanggal_transaksi) >= YEAR('2020-10-12')) 
         * OR (MONTH(tk.tanggal_transaksi) <= MONTH('2020-11-12') AND YEAR(tk.tanggal_transaksi) <= YEAR('2020-11-12'))
         */

        $sql = "
        SELECT 
            tkd.produk_id, 
            SUM(tkd.jumlah)      AS jumlah,
            SUM(tkd.jumlah * p.harga ) AS total_harga,
            tk.tanggal_transaksi AS tanggal_transaksi,
            c2.cabang_id,
            c2.umkm_id 
        FROM transaksi_kasir_details tkd 
        LEFT JOIN transaksi_kasirs tk ON tk.transaksi_kasir_id = tkd.transaksi_kasir_id 
        LEFT JOIN kasirs k2 ON k2.kasir_id = tk.kasir_id
        LEFT JOIN cabangs c2 ON c2.cabang_id = k2.cabang_id 
        LEFT JOIN produks p ON p.produk_id = tkd.produk_id 
        $whereCondition
        GROUP BY MONTH(tk.tanggal_transaksi), YEAR(tk.tanggal_transaksi), tkd.produk_id
        ";

        $produk = DB::table('produks')
                    ->join('kategori_produks', 'kategori_produks.kategori_produk_id', '=', 'produks.kategori_produk_id')
                    ->join('umkms', 'umkms.umkm_id', '=', 'kategori_produks.umkm_id')
                    ->leftJoin(DB::raw('('.$sql.') as tr'), 'tr.produk_id', '=', 'produks.produk_id')
                    ->selectRaw('
                        produks.*, 
                        kategori_produks.nama_kategori, 
                        COALESCE(tr.jumlah, 0) as jumlah,
                        COALESCE(tr.total_harga, 0) as total_harga,
                        tr.tanggal_transaksi'
                    );

        if ($cabangId){
            $produk->where('tr.cabang_id', $cabangId);
            $produk->orWhereNotNull('produks.produk_id');
        }

        if ($umkmId){
            $produk->where('tr.umkm_id', $umkmId);
            $produk->orWhereNotNull('produks.produk_id');
        }

        return $produk->get();
    }
    
    public static function getTransaksiKonsumenReport($umkmId = null, $beforeDate = null, $afterDate = null)
    {
        $dateCondition = [];
        $whereCondition = '';

        if ($beforeDate) {
            array_push($dateCondition, ' (MONTH(tk.tanggal_transaksi) >= MONTH(\''. $beforeDate .'\') AND YEAR(tk.tanggal_transaksi) >= YEAR(\''. $beforeDate .'\')) ');
        }

        if ($afterDate) {
            array_push($dateCondition, ' (MONTH(tk.tanggal_transaksi) <= MONTH(\''. $afterDate .'\') AND YEAR(tk.tanggal_transaksi) <= YEAR(\''. $afterDate .'\')) ');
        }

        if (count($dateCondition) > 0) {
            $whereCondition .= 'WHERE';
            $condition = join("OR",$dateCondition);
            $whereCondition .= $condition;
        }

        /**
         * code above will produce where clause like this
         * 
         * WHERE (MONTH(tk.tanggal_transaksi) >= MONTH('2020-10-12') AND YEAR(tk.tanggal_transaksi) >= YEAR('2020-10-12')) 
         * OR (MONTH(tk.tanggal_transaksi) <= MONTH('2020-11-12') AND YEAR(tk.tanggal_transaksi) <= YEAR('2020-11-12'))
         */

        $sql = "
        SELECT 
            tkd.produk_id, 
            SUM(tkd.jumlah)      AS jumlah,
            SUM(tkd.jumlah * p.harga ) AS total_harga,
            tk.tanggal_transaksi AS tanggal_transaksi,
            u2.umkm_id 
        FROM transaksi_konsumen_details tkd 
        LEFT JOIN transaksi_konsumens tk  ON tk.transaksi_konsumen_id = tkd.transaksi_konsumen_id
        LEFT JOIN produks p ON p.produk_id = tkd.produk_id 
        LEFT JOIN kategori_produks kp ON kp.kategori_produk_id = p.kategori_produk_id 
        LEFT JOIN umkms u2 ON u2.umkm_id = kp.kategori_produk_id 
        $whereCondition
        GROUP BY MONTH(tk.tanggal_transaksi), YEAR(tk.tanggal_transaksi), tkd.produk_id
        ";

        $produk = DB::table('produks')
                    ->join('kategori_produks', 'kategori_produks.kategori_produk_id', '=', 'produks.kategori_produk_id')
                    ->join('umkms', 'umkms.umkm_id', '=', 'kategori_produks.umkm_id')
                    ->leftJoin(DB::raw('('.$sql.') as tr'), 'tr.produk_id', '=', 'produks.produk_id')
                    ->selectRaw('
                        produks.*, 
                        kategori_produks.nama_kategori, 
                        COALESCE(tr.jumlah, 0) as jumlah,
                        COALESCE(tr.total_harga, 0) as total_harga,
                        COALESCE(tr.tanggal_transaksi, 0) as tanggal_transaksi'
                    );

        if ($umkmId){
            $produk->where('tr.umkm_id', $umkmId);
            $produk->orWhereNotNull('produks.produk_id');
        }

        return $produk->get();
    }
    
    public static function getAllTransaksiReport($umkmId = null, $beforeDate = null, $afterDate = null)
    {
        $dateCondition = [];
        $whereCondition = '';

        if ($beforeDate) {
            array_push($dateCondition, ' (MONTH(tr.tanggal_transaksi) >= MONTH(\''. $beforeDate .'\') AND YEAR(tr.tanggal_transaksi) >= YEAR(\''. $beforeDate .'\')) ');
        }

        if ($afterDate) {
            array_push($dateCondition, ' (MONTH(tr.tanggal_transaksi) <= MONTH(\''. $afterDate .'\') AND YEAR(tr.tanggal_transaksi) <= YEAR(\''. $afterDate .'\')) ');
        }

        if (count($dateCondition) > 0) {
            $whereCondition .= 'WHERE';
            $condition = join("OR",$dateCondition);
            $whereCondition .= $condition;
        }

        $sql = "
        SELECT 
            SUM(tr.jumlah) AS jumlah,
            SUM(tr.jumlah * p.harga ) AS total_harga,
            tanggal_transaksi,
            tr.produk_id,
            u2.umkm_id 
        FROM (
                (
                    SELECT 
                        tkd.produk_id, 
                        SUM(tkd.jumlah)      AS jumlah, 
                        tk.tanggal_transaksi AS tanggal_transaksi 
                    FROM transaksi_kasir_details tkd 
                    JOIN transaksi_kasirs tk ON tk.transaksi_kasir_id = tkd.transaksi_kasir_id 
                    GROUP BY DATE(tk.tanggal_transaksi), tkd.produk_id
                ) 
                UNION 
                (
                    SELECT 
                        tkd.produk_id, 
                        SUM(tkd.jumlah)      AS jumlah, 
                        tk.tanggal_transaksi AS tanggal_transaksi 
                    FROM transaksi_konsumen_details tkd 
                    JOIN transaksi_konsumens tk  ON tk.transaksi_konsumen_id = tkd.transaksi_konsumen_id 
                    GROUP BY DATE(tk.tanggal_transaksi), tkd.produk_id
                )
            ) tr
        LEFT JOIN produks p ON p.produk_id = tr.produk_id 
        LEFT JOIN kategori_produks kp ON kp.kategori_produk_id = p.kategori_produk_id 
        LEFT JOIN umkms u2 ON u2.umkm_id = kp.kategori_produk_id 
        $whereCondition
        GROUP BY MONTH(tr.tanggal_transaksi), YEAR(tr.tanggal_transaksi), tr.produk_id
        ";

        $produk = DB::table('produks')
                    ->join('kategori_produks', 'kategori_produks.kategori_produk_id', '=', 'produks.kategori_produk_id')
                    ->join('umkms', 'umkms.umkm_id', '=', 'kategori_produks.umkm_id')
                    ->leftJoin(DB::raw('('.$sql.') as tr'), 'tr.produk_id', '=', 'produks.produk_id')
                    ->selectRaw('
                        produks.*, 
                        kategori_produks.nama_kategori, 
                        COALESCE(tr.jumlah, 0) as jumlah,
                        COALESCE(tr.total_harga, 0) as total_harga,
                        COALESCE(tr.tanggal_transaksi, 0) as tanggal_transaksi'
                    );

        if ($umkmId){
            $produk->where('tr.umkm_id', $umkmId);
            $produk->orWhereNotNull('produks.produk_id');
        }

        return $produk->get();
    }
}
