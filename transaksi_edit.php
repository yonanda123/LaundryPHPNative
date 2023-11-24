<?php
$title = 'transaksi';
require 'koneksi.php';

$id = $_GET['id'];
$sql = $koneksi->query("select * from tb_laundry where id_laundry= '$id' ");
$data = $sql->fetch_assoc();
$proses = $data['proses'];

if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $proses = $_POST['proses'];

    $query = "UPDATE tb_laundry SET proses='$proses' where id_laundry='$id'";
    $execute = bisa($koneksi, $query);
    if ($execute == 1) {
        $success = 'true';
        $title = 'Berhasil';
        $message = 'Berhasil Simpan Data  ' .$proses;
        $type = 'success';
        header('location: transaksi.php?crud=' . $success . '&msg=' . $message . '&type=' . $type . '&title=' . $title);
    } else {
        echo "Gagal Tambah Data";
    }
}
require 'layout_header.php';
?>
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Master transaksi</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="transaksi.php">transaksi</a></li>
                <li><a href="#">Edit transaksi</a></li>
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
                    <div class="box-body">
                        <div class="form-group">
                            <label>Status Proses</label>
                            <select name="proses" class="form-control">
                                <option selected disabled>Pilih Status Laundry</option>
                                <option value="baru" <?php if ($proses == 'baru') {
                                                            echo "selected";
                                                        } ?>>Baru</option>
                                <option value="proses" <?php if ($proses == 'proses') {
                                                            echo "selected";
                                                        } ?>>Proses</option>
                                <option value="selesai" <?php if ($proses == 'selesai') {
                                                            echo "selected";
                                                        } ?>>Selesai</option>
                                <option value="diambil" <?php if ($proses == 'diambil') {
                                                            echo "selected";
                                                        } ?>>Diambil</option>
                            </select>

                            <input type="hidden" value="<?php echo $data['id_laundry'] ?>" class="form-control" name="id">
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