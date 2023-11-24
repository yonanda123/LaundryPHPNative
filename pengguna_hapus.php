<?php 
require 'koneksi.php';
$sql = "DELETE FROM tb_user WHERE id = " . $_GET['id'];
$exe = mysqli_query($koneksi,$sql);

if($exe){
	$success = 'true';
    $title = 'Berhasil';
    $message = 'Menghapus Data';
    $type = 'success';
    header('location: pengguna.php?crud='.$success.'&msg='.$message.'&type='.$type.'&title='.$title);
}
 ?>