<?php
session_start();
require '../config/koneksi.php'; 


if(isset($_POST['tambah_item'])){
    $id_barang = $_POST['id_barang'];
    $qty = $_POST['qty'];
    
    $query = mysqli_query($con, "SELECT nama_barang, harga_jual FROM barang WHERE id='$id_barang'");
    $data = mysqli_fetch_array($query);
    
    
    if($data){
        $item = [
            'id' => $id_barang,
            'nama' => $data['nama_barang'],
            'qty' => $qty,
            'harga' => $data['harga_jual'],
            'subtotal' => $qty * $data['harga_jual']
        ];
        
        $_SESSION['keranjang_penjualan'][] = $item;
    }
}


if(isset($_GET['hapus_index'])){
    $index = $_GET['hapus_index'];
    unset($_SESSION['keranjang_penjualan'][$index]);
    $_SESSION['keranjang_penjualan'] = array_values($_SESSION['keranjang_penjualan']);
    header('location:penjualan.php');
}


if(isset($_POST['simpan_transaksi'])){
    $pembeli = $_POST['pembeli'];
    $tanggal = $_POST['tanggal'];

    if(!empty($_SESSION['keranjang_penjualan'])){
        
        foreach($_SESSION['keranjang_penjualan'] as $cart){
            $id_brg = $cart['id'];
            $qty = $cart['qty'];
            $nama_barang = $cart['nama'];
            $harga_jual = $cart['harga'];
            $total = $cart['subtotal'];
            
            $query_insert = "INSERT INTO penjualan (tanggal, id_barang, nama_barang, pembeli, qty, harga_jual_satuan, total_harga) 
                             VALUES ('$tanggal', '$id_brg', '$nama_barang', '$pembeli', '$qty', '$harga_jual', '$total')";
            mysqli_query($con, $query_insert);
            
            mysqli_query($con, "UPDATE barang SET stok = stok + $qty WHERE id = '$id_brg'");
        }
        
        unset($_SESSION['keranjang_penjualan']);
        echo "<script>alert('Transaksi Berhasil Disimpan!'); window.location.href='penjualan.php';</script>";
    } else {
        echo "<script>alert('Keranjang kosong!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Input penjualan</title>
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
    <div class="row">
        
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white"><strong>1. Pilih Barang Masuk</strong></div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label>Nama Barang</label>
                            <select name="id_barang" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <?php
                                $ambil = mysqli_query($con, "SELECT * FROM barang");
                                while($b = mysqli_fetch_array($ambil)){
                                    echo "<option value='".$b['id']."'>".$b['nama_barang']." | ".$b['supplier']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Jumlah (Qty)</label>
                            <input type="number" name="qty" class="form-control" required min="1" placeholder="0">
                        </div>
                        <button type="submit" name="tambah_item" class="btn btn-primary w-100">+ Tambahkan</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white"><strong>2. Review Transaksi</strong></div>
                <div class="card-body">
                    <form method="POST">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label>Nama Pembeli</label>
                                <input type="text" name="pembeli" class="form-control" required>
                            </div>
                        </div>

                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Barang</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(!empty($_SESSION['keranjang_penjualan'])){
                                    $no = 1;
                                    $grand_total = 0;
                                    foreach($_SESSION['keranjang_penjualan'] as $key => $isi){
                                        $grand_total += $isi['subtotal'];
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $isi['nama']; ?></td>                                    
                                    <td><?= $isi['qty']; ?></td>
                                    <td>Rp <?= number_format($isi['harga']); ?></td>
                                    <td>Rp <?= number_format($isi['subtotal']); ?></td>
                                    <td>
                                        <a href="penjualan.php?hapus_index=<?= $key; ?>" class="btn btn-danger btn-sm">Hapus</a>
                                    </td>
                                </tr>
                                <?php } ?>
                                <tr class="fw-bold">
                                    <td colspan="5" class="text-end">Total</td>
                                    <td colspan="2">Rp <?= number_format($grand_total); ?></td>
                                </tr>
                                <?php } else { ?>
                                    <tr><td colspan="7" class="text-center text-muted">Keranjang Kosong</td></tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <div class="text-end mt-3">
                            <?php if(!empty($_SESSION['keranjang_penjualan'])): ?>
                            <button type="submit" name="simpan_transaksi" class="btn btn-success btn-lg" onclick="return confirm('Simpan transaksi ini?')">
                                <i class="bi bi-save"></i> SIMPAN SEMUA
                            </button>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    
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