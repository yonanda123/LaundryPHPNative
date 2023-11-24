<?php

$host="localhost";
$user="root";
$password="";
$db="laundry_coba";

$kon = mysqli_connect($host,$user,$password,$db);
if (!$kon){
	  die("Koneksi gagal:".mysqli_connect_error());
}
?>