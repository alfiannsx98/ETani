<?php
require_once 'header.php';
require '../../controllers/transaksi/functions-transaksi.php';
session_start();
$_POST = $_SESSION;
$getKota = mysqli_query($koneksi, "SELECT `transaksi`.*,`kurir`.`kota_tujuan`,`admin`.`nama_admin`,`pembeli`.`nama_pembeli`,`toko`.`nama_toko`
                FROM `transaksi` 
                JOIN `kurir` ON `kurir`.`id_kurir` = `transaksi`.`id_kurer`
                JOIN `admin` ON `admin`.`id_admin` = `transaksi`.`id_adm`
                JOIN `pembeli` ON `pembeli`.`id_pembeli` = `transaksi`.`id_pembeli`
                JOIN `toko` ON `toko`.`id_toko` = `transaksi`.`id_toko`
                WHERE `transaksi`.`status_kirim` = 1
");
$var = "Belum Terkonfirmasi";
$konfirm = mysqli_query($koneksi, "SELECT `transaksi`.*,`kurir`.kota_tujuan,`pembeli`.`nama_pembeli`
            FROM `transaksi`
            JOIN `kurir` ON `kurir`.`id_kurir` = `transaksi`.`id_kurer`
            JOIN `pembeli` ON `pembeli`.`id_pembeli` = `transaksi`.`id_pembeli`
            WHERE `transaksi`.`id_adm` = '$var' OR `transaksi`.`status_kirim` = 0
");
if (!isset($_SESSION["login"])) {
    header("Location: ../login/login.php");
    exit;
}
if (!($_POST["level"] == 2)) {
    header("Location: ../admin/");
    exit;
}
// $koneksi1 = mysqli_connect("localhost", "root", "", "dbsipadifinal1");
$email = $_POST['email_admin'];
$sql = mysqli_query($koneksi, "SELECT gambar_admin FROM admin WHERE email_admin = '$email'");
$gmbr = mysqli_fetch_assoc($sql);

$dtTransaksi = query("SELECT * FROM transaksi");
// $dtTransaksi = query("SELECT * FROM transaksi WHERE status_bayar = '0' AND status_kirim = '0'"); <-kondisi didalam data Karyawan

?>
<?php require_once 'sidebar.php'; ?>

<!-- Modal -->
<!-- Logout Modal-->


<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="../../application/controllers/login/logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- End Modal -->


<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php require_once '../../templates/topbar.php'; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Data Transaksi <a href="#" class="btn btn-warning"><i class="fas fa-print"></i></a></h1>
                </h1>
            </div>
            <!-- Content Row -->
            <table id="example" class="ui celled table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Transaksi</th>
                        <th>Nama Admin</th>
                        <th>Nama Pembeli</th>
                        <th>Alamat Kirim</th>
                        <th>tgl_kirim</th>
                        <th>Kota Pembeli</th>
                        <th>Ongkos Kirim</th>
                        <th>Total Harga</th>
                        <th>Total Final</th>
                        <th>Status Bayar</th>
                        <th>Status Kirim</th>
                        <th>Tanggal Transaksi</th>
                        <th>Bukti Transfer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($getKota as $tr) : ?>
                        <tr>
                            <td><?= $i; ?><a href="cek.php?id=<?= $tr['id_transaksi']; ?>"><i class="fas fa-eye"></i></a> </td>
                            <td><?= $tr['nama_admin']; ?></td>
                            <td><?= $tr['nama_pembeli']; ?></td>
                            <td><?= $tr['alamat_kirim']; ?></td>
                            <td><?= date('d F Y', $tr['tgl_kirim']); ?></td>
                            <td><?= $tr['kota_tujuan']; ?></td>
                            <td><?= $tr['ongkir_kurir']; ?></td>
                            <td><?= $tr['total_harga']; ?></td>
                            <td><?= $tr['total_final']; ?></td>
                            <td>
                                <?php if ($tr['status_bayar'] == 1) : ?>
                                    <div class='alert alert-success small'><i class='fas fa-check'></i></div>
                                <?php else : ?>
                                    <a class='btn btn-warning' href='edit.php?id=<?= $tr['id_transaksi']; ?>'><i class='fas fa-check'></i></a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($tr['status_kirim'] == 1) : ?>
                                    <div class='alert alert-success small'><i class='fas fa-check'></i></div>
                                <?php else : ?>
                                    <a class='btn btn-warning' href='edit1.php?id=<?= $tr['id_transaksi']; ?>'><i class='fas fa-check'></i></a>
                                <?php endif; ?>
                            </td>
                            <td><?= $tr['tgl_transaksi']; ?></td>
                            <td><img src="<?= "../../transaksi/gambar/" . $tr['bukti_transfer']; ?>" class="img-alt" height="100" width="100" alt=""></td>

                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <hr>
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Data Transaksi Yang Belum Terverifikasi </h1>
                </h1>
            </div>
            <table id="example1" class="ui celled table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Status</th>
                        <th>Kota Pembeli</th>
                        <th>Alamat Kirim</th>
                        <th>Nama Pembeli</th>
                        <th>Ongkir Kurir</th>
                        <th>Total Harga</th>
                        <th>Status Bayar</th>
                        <th>Status Kirim</th>
                        <th>Tgl Transaksi</th>
                        <th>Bukti Transfer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($konfirm as $tr) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $tr['id_adm']; ?></td>
                            <td><?= $tr['kota_tujuan']; ?></td>
                            <td><?= $tr['alamat_kirim']; ?></td>
                            <td><?= $tr['nama_pembeli']; ?></td>
                            <td><?= $tr['ongkir_kurir']; ?></td>
                            <td><?= $tr['total_final']; ?></td>
                            <td>
                                <?php if ($tr['status_bayar'] == 1) : ?>
                                    <div class='alert alert-success small'><i class='fas fa-check'></i></div>
                                <?php else : ?>
                                    <a class='btn btn-warning' href='edit.php?id=<?= $tr['id_transaksi']; ?>'><i class='fas fa-check'></i></a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($tr['status_kirim'] == 1) : ?>
                                    <div class='alert alert-success small'><i class='fas fa-check'></i></div>
                                <?php else : ?>
                                    <a class='btn btn-warning' href='edit1.php?id=<?= $tr['id_transaksi']; ?>'><i class='fas fa-check'></i></a>
                                <?php endif; ?>
                            </td>
                            <td><?= $tr['tgl_transaksi']; ?></td>
                            <td><img src="<?= "../../transaksi/gambar/" . $tr['bukti_transfer']; ?>" class="img-alt" height="100" width="100" alt=""></td>

                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
    </div>
    <?php require_once 'footer.php'; ?>