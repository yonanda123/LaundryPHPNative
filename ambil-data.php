<?php
include "koneksi3.php";
if (isset($_POST['outlet'])) {
    $outlet = $_POST["outlet"];

    $sql = "select * from tb_paket where id_outlet=$outlet";

    $hasil = mysqli_query($kon, $sql);
    $no = 0;
    while ($data = mysqli_fetch_array($hasil)) {
        echo "<option value=' $data[jenis].$data[harga].$data[kg]'>$data[jenis], $data[kg] Kg, Harga Rp. $data[harga] </option>";
    }
}
?>