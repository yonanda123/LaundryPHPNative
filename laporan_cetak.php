<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include "koneksi.php";
?>
<script>
    window.print();
    window.onfocus = function() {
        window.close();
    }
</script>

<body onload="window.print()">
    <div style="text-align: center;">Laporan Transaksi Pemasukan dan Pengeluaran</div><br>
    <table width="100%" border="1">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>Outlet</th>
                <th>Kasir</th>
                <th>Tanggal Transaksi</th>
                <th>Jenis</th>
                <th>Per Kg</th>
                <th>Harga</th>
                <th>Total Diskon</th>
                <th>Total Pajak</th>
                <th>Total Biaya Tambahan</th>
                <th>Total Keseluruhan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = "select * from tb_transaksi  
                                INNER JOIN tb_pelanggan ON tb_transaksi.id_pelanggan=tb_pelanggan.kode_pelanggan
                                INNER JOIN tb_user ON tb_transaksi.kode_user=tb_user.id
                                INNER JOIN tb_outlet ON tb_transaksi.id_outlet=tb_outlet.kode_outlet";
            $sql_rm = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
            while ($data = mysqli_fetch_array($sql_rm)) {
                $diskon = ($data['diskon'] * $data['nominal']) / 100;
                $diskon2 = $data['nominal'] - $diskon;
                $pajak = ($diskon2 * 10) / 100;
                $totaldiskon = ($data['nominal'] - $diskon);
                $total = ($data['nominal'] - $diskon) + $pajak + $data['biaya_tambahan'];
            ?>
                <tr>
                    <td style="text-align: center;"><?php echo $no++; ?></td>
                    <td style="text-align: center;"><?php echo $data['nama'] ?></td>
                    <td style="text-align: center;"><?php echo $data['nama_outlet'] ?></td>
                    <td style="text-align: center;"><?php echo $data['nama_user'] ?></td>
                    <td style="text-align: center;"><?= date('d F Y', strtotime($data['tgl_transaksi'])); ?></td>
                    <td style="text-align: center;"><?php echo $data['id_paket'] ?></td>
                    <td style="text-align: center;"><?php echo $data['kg'] ?> Kg</td>
                    <td style="text-align: center;">Rp. <?php echo number_format($data['nominal'], 0, ',', '.') ?></td>
                    <td style="text-align: center;"><?php echo $data['diskon'] ?>%</td>
                    <td style="text-align: center;">10 %</td>
                    <td style="text-align: center;">Rp. <?php echo number_format($data['biaya_tambahan'], 0, ',', '.') ?></td>
                    <td style="text-align: center;">Rp. <?php echo number_format($total, 0, ',', '.') ?></td>
                </tr>
            <?php
                $ttldiskon = $ttldiskon + $totaldiskon;
                $ttlpajak = $ttlpajak + $pajak;
                $ttltambahan = $ttltambahan + $data['biaya_tambahan'];
                $saldo = $ttldiskon + $ttlpajak + $ttltambahan;
            } ?>
        </tbody>
        <tr>
            <th colspan="11" style="text-align: center;">Saldo Akhir</th>
            <td colspan="12" style="text-align: center;">Rp. <?php echo number_format($saldo, 0, ',', '.') ?></td>
        </tr>

        </tbody>
    </table>
</body>