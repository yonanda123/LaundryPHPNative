<?php
$title = 'paket';
require 'koneksi.php';

$sql = $koneksi->query("select kode_paket from tb_paket order by kode_paket desc");
$data = $sql->fetch_assoc();
$kode_paket = $data['kode_paket'];
$urut = substr($kode_paket, 4, 4);
$tambah = (int) $urut + 1;

if (strlen($tambah) == 1) {
    $format = "PKT-" . "000" . $tambah;
} elseif (strlen($tambah) == 2) {
    $format = "PKT-" . "00" . $tambah;
} elseif (strlen($tambah) == 3) {
    $format = "PKT-" . "0" . $tambah;
} else {
    $format = "PKT-" . $tambah;
}

$outlet = $_POST['outlet'];
$pecah_outlet = explode(".", $outlet);
$id_outlet = $pecah_outlet[0];
$nama_outlet = $pecah_outlet[1];

if (isset($_POST['simpan'])) {
    $kode_paket = $_POST['kode_paket'];
    $jenis = $_POST['jenis'];
    $harga = $_POST['harga'];
    $kg = $_POST['kg'];

    $query = "INSERT INTO tb_paket (kode_paket, id_outlet, nama_outlet , jenis, harga, kg) values('$kode_paket','$id_outlet','$nama_outlet','$jenis','$harga','$kg')";
    $execute = bisa($koneksi, $query);
    if ($execute == 1) {
        $success = 'true';
        $title = 'Berhasil';
        $message = 'Berhasil Simpan Data  ' . $jenis;
        $type = 'success';
        header('location: paket.php?crud=' . $success . '&msg=' . $message . '&type=' . $type . '&title=' . $title);
    } else {
        echo "Gagal Tambah Data";
    }
}

require 'layout_header.php';
?>
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Master Paket</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="paket.php">Paket</a></li>
                <li><a href="#">Tambah Paket</a></li>
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
                        <label>Kode paket</label>
                        <input type="text" class="form-control" name="kode_paket" value="<?php echo $format; ?>" readonly placeholder="Masukkan Kode paket">
                    </div>
                    <div class="form-group">
                        <label>Nama Outlet</label>
                        <select class="form-control select2" style="width: 100%;" name="outlet" required>
                            <option selected disabled>-Pilih outlet-</option>
                            <?php
                            $sql = $koneksi->query("select * from tb_outlet");
                            while ($data = $sql->fetch_assoc()) {
                                echo "
                                        <option value='$data[kode_outlet].$data[nama_outlet]'>$data[nama_outlet]</option>
                                    ";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jenis</label>
                        <input type="text" class="form-control" name="jenis" placeholder="Masukkan Jenis paket">
                    </div>
                    <div class="form-group">
                        <label>Per Kg</label>
                        <input type="number" class="form-control" name="kg" placeholder="Masukkan Pakaian Per Kg">
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" class="form-control" name="harga" placeholder="Masukkan Harga paket">
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