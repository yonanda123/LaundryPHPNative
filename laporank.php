<?php
$title = 'laporan';
require 'koneksi.php';

require 'layout_header_kasir.php';
?>
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Master Outlet</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Outlet</a></li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-6">
                        <a target="blank" href="laporan_cetak.php" class="btn btn-default" style="margin-bottom: 10px;"><i class="fa fa-print"></i> Cetak</a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button id="btn-refresh" class="btn btn-primary box-title text-right" title="Refresh Data"><i class="fa fa-refresh" id="ic-refresh"></i></button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered thead-dark" id="table">
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
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data['nama'] ?></td>
                                    <td><?php echo $data['nama_outlet'] ?></td>
                                    <td><?php echo $data['nama_user'] ?></td>
                                    <td><?= date('d F Y', strtotime($data['tgl_transaksi'])); ?></td>
                                    <td><?php echo $data['id_paket'] ?></td>
                                    <td><?php echo $data['kg'] ?> Kg</td>
                                    <td>Rp. <?php echo number_format($data['nominal'], 0, ',', '.') ?></td>
                                    <td><?php echo $data['diskon'] ?>%</td>
                                    <td>10 %</td>
                                    <td>Rp. <?php echo number_format($data['biaya_tambahan'], 0, ',', '.') ?></td>
                                    <td>Rp. <?php echo number_format($total, 0, ',', '.') ?></td>
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
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- table -->
    <!-- ============================================================== -->
    <div class="row">

    </div>
</div>
<?php
require 'layout_footer_kasir.php';
?>