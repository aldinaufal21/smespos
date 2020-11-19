<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Report extends Model
{
    public static function getTransaksiUmkm($umkmId = null, $beforeDate = null, $afterDate = null)
    {
        $umkm = Umkm::find($umkmId);
        $umkmJoinDate = $umkm->tanggal_bergabung;

        $whereBeforeDate = $beforeDate ? $beforeDate : $umkmJoinDate;
        $whereAfterDate = $afterDate ? $afterDate : Carbon::now();

        /**
         * where query should be:
         * 
         * WHERE (MONTH(tr.tanggal_transaksi) >= MONTH('2020-11-01') AND YEAR(tr.tanggal_transaksi) >= YEAR('2020-11-01')) 
         * AND (MONTH(tr.tanggal_transaksi) <= MONTH('2020-11-30') AND YEAR(tr.tanggal_transaksi) <= YEAR('2020-11-30'))
         */

        $sql = "
        SELECT 
            SUM(trans.jumlah) AS jumlah,
            SUM(trans.jumlah * p.harga ) AS total_harga,
            trans.tanggal_transaksi AS tanggal_transaksi,
            trans.produk_id,
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
            ) trans
        LEFT JOIN produks p ON p.produk_id = trans.produk_id 
        LEFT JOIN kategori_produks kp ON kp.kategori_produk_id = p.kategori_produk_id 
        LEFT JOIN umkms u2 ON u2.umkm_id = kp.umkm_id 
        WHERE (MONTH(trans.tanggal_transaksi) >= MONTH('$whereBeforeDate') AND YEAR(trans.tanggal_transaksi) >= YEAR('$whereBeforeDate')) 
        AND (MONTH(trans.tanggal_transaksi) <= MONTH('$whereAfterDate') AND YEAR(trans.tanggal_transaksi) <= YEAR('$whereAfterDate'))
        GROUP BY MONTH(trans.tanggal_transaksi), YEAR(trans.tanggal_transaksi), trans.produk_id
        ";

        $produk = DB::table('produks')
            ->join('kategori_produks', 'kategori_produks.kategori_produk_id', '=', 'produks.kategori_produk_id')
            ->join('umkms', 'umkms.umkm_id', '=', 'kategori_produks.umkm_id')
            ->leftJoin(DB::raw('(' . $sql . ') as tr'), 'tr.produk_id', '=', 'produks.produk_id')
            ->selectRaw('
                        produks.*, 
                        kategori_produks.nama_kategori, 
                        COALESCE(tr.jumlah, 0) as jumlah,
                        COALESCE(tr.total_harga, 0) as total_harga,
                        COALESCE(tr.tanggal_transaksi, 0) as tanggal_transaksi');

        if ($umkmId) {
            $produk->where('umkms.umkm_id', $umkmId);
        }

        return $produk->get();
    }

    public static function getTransaksiCabang($cabangId, $beforeDate = null, $afterDate = null)
    {
        $umkm = Cabang::find($cabangId)->umkm()->first();
        $umkmJoinDate = $umkm->tanggal_bergabung;
        $umkmId = $umkm->umkm_id;

        $whereBeforeDate = $beforeDate ? $beforeDate : $umkmJoinDate;
        $whereAfterDate = $afterDate ? $afterDate : Carbon::now();

        /**
         * where query should be:
         * 
         * WHERE (MONTH(tr.tanggal_transaksi) >= MONTH('2020-11-01') AND YEAR(tr.tanggal_transaksi) >= YEAR('2020-11-01')) 
         * AND (MONTH(tr.tanggal_transaksi) <= MONTH('2020-11-30') AND YEAR(tr.tanggal_transaksi) <= YEAR('2020-11-30'))
         */

        $sql = "
            SELECT 
                SUM(trans.jumlah) AS jumlah,
                SUM(trans.jumlah * p.harga ) AS total_harga,
                trans.tanggal_transaksi AS tanggal_transaksi,
                trans.produk_id,
                u2.umkm_id,
                c2.cabang_id 
            FROM (
                    (
                        SELECT 
                            tkd.produk_id, 
                            SUM(tkd.jumlah)      AS jumlah, 
                            tk.tanggal_transaksi AS tanggal_transaksi,
                            k2.cabang_id
                        FROM transaksi_kasir_details tkd 
                        JOIN transaksi_kasirs tk ON tk.transaksi_kasir_id = tkd.transaksi_kasir_id 
                        JOIN kasirs k2 ON k2.kasir_id = tk.kasir_id 
                        GROUP BY DATE(tk.tanggal_transaksi), tkd.produk_id, k2.cabang_id 
                    ) 
                    UNION 
                    (
                        SELECT 
                            tkd.produk_id, 
                            SUM(tkd.jumlah)      AS jumlah, 
                            tk.tanggal_transaksi AS tanggal_transaksi,
                            tk.cabang_id
                        FROM transaksi_konsumen_details tkd 
                        JOIN transaksi_konsumens tk  ON tk.transaksi_konsumen_id = tkd.transaksi_konsumen_id 
                        GROUP BY DATE(tk.tanggal_transaksi), tkd.produk_id, tk.cabang_id 
                    )
                ) trans
            LEFT JOIN produks p ON p.produk_id = trans.produk_id 
            LEFT JOIN kategori_produks kp ON kp.kategori_produk_id = p.kategori_produk_id 
            LEFT JOIN umkms u2 ON u2.umkm_id = kp.umkm_id 
            LEFT JOIN cabangs c2 ON c2.umkm_id = u2.umkm_id AND c2.cabang_id = trans.cabang_id
            WHERE (MONTH(trans.tanggal_transaksi) >= MONTH('$whereBeforeDate') AND YEAR(trans.tanggal_transaksi) >= YEAR('$whereBeforeDate')) 
            AND (MONTH(trans.tanggal_transaksi) <= MONTH('$whereAfterDate') AND YEAR(trans.tanggal_transaksi) <= YEAR('$whereAfterDate'))
            AND c2.cabang_id = $cabangId
            GROUP BY MONTH(trans.tanggal_transaksi), YEAR(trans.tanggal_transaksi), trans.produk_id, c2.cabang_id  
        ";

        $produk = DB::table('produks')
            ->join('kategori_produks', 'kategori_produks.kategori_produk_id', '=', 'produks.kategori_produk_id')
            ->join('umkms', 'umkms.umkm_id', '=', 'kategori_produks.umkm_id')
            ->leftJoin(DB::raw('(' . $sql . ') as tr'), 'tr.produk_id', '=', 'produks.produk_id')
            ->selectRaw('
                produks.*, 
                kategori_produks.nama_kategori, 
                COALESCE(tr.jumlah, 0) as jumlah,
                COALESCE(tr.total_harga, 0) as total_harga,
                COALESCE(tr.tanggal_transaksi, 0) as tanggal_transaksi')
            ->where('umkms.umkm_id', $umkmId);

        return $produk->get();
    }

    public static function umkmMonthlyProfit($umkmId = null, $beforeDate = null, $afterDate = null)
    {
        $umkm = Umkm::find($umkmId);
        $umkmJoinDate = $umkm->tanggal_bergabung;

        $whereBeforeDate = $beforeDate ? $beforeDate : $umkmJoinDate;
        $whereAfterDate = $afterDate ? $afterDate : Carbon::now();

        /**
         * where query should be:
         * 
         * WHERE (MONTH(tr.tanggal_transaksi) >= MONTH('2020-11-01') AND YEAR(tr.tanggal_transaksi) >= YEAR('2020-11-01')) 
         * AND (MONTH(tr.tanggal_transaksi) <= MONTH('2020-11-30') AND YEAR(tr.tanggal_transaksi) <= YEAR('2020-11-30'))
         */

        $sql = "
        SELECT 
            SUM(trans.jumlah) AS jumlah_terjual,
            SUM(trans.jumlah * p.harga ) AS total_keuntungan,
            DATE_FORMAT(trans.tanggal_transaksi, '%m-%Y') AS bulan_transaksi,
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
        ) trans
        LEFT JOIN produks p ON p.produk_id = trans.produk_id 
        LEFT JOIN kategori_produks kp ON kp.kategori_produk_id = p.kategori_produk_id 
        LEFT JOIN umkms u2 ON u2.umkm_id = kp.umkm_id
        WHERE (MONTH(trans.tanggal_transaksi) >= MONTH('$whereBeforeDate') AND YEAR(trans.tanggal_transaksi) >= YEAR('$whereBeforeDate')) 
        AND (MONTH(trans.tanggal_transaksi) <= MONTH('$whereAfterDate') AND YEAR(trans.tanggal_transaksi) <= YEAR('$whereAfterDate'))
        GROUP BY MONTH(trans.tanggal_transaksi), YEAR(trans.tanggal_transaksi)
        ";

        $umkm = DB::table('umkms')
            ->leftJoin(DB::raw('(' . $sql . ') as tr'), 'tr.umkm_id', '=', 'umkms.umkm_id')
            ->selectRaw('
                umkms.umkm_id,
                jumlah_terjual,
                total_keuntungan,
                bulan_transaksi
            ');

        if ($umkmId) {
            $umkm->where('tr.umkm_id', $umkmId);
        }

        return $umkm->get();
    }

    public static function cabangMonthlyProfit($cabangId = null, $beforeDate = null, $afterDate = null)
    {
        $umkm = Cabang::find($cabangId)->umkm()->first();
        $umkmJoinDate = $umkm->tanggal_bergabung;

        $whereBeforeDate = $beforeDate ? $beforeDate : $umkmJoinDate;
        $whereAfterDate = $afterDate ? $afterDate : Carbon::now();

        /**
         * where query should be:
         * 
         * WHERE (MONTH(tr.tanggal_transaksi) >= MONTH('2020-11-01') AND YEAR(tr.tanggal_transaksi) >= YEAR('2020-11-01')) 
         * AND (MONTH(tr.tanggal_transaksi) <= MONTH('2020-11-30') AND YEAR(tr.tanggal_transaksi) <= YEAR('2020-11-30'))
         */

        $sql = "
        SELECT 
            SUM(trans.jumlah) AS jumlah_terjual,
            SUM(trans.jumlah * p.harga ) AS total_keuntungan,
            trans.tanggal_transaksi AS bulan_transaksi,
            c2.cabang_id
        FROM (
                (
                    SELECT 
                        tkd.produk_id, 
                        SUM(tkd.jumlah)      AS jumlah, 
                        tk.tanggal_transaksi AS tanggal_transaksi,
                        k2.cabang_id
                    FROM transaksi_kasir_details tkd 
                    JOIN transaksi_kasirs tk ON tk.transaksi_kasir_id = tkd.transaksi_kasir_id 
                    JOIN kasirs k2 ON k2.kasir_id = tk.kasir_id 
                    GROUP BY DATE(tk.tanggal_transaksi), tkd.produk_id, k2.cabang_id 
                ) 
                UNION 
                (
                    SELECT 
                        tkd.produk_id, 
                        SUM(tkd.jumlah)      AS jumlah, 
                        tk.tanggal_transaksi AS tanggal_transaksi,
                        tk.cabang_id
                    FROM transaksi_konsumen_details tkd 
                    JOIN transaksi_konsumens tk  ON tk.transaksi_konsumen_id = tkd.transaksi_konsumen_id 
                    GROUP BY DATE(tk.tanggal_transaksi), tkd.produk_id, tk.cabang_id 
                )
            ) trans
        LEFT JOIN produks p ON p.produk_id = trans.produk_id 
        LEFT JOIN cabangs c2 ON c2.cabang_id = trans.cabang_id
        WHERE (MONTH(trans.tanggal_transaksi) >= MONTH('$whereBeforeDate') AND YEAR(trans.tanggal_transaksi) >= YEAR('$whereBeforeDate')) 
        AND (MONTH(trans.tanggal_transaksi) <= MONTH('$whereAfterDate') AND YEAR(trans.tanggal_transaksi) <= YEAR('$whereAfterDate'))
        AND c2.cabang_id = $cabangId
        GROUP BY MONTH(trans.tanggal_transaksi), YEAR(trans.tanggal_transaksi)
        ";

        $umkm = DB::table('cabangs')
            ->leftJoin(DB::raw('(' . $sql . ') as tr'), 'tr.cabang_id', '=', 'cabangs.cabang_id')
            ->selectRaw('
                jumlah_terjual,
                total_keuntungan,
                bulan_transaksi
            ');

        if ($cabangId) {
            $umkm->where('tr.cabang_id', $cabangId);
        }

        return $umkm->get();
    }
}
