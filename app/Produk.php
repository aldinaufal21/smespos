<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produk extends Model
{
    protected $primaryKey = 'produk_id';

    public $timestamps = false;

    protected $fillable = [
        'nama_produk',
        'gambar_produk',
        'deskripsi_produk',
        'kategori_produk_id',
        'tanggal_input',
        'harga',
        'code',
    ];

    public static function getProductByQueryUmkm(
        $namaProduk = null,
        $kategoriProduk = null,
        $idKategori = null,
        $IdUmkm = null,
        $produkId = null
    ) {
        $getUmkmId = $IdUmkm ? '= ' . $IdUmkm : 'IS NOT NULL';

        $sql = "
            SELECT 
                p.*,
                COALESCE(
                    (SUM(DISTINCT data_stok_cabang.source) - COALESCE(tr.jumlah, 0)), 0
                ) AS stok
            FROM produks p
            JOIN kategori_produks kp ON kp.kategori_produk_id = p.kategori_produk_id 
            JOIN umkms u2 ON u2.umkm_id = kp.umkm_id 
            LEFT JOIN cabangs c ON c.umkm_id = u2.umkm_id
            LEFT JOIN (
                SELECT 
                    SUM(y.jumlah) AS jumlah,
                    y.produk_id,
                    y.tanggal_transaksi
                FROM (
                        (
                            SELECT 
                                tkd.produk_id, 
                                SUM(tkd.jumlah)      AS jumlah, 
                                tk.tanggal_transaksi AS tanggal_transaksi
                            FROM transaksi_kasir_details tkd 
                            JOIN transaksi_kasirs tk ON tk.transaksi_kasir_id = tkd.transaksi_kasir_id 
                            JOIN kasirs k2 ON k2.kasir_id = tk.kasir_id 
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
                    ) y
                GROUP BY produk_id
            ) tr ON tr.produk_id = p.produk_id
            LEFT JOIN (
                SELECT 
                    p.produk_id,
                    u2.umkm_id,
                    c.cabang_id, 
                    COALESCE ((
                        CASE 
                            WHEN so.tanggal_stok_opname IS NULL THEN (
                                SELECT
                                    SUM(stok) AS stok
                                FROM stoks s 
                                GROUP BY produk_id, cabang_id
                                HAVING s.produk_id = p.produk_id 
                                AND s.cabang_id = c.cabang_id 
                            )
                            WHEN so.tanggal_stok_opname IS NOT NULL 
                                AND so.tanggal_stok_opname > s.tanggal_input THEN (
                                SELECT
                                    SUM(jumlah) AS stok
                                FROM stok_opnames so 
                                GROUP BY produk_id, cabang_id, so.tanggal_stok_opname 
                                HAVING so.produk_id = p.produk_id 
                                AND so.cabang_id = c.cabang_id 
                                ORDER BY so.tanggal_stok_opname DESC
                                LIMIT 1
                            )
                            WHEN so.tanggal_stok_opname IS NOT NULL 
                                AND s.tanggal_input > so.tanggal_stok_opname THEN (
                                SELECT 
                                    SUM(stok) AS stok
                                FROM (
                                    (
                                        SELECT s.produk_id, s.cabang_id, s.stok AS stok, s.tanggal_input AS tanggal
                                        FROM stoks s
                                    )
                                    UNION
                                    (
                                        SELECT so.produk_id, so.cabang_id, so.jumlah AS stok, so.tanggal_stok_opname AS tanggal
                                        FROM stok_opnames so
                                    )
                                ) stok_plus
                                WHERE stok_plus.produk_id = p.produk_id 
                                AND stok_plus.cabang_id = c.cabang_id 
                                AND stok_plus.tanggal >= so.tanggal_stok_opname 
                            )
                        END 
                    ), 0) AS source
                FROM produks p
                JOIN kategori_produks kp ON kp.kategori_produk_id = p.kategori_produk_id 
                JOIN umkms u2 ON u2.umkm_id = kp.umkm_id 
                LEFT JOIN cabangs c ON c.umkm_id = u2.umkm_id 
                LEFT JOIN (
                    SELECT
                        so2.cabang_id,
                        so2.produk_id,
                        MAX(so2.tanggal_stok_opname) AS tanggal_stok_opname,
                        so2.jumlah 
                    FROM stok_opnames so2 
                    GROUP BY produk_id 
                    ORDER BY so2.tanggal_stok_opname DESC
                ) so ON so.produk_id = p.produk_id AND so.cabang_id = c.cabang_id 
                LEFT JOIN (
                    SELECT
                        s2.stok,
                        s2.produk_id,
                        s2.cabang_id,
                        MAX(s2.tanggal_input) AS tanggal_input 
                    FROM stoks s2 
                    GROUP BY produk_id 
                    ORDER BY s2.tanggal_input DESC
                ) s ON s.produk_id = p.produk_id AND so.cabang_id = c.cabang_id 
                where c.cabang_id IN (
                    SELECT cabang_id FROM cabangs WHERE umkm_id = u2.umkm_id
                )
                GROUP BY p.produk_id, c.cabang_id
            ) data_stok_cabang ON data_stok_cabang.umkm_id = u2.umkm_id AND data_stok_cabang.produk_id = p.produk_id
            WHERE u2.umkm_id $getUmkmId
            GROUP BY data_stok_cabang.produk_id, data_stok_cabang.umkm_id
        ";

        $produk = DB::table('produks')
            ->join('kategori_produks', 'kategori_produks.kategori_produk_id', '=', 'produks.kategori_produk_id')
            ->join('umkms', 'umkms.umkm_id', '=', 'kategori_produks.umkm_id')
            ->leftJoin(DB::raw('(' . $sql . ') as ps'), 'ps.produk_id', '=', 'produks.produk_id')
            ->select(
                'produks.*',
                'kategori_produks.nama_kategori',
                'umkms.*',
                'ps.stok'
            );


        if ($namaProduk) {
            $produk->where('nama_produk', 'like', '%' . $namaProduk . '%');
        }

        if ($kategoriProduk) {
            $kategoriProduk = KategoriProduk::where('nama_kategori', 'like', '%' . $kategoriProduk . '%')->first();
            $produk->where('produks.kategori_produk_id', $kategoriProduk->kategori_produk_id);
        }

        if ($idKategori) {
            $produk->whereIn('produks.kategori_produk_id', $idKategori);
        }

        if ($IdUmkm) {
            $produk->where('umkms.umkm_id', $IdUmkm);
        }

        if ($produkId) {
            $produk->where('produks.produk_id', $produkId);
        }

        return $produk->get();
    }

    public static function getProductByQueryCabang(
        $namaProduk = null,
        $kategoriProduk = null,
        $idKategori = null,
        $idCabang = null,
        $produkId = null
    ) {
        $getCabangId = $idCabang ? '= ' . $idCabang : 'IS NOT NULL';

        $sql = "
            SELECT 
                p.*,
                COALESCE ((
                    CASE 
                        WHEN so.tanggal_stok_opname IS NULL THEN (
                            SELECT
                                SUM(stok) AS stok
                            FROM stoks s 
                            GROUP BY produk_id, cabang_id
                            HAVING s.produk_id = p.produk_id 
                            AND s.cabang_id = c.cabang_id 
                        )
                        WHEN so.tanggal_stok_opname IS NOT NULL 
                            AND so.tanggal_stok_opname > s.tanggal_input THEN (
                            SELECT
                                SUM(jumlah) AS stok
                            FROM stok_opnames so 
                            GROUP BY produk_id, cabang_id, so.tanggal_stok_opname 
                            HAVING so.produk_id = p.produk_id 
                            AND so.cabang_id = c.cabang_id 
                            ORDER BY so.tanggal_stok_opname DESC
                            LIMIT 1
                        )
                        WHEN so.tanggal_stok_opname IS NOT NULL 
                            AND s.tanggal_input > so.tanggal_stok_opname THEN (
                            SELECT 
                                SUM(stok) AS stok
                            FROM (
                                (
                                    SELECT s.produk_id, s.cabang_id, s.stok AS stok, s.tanggal_input AS tanggal
                                    FROM stoks s
                                )
                                UNION
                                (
                                    SELECT so.produk_id, so.cabang_id, so.jumlah AS stok, so.tanggal_stok_opname AS tanggal
                                    FROM stok_opnames so
                                )
                            ) stok_plus
                            WHERE stok_plus.produk_id = p.produk_id 
                            AND stok_plus.cabang_id = c.cabang_id 
                            AND stok_plus.tanggal >= so.tanggal_stok_opname 
                        )
                    END 
                ) - COALESCE(tr.jumlah, 0), 0) AS stok
            FROM produks p
            JOIN kategori_produks kp ON kp.kategori_produk_id = p.kategori_produk_id 
            JOIN umkms u2 ON u2.umkm_id = kp.umkm_id 
            LEFT JOIN cabangs c ON c.umkm_id = u2.umkm_id 
            LEFT JOIN (
                SELECT
                    so2.cabang_id,
                    so2.produk_id,
                    MAX(so2.tanggal_stok_opname) AS tanggal_stok_opname,
                    so2.jumlah 
                FROM stok_opnames so2 
                ORDER BY so2.tanggal_stok_opname DESC
            ) so ON so.produk_id = p.produk_id AND so.cabang_id = c.cabang_id 
            LEFT JOIN (
                SELECT
                    s2.stok,
                    s2.produk_id,
                    s2.cabang_id,
                    MAX(s2.tanggal_input) AS tanggal_input 
                FROM stoks s2 
                ORDER BY s2.tanggal_input DESC
            ) s ON s.produk_id = p.produk_id AND so.cabang_id = c.cabang_id 
            LEFT JOIN (
                SELECT 
                    SUM(y.jumlah) AS jumlah,
                    y.produk_id,
                    y.tanggal_transaksi,
                    y.cabang_id
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
                    ) y
                GROUP BY produk_id, cabang_id 
            ) tr ON tr.produk_id = p.produk_id AND tr.cabang_id = c.cabang_id 
            WHERE c.cabang_id $getCabangId
            GROUP BY p.produk_id, c.cabang_id 
        ";

        $produk = DB::table('produks')
            ->join('kategori_produks', 'kategori_produks.kategori_produk_id', '=', 'produks.kategori_produk_id')
            ->join('umkms', 'umkms.umkm_id', '=', 'kategori_produks.umkm_id')
            ->join('cabangs', 'cabangs.umkm_id', '=', 'umkms.umkm_id')
            ->leftJoin(DB::raw('(' . $sql . ') as ps'), 'ps.produk_id', '=', 'produks.produk_id')
            ->select(
                'produks.*',
                'kategori_produks.nama_kategori',
                'umkms.*',
                'ps.stok'
            );


        if ($namaProduk) {
            $produk->where('nama_produk', 'like', '%' . $namaProduk . '%');
        }

        if ($kategoriProduk) {
            $kategoriProduk = KategoriProduk::where('nama_kategori', 'like', '%' . $kategoriProduk . '%')->first();
            $produk->where('produks.kategori_produk_id', $kategoriProduk->kategori_produk_id);
        }

        if ($idKategori) {
            $produk->whereIn('produks.kategori_produk_id', $idKategori);
        }

        if ($produkId) {
            $produk->where('produks.produk_id', $produkId);
        }

        if ($idCabang) {
            $produk->where('cabangs.cabang_id', $idCabang);
        }

        return $produk->get();
    }

    public static function getLatest($limitProduct = null)
    {
        $limit = $limitProduct ? $limitProduct : 4;
        
        $produk = DB::table('produks')
            ->join('kategori_produks', 'kategori_produks.kategori_produk_id', '=', 'produks.kategori_produk_id')
            ->join('umkms', 'umkms.umkm_id', '=', 'kategori_produks.umkm_id')
            ->orderBy('produks.tanggal_input', 'desc')
            ->limit($limit);

        return $produk;
    }

    public static function getProductDetailById($id)
    {
        return self::getProductByQueryUmkm(null, null, null, null, $id)->first();
    }

    public function kategori()
    {
        return $this->belongsTo('App\KategoriProduk', 'kategori_produk_id', 'kategori_produk_id');
    }

    public function produkFavorit()
    {
        return $this->hasMany('App\ProdukFavorit');
    }

    public function stokOpname()
    {
        return $this->hasMany('App\StokOpname', 'produk_id', 'produk_id');
    }

    public function stok()
    {
        return $this->hasMany('App\Stok', 'produk_id', 'produk_id');
    }

    public function keranjang()
    {
        return $this->hasMany('App\Keranjang', 'produk_id', 'produk_id');
    }

    public function transaksiKasirDetail()
    {
        return $this->hasMany('App\TransaksiKasirDetail');
    }

    public function transaksiKonsumenDetail()
    {
        return $this->hasMany('App\TransaksiKonsumenDetail');
    }
}
