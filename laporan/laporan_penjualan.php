<?php 
session_start();
if (!isset($_SESSION["username"]) && ($_SESSION["role"])) {
    header("location: ../index.php");
    exit();
}
require '../config/koneksi.php';
?>


<!DOCTYPE html>
<html>
<head>
    <title>Sistem Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">


<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="../dashboard.php">Inventory System</a>
    <div class="navbar-nav">
       <?php if ($_SESSION['role'] == 'admin') { ?>
      <a class="nav-link" href="../barang/barang.php">Master Data Barang</a>
      <?php } ?>
      <?php if ($_SESSION['role'] == 'penjaga gudang' || $_SESSION['role'] == 'admin') { ?>
      <a class="nav-link" href="../pembelian/pembelian.php">Input Masuk Barang</a>
      <a class="nav-link" href="../penjualan/penjualan.php">Input Keluar Barang</a>
      <?php } ?>
      <?php if ($_SESSION['role'] == 'owner' || $_SESSION['role'] == 'admin') { ?>
      <a class="nav-link" href="../laporan/laporan_pembelian.php">Laporan Pembelian</a>
      <a class="nav-link active" href="../laporan/laporan_penjualan.php">Laporan Penjualan</a>
      <?php } ?>
      <a class="nav-link text-danger fw-bold" href="../index.php">Log Out</a>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <h3>Penjualan</h3>
    <form action="" method="post">
    <table>
    <td><input type="text" name="jual" placeholder="cari pembeli.."></td>
    <td><button type="submit" name="cari" >CARI</button></td>
    </table>
    </form>
    <br>
    <table class="table table-bordered table-striped bg-white">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Nama Barang</th>
                <th>Pembeli</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(isset($_POST['cari'])){
                $cari = mysqli_real_escape_string($con, trim($_POST['jual']));
                $sql = mysqli_query($con ,"SELECT * from penjualan where pembeli like '%$cari%'");
                while($data = mysqli_fetch_assoc($sql)){
                echo"
                <tr>
                    <td>{$data['id']} </td>
                    <td>{$data['tanggal']} </td>
                    <td>{$data['nama_barang']} </td>
                    <td>{$data['pembeli']} </td>
                    <td><strong>{$data['qty']} pcs</strong></td>
                    <td>Rp.{$data['harga_jual_satuan']}</td>
                    <td>Rp.{$data['total_harga']}</td>
                </tr>
                ";
                }
            }else{
            $sql = mysqli_query($con, "SELECT * FROM penjualan");
            while($data = mysqli_fetch_array($sql)){
            echo"
                <tr>
                    <td>{$data['id']} </td>
                    <td>{$data['tanggal']} </td>
                    <td>{$data['nama_barang']} </td>
                    <td>{$data['pembeli']} </td>
                    <td><strong>{$data['qty']} pcs</strong></td>
                    <td>Rp.{$data['harga_jual_satuan']}</td>
                    <td>Rp.{$data['total_harga']}</td>
                </tr>
            ";
            }
            }
            ?>
        </tbody>
    </table>
</div>
<footer class="bg-dark text-light pt-1 pb-1 mt-auto">
        <div class="container">
           
            <div class="text-center small text-secondary">
                &copy; 2026 Inventory System. Designed by Syech.
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>