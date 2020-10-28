<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Produk;
use App\StokOpname;
use Carbon\Carbon;
use Faker\Generator as Faker;


$factory->define(Produk::class, function (Faker $faker) {
    $products = [
        'ABC KOPI,GULA PCK 10X31G',
        'ABC BATERY 2\'S BESAR',
        'ABC BATERY BIRU 4\'S',
        'ABC KECAP ASIN BTL 133mL',
        'ABC KECAP INGGRISBTL 195mL',
        'ABC KOPI+SUSU+MOCHA 10X27G',
        'ABC MACKAREL TOMAT KLG 425G',
        'ABC2\'S TANGGUNG PCK',
        'ALKALINE AAA 2\'S PCK ',
        'ALKALINE AA-LR6',
        'ALPENLIBE LOLI caramel',
        'ALPENLIBE LOLI strawbwery',
        'ARNOTS NYAM-NYAM ICE 28G',
        'ARNOTS TIMTAM COKLAT 120G',
        'ARNOTS TIMTAM VANILA 120G',
        'BISKUAT ORI 176G',
        'CHEETOS AYAM BKR 40G',
        'CHEETOS JAGUNG BAKAR 40G',
        'CHITATO AYAM BUMBU 68G',
        'CHITATO AYM BBQ 35G',
        'CHITATO AYM BBQ 68G',
        'CHITATO AYM BUMBU 35G',
        'CHITATO KJ SPREME 68G',
        'CHITATO KJ SUPREME 35G',
        'CHITATO SP BUMBU BKR 68G',
        'CHITATO SP PANGGANG 35G',
        'DJI SAM SOE KRETEK 12',
        'GERY DONUT 96G',
        'GO MALKIST COKLAT 234G',
        'GO POTATO 60G',
        'GOOD TIME BROWNIES 76G',
        'GOOD TIME CLASIC 80G',
        'GOOD TIME DOUBLE CHIP 80G',
        'GOOD TIME MINI CLASIC CUP 45G',
        'GORIORIO MAGIC 150G',
        'HATARI PEANUT BISCUIT 250G',
        'KHONG GUAN MALKIST ABON',
        'KHONG GUAN MALKIST CRAKERS',
        'KHONG GUAN MALKIST SEAWEED',
        'KHONG GUAN POTATO KRECKER',
        'KHONG GUAN SALTCHEESE 200G',
        'KHONGGUAN BUGATTI PIZZA 220G',
        'KHONGGUAN SUPERCO 138G',
        'KLOP PANDAN 96G',
        'KRAFT MINI OREO COKLAT CUP',
        'KRAFT MINI OREO VANILA CUP ',
        'KRAFT OREO ICE CREAM 137G',
        'KUSUKA BARBEQUE 60G',
        'KUSUKA SINGK KJ BKR 60G',
        'KUSUKA SINGKONG RUMPUT LAUT 60G',
        'KUSUKA SINGKONG SAOS BLD 60G ',
        'LAYS BBQ 75G',
        'LAYS RMPT LAUT 35G',
        'LAYS RMPT LAUT 68G',
        'MONDE BOURBON',
        'MONDE BUTTER COOKIES 150G',
        'MONDE EGG ROLL',
        'MONDE GENJI 70G',
        'MONDE PIE SAND',
        'NISSIN BUTER COCONUT',
        'NISSIN CRISPY CRAKERS 225G',
        'NISSIN KELAPA IJO 220G',
        'NISSIN LEMONIA',
        'NISSIN WALENS CHOCOSOES',
        'NYAM-NYAM BUBBLE BLUEBERRY 18G',
        'NYAM-NYAM BUBBLE STRAW CUP 18G',
        'NYAM-NYAM BUBBLEPUFF CHOCO CUP 18G',
        'NYAM-NYAM FANTASI STRA',
        'OISHI RIN BEE KEJU',
        'OISHI UDANG PEDAS 70GR',
        'OREO SOFT CAKE 16G',
        'PIATTOS BBQ 50G',
        'PIATTOS RUMPUT LAUT 85GR',
        'PIATTOS SP PANGGANG 12G',
        'QTELA SINGKONG BALADO 60G',
        'QTELA SINGKONG ORIGINAL 60G',
        'QTELA TEMPE DAUN JERUK 60G',
        'REGAL MARIE 125G',
        'REGAL MARIE 250G',
        'ROMA BISKUIT KELAPA 300G',
        'ROMA COFFEE JOY',
        'ROMA MALKIST ABON',
        'ROMA MALKIST CRACKERD',
        'ROMA SARI GANDUM',
        'ROMA SARI GANDUM SANWICH COKLAT ',
        'SAMPOERNA KRETEK 12',
        'SAMPOERNA MILD FILTER 16',
        'Selamat Cho Sandw  102gr',
        'SERENA CHOCOLATE SHOT CAKE',
        'SERENA RODEO 138G',
        'SOBA SMBL BLADO 24G',
        'SOBAAYAM BKR 24G',
        'STT FRENCH 2000 38G',
        'STT FRENCH 2000 75G',
        'TANGO FUSION 104G',
        'TARO 3D  JUNGLE CHIC 40G',
        'TARO COWBOT STEAK 40G',
        'TARO NET PTTO BBQ 9G',
        'TARO NET SEAWEED 9G',
        'TARO POTATO 40G',
    ];
    
    return [
        'nama_produk' => $faker->randomElement($products),
        'gambar_produk' => 'http://localhost:8000/images/image_dummy.png',
        'deskripsi_produk' => $faker->realText(100, 2),
        'stok' => 100,
        'tanggal_input' => Carbon::now(),
    ];
});

$factory->afterCreating(Produk::class, function ($produk, $faker) {
    $produk->save(factory(StokOpname::class)->create([
        'produk_id' => $produk->produk_id
    ])->toArray());
});
