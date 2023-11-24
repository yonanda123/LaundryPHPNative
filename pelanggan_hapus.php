<?php 
require 'koneksi.php';
$kode = $_GET['id'];
$sql = "DELETE FROM tb_pelanggan WHERE kode_pelanggan = '$kode'" ;
$exe = mysqli_query($koneksi,$sql);

if($exe){
	$success = 'true';
    $title = 'Berhasil';
    $message = 'Menghapus Data';
    $type = 'success';
    header('location: pelanggan.php?crud='.$success.'&msg='.$message.'&type='.$type.'&title='.$title);
}else{
    echo "data gagal disimpan";
}
 ?>