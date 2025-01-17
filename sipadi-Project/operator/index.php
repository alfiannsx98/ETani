<?php
require_once 'admin_header.php';
require '../controllers/login/functions-login.php';
session_start();
$_POST = $_SESSION;

// $email = $_POST["email_admin"];
// $result = mysqli_query($koneksi, "SELECT * FROM admin WHERE email_admin = '$email'");
if (!isset($_SESSION["login"])) {
  header("Location: ../login/login.php");
  exit;
}
if (!($_POST["level"] == 2)) {
  header("Location: admin/");
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
        <a class="btn btn-primary" href="../controllers/login/logout.php">Logout</a>
      </div>
    </div>
  </div>
</div>

<!-- End Modal -->


<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">

    <?php require_once 'topbar.php'; ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      </div>

      <!--batas aku copas dari admin-->
      <?php
      $var = "Belum Terkonfirmasi";
      $krjg = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE  `transaksi`.`id_adm` = '$var' OR `transaksi`.`status_kirim` = 0");
      $cart = mysqli_num_rows($krjg);
      ?>

      <?php if ($cart >= 1) : ?>
        <div class="alert alert-warning" role="alert">
          Haloo <?= $email; ?> Ada <span class="badge badge-pill badge-success"><?= $cart; ?></span> pesanan yang belum dikonfirmasi nih!
        </div>
      <?php endif; ?>
      <!-- Content Row -->
      <div class="row">
        <!-- Content Row -->
        <div class="col-xl-6 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Total Penjualan</div>
                  <?php $dt = query("SELECT SUM(total_final) AS duit FROM transaksi"); ?>
                  <?php foreach ($dt as $duit) : ?>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($duit['duit']);  ?></div>
                  <?php endforeach; ?>
                </div>
                <div class="col-auto">
                  <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php
        $var = "1";
        $krjg = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE  `transaksi`.`id_adm` = '$var' OR `transaksi`.`status_kirim` = 1");
        $cart = mysqli_num_rows($krjg);
        ?>
        <div class="col-xl-6 col-md-6 mb-4">
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Transaksi Berhasil Terkonfirmasi</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $cart; ?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-shopping-cart"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Penjualan Per Bulan</h6>
            </div>

            <!-- Card Body -->
            <div class="card-body">
              <div class="chart-area">
                <canvas id="ChartKu"></canvas>
              </div>
            </div>
          </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>

            </div>

            <!-- Card Body -->
            <div class="card-body">
              <div class="chart-pie pt-4 pb-2">
                <canvas id="pieChart"></canvas>
              </div>
              <div class="mt-4 text-center small">
                <span class="mr-2">
                  <i class="fas fa-circle text-primary"></i> Super Admin
                </span>
                <span class="mr-2">
                  <i class="fas fa-circle text-success"></i> Operator
                </span>
                <span class="mr-2">
                  <i class="fas fa-circle text-info"></i> Pembeli
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!--batas akhir copas dari index.php admin-->
    <!-- Content Row -->

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

  <?php require_once 'admin_footer.php'; ?>