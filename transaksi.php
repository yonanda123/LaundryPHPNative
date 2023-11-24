<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$title = 'transaksi';
require 'koneksi.php';
require 'layout_header.php';
?>
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Master Transaksi</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="transaksi.php">Paket</a></li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-6">
                        <a href="transaksi_tambah.php" class="btn btn-primary box-title"><i class="fa fa-plus fa-fw"></i> Tambah</a>
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
                                <th>kasir</th>
                                <th>Jenis</th>
                                <th>Per Kg</th>
                                <th>Harga</th>
                                <th>Tanggal Terima</th>
                                <th>Tanggal Selesai</th>
                                <th>Diskon</th>
                                <th>Pajak</th>
                                <th>Biaya Tambahan</th>
                                <th>Total Biaya</th>
                                <th>Status Pembayaran</th>
                                <th>Status Laundry</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = "select * from tb_laundry 
                                INNER JOIN tb_pelanggan ON tb_laundry.id_pelanggan=tb_pelanggan.kode_pelanggan
                                INNER JOIN tb_user ON tb_laundry.kode_user=tb_user.id
                                INNER JOIN tb_outlet ON tb_laundry.id_outlet=tb_outlet.kode_outlet ";
                            $sql_rm = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
                            while ($data = mysqli_fetch_array($sql_rm)) {
                                $diskon = ($data['diskon'] * $data['nominal']) / 100;
                                $diskon2 = $data['nominal'] - $diskon;
                                $pajak = ($diskon2 * 10) / 100;
                                $total = ($data['nominal'] - $diskon) + $pajak + $data['biaya_tambahan'];
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data['nama'] ?></td>
                                    <td><?php echo $data['nama_outlet'] ?></td>
                                    <td><?php echo $data['nama_user'] ?></td>
                                    <td><?php echo $data['id_paket'] ?></td>
                                    <td><?php echo $data['kg'] ?> Kg</td>
                                    <td>Rp. <?php echo number_format($data['nominal'], 0, ',', '.') ?></td>
                                    <td><?= date('d F Y', strtotime($data['tanggal_terima'])); ?></td>
                                    <td><?= date('d F Y', strtotime($data['tanggal_selesai'])); ?></td>
                                    <td><?php echo $data['diskon'] ?> %</td>
                                    <td>10 %</td>
                                    <td>Rp. <?php echo number_format($data['biaya_tambahan'], 0, ',', '.') ?></td>
                                    <td>Rp. <?php echo number_format($total, 0, ',', '.') ?></td>
                                    <?php
                                    if ($data['status'] == "belum lunas") {
                                    ?>
                                        <td><button class="fa btn-danger"><?php echo $data['status'] ?></button> </td>
                                    <?php } elseif ($data['status'] == "lunas") { ?>
                                        <td><button class="fa btn-success"><?php echo $data['status'] ?></button> </td>
                                    <?php } ?>
                                    <td><?php echo $data['proses'] ?> &nbsp; <?php if ($data['proses'] == "baru" || $data['proses'] == "proses" || $data['proses'] == "selesai") { ?>
                                            <a href="transaksi_edit.php?id=<?= $data['id_laundry']; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($data['status'] == "belum lunas") {
                                        ?>
                                            <a href="transaksi_lunas.php?id=<?= $data['id_laundry']; ?>" class="btn btn-primary"><i class="fa fa-money"></i>Lunaskan</a>
                                        <?php } ?>
                                        <?php
                                        if ($data['status'] == "lunas") { //jika status dalam tb_laundry dalam kondisi belum lunas maka tombol untuk melunaskan akan muncul
                                        ?>
                                            <a target="blank" href="page/laundry/cetak.php?id=<?php echo $data['id_laundry']; //ambil id laundry dari tb_laundry untuk mencetak 1 baris
                                                                                                ?>" class="btn btn-default"><i class="fa fa-print"></i>Cetak</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
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
require 'layout_footer.php';
?>