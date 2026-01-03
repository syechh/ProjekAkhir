<?php 
session_start();
if (!isset($_SESSION["username"]) && ($_SESSION["role"])) {
    header("location: ../index.php");
    exit();
}
require '../config/koneksi.php';

$message = ""; 

if(isset($_POST['tambah'])){
    $barang = $_POST['barang'];
    $supplier = $_POST['supplier'];
    $stok = $_POST['stok'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];

    $sql = "INSERT INTO barang (nama_barang, supplier, stok, harga_beli, harga_jual) VALUES ('$barang', '$supplier', '$stok', '$harga_beli', '$harga_jual')";
    $query = mysqli_query($con, $sql);
    
    if($query){
        $message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> Berhasil menambahkan stok barang!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
    }else{
        $message = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> Gagal menambahkan barang.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Barang - Inventory System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #f0f2f5;
        }
        .form-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            background-color: white;
        }
        .navbar-custom {
            background-color: #0d6efd;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

 <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="../dashboard.php">Inventory System</a>
    <div class="navbar-nav">
       <?php if ($_SESSION['role'] == 'admin') { ?>
      <a class="nav-link active" href="../barang/barang.php">Master Data Barang</a>
      <?php } ?>
      <?php if ($_SESSION['role'] == 'penjaga gudang' || $_SESSION['role'] == 'admin') { ?>
      <a class="nav-link" href="../pembelian/pembelian.php">Input Masuk Barang</a>
      <a class="nav-link" href="../penjualan/penjualan.php">Input Keluar Barang</a>
      <?php } ?>
      <?php if ($_SESSION['role'] == 'owner' || $_SESSION['role'] == 'admin') { ?>
      <a class="nav-link" href="../laporan/laporan_pembelian.php">Laporan Pembelian</a>
      <a class="nav-link" href="../laporan/laporan_penjualan.php">Laporan Penjualan</a>
      <?php } ?>
      <a class="nav-link text-danger fw-bold" href="../index.php">Log Out</a>
    </div>
  </div>
</nav>

    <div class="container flex-grow-1 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                
                <?php echo $message; ?>

                <div class="card form-card p-4">
                    <div class="card-body">
                        <h3 class="card-title text-center fw-bold mb-4">Master Data Barang</h3>
                        
                        <form action="" method="post">
                            
                            <div class="mb-3">
                                <label for="barang" class="form-label fw-semibold">Nama Barang</label>
                                <input type="text" class="form-control" name="barang" id="barang" placeholder="Masukkan nama barang" required>
                            </div>

                            <div class="mb-3">
                                <label for="supplier" class="form-label fw-semibold">Supplier</label>
                                <input type="text" class="form-control" name="supplier" id="supplier" placeholder="Nama supplier" required>
                            </div>

                            <div class="mb-3">
                                <label for="stok" class="form-label fw-semibold">Stok</label>
                                <input type="number" class="form-control" name="stok" id="stok" placeholder="0" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="harga_beli" class="form-label fw-semibold">Harga Beli</label>
                                    <input type="number" class="form-control" name="harga_beli" id="harga_beli" placeholder="0" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="harga_jual" class="form-label fw-semibold">Harga Jual</label>
                                    <input type="number" class="form-control" name="harga_jual" id="harga_jual" placeholder="0" required>
                                </div>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" name="tambah" class="btn btn-primary fw-bold py-2">
                                    Tambah Barang
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <footer class="bg-dark text-light pt-3 pb-3 mt-auto">
        <div class="container">
            <div class="text-center small text-secondary">
                &copy; 2026 Inventory System. Designed by Syech.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>