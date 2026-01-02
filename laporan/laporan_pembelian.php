<?php 
require '../config/koneksi.php';
?>


<!DOCTYPE html>
<html>
<head>
    <title>Sistem Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

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
                <th>Supplier</th>
                <th>Qty</th>
                <th>Harga Beli</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php        
            $query = mysqli_query($con, "SELECT * FROM pembelian");
            while($row = mysqli_fetch_array($query)){
            ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['tanggal']; ?></td>
                <td><?= $row['nama_barang']; ?></td>
                <td><?= $row['supplier']; ?></td>
                <td><strong><?= $row['qty']; ?> pcs</strong></td>
                <td>Rp <?= number_format($row['harga_beli_satuan']); ?></td>
                <td>Rp <?= number_format($row['total_harga']); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>