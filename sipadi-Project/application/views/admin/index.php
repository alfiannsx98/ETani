<?php
require_once 'admin_header.php';
require '../../../application/controllers/login/functions-login.php';
session_start();
$_POST = $_SESSION;

// $email = $_POST["email_admin"];
// $result = mysqli_query($koneksi, "SELECT * FROM admin WHERE email_admin = '$email'");
if (!isset($_SESSION["login"])) {
    header("Location: ../login/login.php");
    exit;
}
if (($_POST["level"] == 2)) {
    header("Location: ../operator/");
    exit;
}
// $koneksi1 = mysqli_connect("localhost", "root", "", "dbsipadifinal1");
$email = $_POST['email_admin'];
$sql = mysqli_query($koneksi, "SELECT gambar_admin FROM admin WHERE email_admin = '$email'");
$gmbr = mysqli_fetch_assoc($sql);

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
                <a class="btn btn-primary" href="../../../application/controllers/login/logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- End Modal -->


<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php require_once '../templates/topbar.php'; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            </div>

            <!-- Content Row -->
            <div class="row">
                <!-- Content Row -->
                <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Total Penjualan</div>
                      <?php $dt = query("SELECT SUM(total_final) AS duit FROM transaksi"); ?>
                      <?php foreach($dt as $duit): ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?=  $duit['duit'];?></div>
                      <?php endforeach; ?>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah User Admin Terdaftar</div>
                      <?php 
                      $dtusr = mysqli_query($koneksi,"SELECT * FROM admin");
                      $usr = mysqli_num_rows($dtusr); 
                      ?>
                      
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $usr; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
                <div class="row">

                </div>

                <!-- Content Row -->
                <div class="row">

                    <!-- Content Column -->
                    <div class="col-lg-6 mb-4">

                    </div>

                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
    </div>
    <?php require_once 'admin_footer.php'; ?>