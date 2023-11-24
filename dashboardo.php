<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include "koneksi.php";
session_start();

if ($_SESSION['admin'] || $_SESSION['kasir'] || $_SESSION['owner']) {

    $title = 'dashboard';
    require 'layout_header_owner.php';
    $joutlet = ambilsatubaris($koneksi, 'SELECT COUNT(kode_outlet) as jumlahoutlet FROM tb_outlet');
    $jpaket = ambilsatubaris($koneksi, 'SELECT COUNT(kode_paket) as jumlahpaket FROM tb_paket');
    $jpengguna = ambilsatubaris($koneksi, 'SELECT COUNT(id) as jumlahpengguna FROM tb_user');
    $jpelanggan = ambilsatubaris($koneksi, 'SELECT COUNT(kode_pelanggan) as jumlahpelanggan FROM tb_pelanggan');
    $jtransaksi = ambilsatubaris($koneksi, 'SELECT COUNT(id_laundry) as jumlahtransaksi FROM tb_laundry');
    $jlaporan = ambilsatubaris($koneksi, 'SELECT COUNT(kode_transaksi) as jumlahlaporan FROM tb_transaksi');
?>
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Dashboard</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!-- ============================================================== -->
        <!-- Different data widgets -->
        <!-- ============================================================== -->
        <!-- .row -->
        <div class="row">
            <div class="col-lg-4 col-sm-6 col-xs-12">
                <div class="white-box analytics-info">
                    <a href="laporank.php" class="box-title">
                        <h3 class="box-title">Laporan</h3>
                        <ul class="list-inline two-part">
                            <li>
                                <div class="fa fa-file-text"></div>
                            </li>
                            <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple"><?= $jlaporan['jumlahlaporan'] ?></span></li>
                        </ul>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="white-box">
                    <h3 class="box-title">10 Transaksi Terbaru</h3>
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
                                            <a target="blank" href="transaksi_cetak.php?id=<?= $data['id_laundry']; ?>" class="btn btn-default"><i class="fa fa-print"></i>Cetak</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    require 'layout_footer_owner.php';
} else {
    header("location:index.php");
}
?>