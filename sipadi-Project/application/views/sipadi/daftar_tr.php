<?php
require '../../controllers/sipadi/sipadi-functions.php';
session_start();

$id = $_GET['id'];

if (isset($_SESSION['login_pembeli']) == 1) {
    $mail = $_SESSION['email'];
    $result = mysqli_query($koneksi, "SELECT id_pembeli FROM pembeli WHERE email_pembeli = '$mail'");
    $result1 = mysqli_fetch_assoc($result);
    $result = $result1['id_pembeli'];
    require 'includes/header-login.php';
} else {
    header('Location: index.php');
    exit;
    require 'includes/header.php';
}

$cart = query("SELECT * FROM cart WHERE id_users='$id'");

if (isset($_POST["checkout"])) {
    if (checkout($_POST) > 0) {
        echo "
            <script>
                alert('Data Berhasil Ditambah');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data Berhasil di Checkout');
                document.location.href= 'index.php';
            </script>
        ";
    }
}
?>
<div class="container single_product_container">
    <form action="" method="post" class="user" enctype="multipart/form-data">
        <div class="row">
            <div class="col">
                <div class="breadcrumbs d-flex flex-row align-items-center">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li class="active"><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Daftar Transaksi</a></li>
                    </ul>
                </div>
                <table class="table col-10">
                    <thead>
                        <tr>
                            <th data-field="name">Kode Transaksi</th>
                            <th data-field="category">Alamat Kirim</th>
                            <th data-field="price">Kota Dituju</th>
                            <th data-field="quantity">Harga Keseluruhan</th>
                            <th data-field="total">Nomor Rekening</th>
                            <th data-field="total">Bukti Transfer</th>
                            <th data-field="aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $querycmnd = query(
                            "SELECT transaksi.id_transaksi as 'nm_brg',
                            barang.id_brg as 'id_brg',
                            barang.harga_brg as 'harga',
                            kategori.nama_kategori as 'kategori',
                            cart.qty_dibeli as 'dibeli',
                            cart.id_cart as 'id_cart',
                            cart.subtotal as 'subtotal'
                            FROM barang,kategori,cart
                            WHERE cart.id_barangs = barang.id_brg AND barang.id_ktg = kategori.id_kategori;
                "
                        );
                        ?>
                        <?php foreach ($querycmnd as $r) : ?>
                            <tr>
                                <td hidden><input type="hidden" name="id_barang[]" id="" value="<?= $r['id_brg'] ?>"></td>
                                <td><input type="hidden"><?= $r['nm_brg']; ?></td>
                                <td><input type="hidden"><?= $r['kategori']; ?></td>
                                <td><input type="hidden" name="harga_satuan[]" value="<?= $r['harga']; ?>">Rp. <?= $r['harga']; ?></td>
                                <td><input type="hidden" name="jml_dibeli_tmp[]" value="<?= $r['dibeli']; ?>"><?= $r['dibeli']; ?></td>
                                <td><input type="hidden">Rp. <?= $r['subtotal']; ?></td>
                                <td><a href="hapus_cart.php?id=<?= $r['id_cart']; ?>"><i class="material-icons red-text">Hapus</i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
            </div>
            </table>
        </div>
    </form>
</div>


<?php
require 'includes/footer.php';
?>