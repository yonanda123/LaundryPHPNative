<?php
include "koneksi.php";
$id = $_GET['id'];
$sql = $koneksi->query("select * from tb_laundry 
INNER JOIN tb_pelanggan ON tb_laundry.id_pelanggan=tb_pelanggan.kode_pelanggan
INNER JOIN tb_user ON tb_laundry.kode_user=tb_user.id
INNER JOIN tb_outlet ON tb_laundry.id_outlet=tb_outlet.kode_outlet");
$data = $sql->fetch_assoc();
$diskon = ($data['diskon'] * $data['nominal']) / 100;
$diskon2 = $data['nominal'] - $diskon;
$pajak = ($diskon2 * 10) / 100;
$total = ($data['nominal'] - $diskon) + $pajak + $data['biaya_tambahan'];
?>
<script>
    window.print();
    window.onfocus = function() {
        window.close();
    }
</script>

<body onload="window.print()">
    <table>
        <tbody>
            <tr>
                <td>Laundry SMKN 2 Singosari</td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>Jalan Perusahaan No 20, Tanjungtirto,</td>
            </tr>
            <tr>
                <td>Singosari, Jajar Tanjungtirto, kec.</td>
            </tr>
            <tr>
                <td>Singosari, Malang, Jawa Timur 65153</td>
            </tr>
            <tr>
                <td>Telpon : (0341)4345127</td>
            </tr>
        </tbody>
    </table>
    <hr width="40%" align="left">
    <table>
        <tbody>
            <tr>
                <td>Nama Kasir</td>
                <td>:</td>
                <td><?php echo $data['nama_user']; ?></td>
            </tr>
            <tr>
                <td>Nama Outlet</td>
                <td>:</td>
                <td><?php echo $data['nama_outlet'] ?></td>
            </tr>
            <tr>
                <td>Nama Pelanggan</td>
                <td>:</td>
                <td><?php echo $data['nama']; ?></td>
            </tr>
            <tr>
                <td>Jenis</td>
                <td>:</td>
                <td><?php echo $data['id_paket'] ?></td>
            </tr>
            <tr>
                <td>Per Kg</td>
                <td>:</td>
                <td><?php echo $data['kg'] ?>Kg</td>
            </tr>
            <tr>
                <td>Harga</td>
                <td>:</td>
                <td><?php echo $data['nominal'] ?></td>
            </tr>
            <tr>
                <td>Tanggal Terima</td>
                <td>:</td>
                <td><?php echo $data['tanggal_terima']; ?></td>
            </tr>
            <tr>
                <td>Tanggal Selesai</td>
                <td>:</td>
                <td><?php echo $data['tanggal_selesai']; ?></td>
            </tr>
            <tr>
                <td>Diskon</td>
                <td>:</td>
                <td><?php echo $data['diskon'] ?> %</td>
            </tr>
            <tr>
                <td>Pajak</td>
                <td>:</td>
                <td>10 %</td>
            </tr>
            <tr>
                <td>Biaya Tambahan</td>
                <td>:</td>
                <td><?php echo $data['biaya_tambahan'] ?></td>
            </tr>
            <tr>
                <td>Total</td>
                <td>:</td>
                <td><?php echo $total ?></td>
            </tr>
            <tr>
                <td>Bayar</td>
                <td>:</td>
                <td><?php echo $data['status']; ?></td>
            </tr>
        </tbody>
    </table>
</body>