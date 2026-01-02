<?php 
require '../config/koneksi.php';

$no = 1;

if(isset($_POST['tambah'])){
    $id_barang = $_POST['id_barang'];
    $tanggal = date('d-m-Y');
    $pembeli = $_POST['pembeli'];
    $qty = $_POST['qty'];
    $harga = $_POST['harga'];
    $total = $qty * $harga;

    $sql = "INSERT INTO penjualan (tanggal, id_barang, nama_pembeli, qty, harga_jual_satuan, total_harga) VALUES ('$tanggal', '$id_barang', '$pembeli', '$qty', '$harga', '$total')";
    mysqli_query($con,$sql);
    $query = "UPDATE barang SET stok =  stok - $qty WHERE id = '$id_barang'";
    mysqli_query($con,$query);
    if($sql && $qty){
        echo "<alert>berhasil mengurangi stok barang</alert>";
    }else{
        echo "<alert>gagal mengurangi barang</alert>";
    }
}

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
    <h2>Penjualan</h2>
    <form action="" method="post">
    <table>
        <tr>
            <td>Pembeli</td>
            <td><input type="text" name="pembeli"  placeholder="nama pembeli"></td>
        </tr>
        <tr>
            <td><label for="">Pilih Barang</label></td>
            <td><select name="id_barang" >
                <?php
                $data = mysqli_query($con, "SELECT * FROM barang");
                while($d = mysqli_fetch_assoc($data)){
                    echo "<option value = '".$d['id']."'>".$d['nama_barang']."(Stok: ".$d['stok'].")</option>";
                }
                ?>
            </select></td>
        </tr>
        <tr>
            <td>Qty</td>
            <td><input type="number" name="qty" ></td>
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
