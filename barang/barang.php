<?php 
require '../config/koneksi.php';

$no = 1;

if(isset($_POST['tambah'])){
    $barang = $_POST['barang'];
    $supplier = $_POST['supplier'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    
    $sql = "INSERT INTO barang (nama_barang, supplier, stok, harga_dasar) VALUES ('$barang', $supplier, '$stok', '$harga')";
    mysqli_query($con,$sql);
    
    
    if($sql){
        echo "berhasil menambahkan stok barang";
    }else{
        echo "gagal menambahkan barang";
    }
}

// if(isset($_POST['edit'])){
//     $id = $_POST['id'];
//     $tanggal = date('Y-m-d');
//     $jenis = $_POST['jenis'];
//     $kategori = $_POST['kategori'];
//     $nominal = $_POST['nominal'];
//     $keterangan = $_POST['keterangan'];

//     $sql = "UPDATE transaksi SET tanggal='$tanggal', jenis='$jenis', kategori='$kategori', nominal='$nominal', keterangan='$keterangan' WHERE id='$id'";
//     mysqli_query($con,$sql);
// }

// if(isset($_POST['hapus'])){
//     $id = $_POST['id'];

//     $sql = "DELETE FROM transaksi WHERE id='$id'";
//     mysqli_query($con,$sql);
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="../dashboard.php">Inventory System</a>
    <div class="navbar-nav">
      <a class="nav-link" href="../barang/barang.php">Stok Barang</a>
      <a class="nav-link" href="../pembelian/pembelian.php">Input Pembelian (Supplier)</a>
      <a class="nav-link" href="../penjualan/penjualan.php">Input Penjualan (Customer)</a>
      <!-- <a class="nav-link" href="../laporan.php">Laporan Detail</a> -->
    </div>
  </div>
</nav>
    <h2>Input Barang</h2>
    <form action="" method="post">
    <table>
        <tr>
            <td>Barang</td>
            <td><input type="text" name="barang"  placeholder="nama barang"></td>
        </tr>
        <tr>
            <td>Supplier</td>
            <td><input type="text" name="supplier"  placeholder="nama barang"></td>
        </tr>
        <tr>
            <td>Stok</td>
            <td><input type="number" name="stok" ></td>
        </tr>
        <tr>
            <td>Harga</td>
            <td><input type="number" name="harga" ></td>
        </tr>
        <tr>
            <td><input type="submit" name="tambah" value="tambah"></td>
        </tr>
    </table>
    </form>
    <br>

    <!-- <table>
        <thead>
            <tr>
                <td>No</td>
                <td>Id</td>
                <td>Tanggal</td>
                <td>Jenis</td>
                <td>Kategori</td>
                <td>Nominal</td>
                <td>Keterangan</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                // $sql="SELECT * from transaksi";
                // $hasil = mysqli_query($con, $sql);
                // while($data = mysqli_fetch_assoc($hasil)){
                // echo "
                // <tr>
                // <td>" . $no++ . "</td>
                // <td>{$data ['id']}</td>
                // <td>{$data ['jenis']}</td>
                // <td>{$data ['kategori']}</td>
                // <td>{$data ['nominal']}</td>
                // <td>{$data ['keterangan']}</td>
                // </tr>";
                // }
                ?>
        </tbody>
    </table> -->
</body>
</html>
