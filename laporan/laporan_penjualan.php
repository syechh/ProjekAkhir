<?php 
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
      <a class="nav-link" href="../barang/barang.php">Master Data Barang</a>
      <a class="nav-link" href="../pembelian/pembelian.php">Input Masuk Barang</a>
      <a class="nav-link" href="../penjualan/penjualan.php">Input Keluar Barang</a>
      <a class="nav-link" href="../laporan/laporan_pembelian.php">Laporan Pembelian</a>
      <a class="nav-link" href="../laporan/laporan_penjualan.php">Laporan Penjualan</a>
      <a class="nav-link" href="../index.php">Log Out</a>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <h3>Stok Barang Saat Ini</h3>
    <table class="table table-bordered table-striped bg-white">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Nama Barang</th>
                <th>Pembeli</th>
                <th>Qty</th>
                <th>Harga Jual</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php        
            $query = mysqli_query($con, "SELECT * FROM penjualan");
            while($row = mysqli_fetch_array($query)){
            ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['tanggal']; ?></td>
                <td><?= $row['nama_barang']; ?></td>
                <td><?= $row['pembeli']; ?></td>
                <td><strong><?= $row['qty']; ?> pcs</strong></td>
                <td>Rp <?= number_format($row['harga_jual_satuan']); ?></td>
                <td>Rp <?= number_format($row['total_harga']); ?></td>
            </tr>
            <?php } ?>
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