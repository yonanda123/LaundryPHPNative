<?php
$title = 'pelanggan';
require 'koneksi.php';

$sql = $koneksi->query("select kode_pelanggan from tb_pelanggan order by kode_pelanggan desc");
$data = $sql->fetch_assoc();
$kode_pelanggan = $data['kode_pelanggan'];
$urut = substr($kode_pelanggan, 4, 4);
$tambah = (int) $urut + 1;

if (strlen($tambah) == 1) {
    $format = "PLG-" . "000" . $tambah;
} elseif (strlen($tambah) == 2) {
    $format = "PLG-" . "00" . $tambah;
} elseif (strlen($tambah) == 3) {
    $format = "PLG-" . "0" . $tambah;
} else {
    $format = "PLG-" . $tambah;
}

if (isset($_POST['simpan'])) {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telpon = $_POST['telpon'];


    $query = "INSERT INTO tb_pelanggan (kode_pelanggan, nama, alamat, telpon) values('$kode','$nama','$alamat','$telpon')";
    $execute = bisa($koneksi, $query);
    if ($execute == 1) {
        $success = 'true';
        $title = 'Berhasil';
        $message = 'Berhasil Simpan Data  ' .$nama ;
        $type = 'success';
        header('location: pelanggan.php?crud=' . $success . '&msg=' . $message . '&type=' . $type . '&title=' . $title);
    } else {
        echo "Gagal Tambah Data";
    }
}

require 'layout_header.php';
?>
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Master pelanggan</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="pelanggan.php">pelanggan</a></li>
                <li><a href="#">Tambah pelanggan</a></li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-6">
                        <a href="javascript:void(0)" onclick="window.history.back();" class="btn btn-primary box-title"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button id="btn-refresh" class="btn btn-primary box-title text-right" title="Refresh Data"><i class="fa fa-refresh" id="ic-refresh"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <form method="POST">
                <div class="form-group">
                        <label>Kode Pelanggan</label>
                        <input type="text" class="form-control" name="kode" value="<?php echo $format; ?>" readonly placeholder="Masukkan Kode Pelanggan">
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Pelanggan">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" rows="3" name="alamat" placeholder="Masukkan Alamat Pelanggan"></textarea>
                    </div>
                    <div class="form-group">
                        <label>No. Telpon</label>
                        <input type="number" class="form-control" name="telpon" placeholder="Masukkan No. Telpon Pelanggan">
                    </div>
                    <div class="text-right">
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require 'layout_footer.php';
?>