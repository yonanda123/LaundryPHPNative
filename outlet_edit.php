<?php
$title = 'outlet';
require 'koneksi.php';

$kode = $_GET['id'];
$sql = $koneksi->query("select * from tb_outlet where kode_outlet= '$kode' ");
$data = $sql->fetch_assoc();

if (isset($_POST['simpan'])) {
    $kode_outlet = $_POST['kode_outlet'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telpon = $_POST['telpon'];

    $query = "UPDATE tb_outlet SET nama_outlet='$nama', alamat='$alamat', telpon='$telpon' where kode_outlet='$kode'";
    $execute = bisa($koneksi, $query);
    if ($execute == 1) {
        $success = 'true';
        $title = 'Berhasil';
        $message = 'Berhasil Edit Data  ' .$nama;
        $type = 'success';
        header('location: outlet.php?crud=' . $success . '&msg=' . $message . '&type=' . $type . '&title=' . $title);
    } else {
        echo "Gagal Tambah Data";
    }
}

require 'layout_header.php';
?>
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Master Outlet</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="outlet.php">Outlet</a></li>
                <li><a href="#">Tambah Outlet</a></li>
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
                        <label>Kode Otlet</label>
                        <input type="text" name="kode_outlet" value="<?php echo $data['id_outlet']; ?>" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nama Outlet</label>
                        <input type="text" name="nama" class="form-control" value="<?php echo $data['nama_outlet'] ?>" placeholder="Masukkan Nama Outlet">
                    </div>
                    <div class="form-group">
                        <label>Alamat Outlet</label>
                        <textarea name="alamat" class="form-control" placeholder="Masukkan Alamat Outlet" ><?php echo $data['alamat'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="number" name="telpon" class="form-control" value="<?php echo $data['telpon'] ?>" placeholder="Masukkan No. Telpon">
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