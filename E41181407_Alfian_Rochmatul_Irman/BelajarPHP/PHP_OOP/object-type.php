<?php
// studi kasus si toko jual produk (komik dan game)
class Produk
{
    public $judul,
        $penerbit,
        $Harga,
        $penulis;

    public function __construct($judul = "Judul", $penulis = "Penulis", $penerbit = "Penerbit", $harga = 0)
    {
        // __construct adalah method spesial yang dimiliki oleh php
        // echo "Hello World";
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->penerbit = $penerbit;
        $this->harga = $harga;
    }
    public function getLabel()
    {
        return "$this->penulis, $this->penerbit";
        // $this->(variabel) untuk memanggil variabel baru
    }
}

class CetakInfoProduk
{
    public function cetak($produk)
    {
        $str = "{$produk->judul} | {$produk->getLabel()}(Rp.{$produk->harga})";
        return $str;
    }
}



$produk1 = new Produk("Naruto", "Masashi Kishimoto", "Shonen Jump", 30000);

$produk2 = new Produk("Dota 2", "Neil Druckman", "Gaben", 0);

// $produk3 = new Produk("Dragon Ball");
echo "Komik : " . $produk1->getLabel();
echo "<br>";
echo "Game : " . $produk2->getLabel();
echo "<br>";
// var_dump($produk3);
$infoProduk1 = new CetakInfoProduk();
echo $infoProduk1->cetak($produk1);
