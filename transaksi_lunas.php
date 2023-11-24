<?php
require 'koneksi.php';
$id = $_GET['id'];
$sql = $koneksi->query("select * from tb_laundry where id_laundry='$id'");
$data = $sql->fetch_assoc();

$pelanggan = $data['id_pelanggan'];
$outlet = $data['id_outlet'];
$tanggal = $data['tanggal_terima'];
$paket = $data['id_paket'];
$kg = $data['kg'];
$nominal = $data['nominal'];
$diskon = $data['diskon'];
$tambahan = $data['biaya_tambahan'];

$kode_user = $data['kode_user'];

$query2 = "insert into tb_transaksi (id_pelanggan, id_outlet, kode_user, tgl_transaksi, id_paket, kg, nominal, diskon, biaya_tambahan) 
                            values('$pelanggan','$outlet','$kode_user','$tanggal','$paket','$kg','$nominal','$diskon','$tambahan')";
$query = "update tb_laundry set status='lunas' where id_laundry = '$id'";
$execute = bisa($koneksi, $query);
$execute2 = bisa($koneksi, $query2);
    if ($execute == 1) {
        $success = 'true';
        $title = 'Berhasil';
        $message = 'Pembayaran Telah Lunas';
        $type = 'success';
        header('location: transaksi.php?crud=' . $success . '&msg=' . $message . '&type=' . $type . '&title=' . $title);
    } elseif ($execute2 == 1) {
        $success = 'true';
        $title = 'Berhasil';
        $message = 'Pembayaran Telah Lunas';
        $type = 'success';
        header('location: transaksi.php?crud=' . $success . '&msg=' . $message . '&type=' . $type . '&title=' . $title);
    } else {
        echo "Gagal Tambah Data";
    }
?>