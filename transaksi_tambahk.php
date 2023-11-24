<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$title = 'transaksi';

include "koneksi2.php";

session_start();

if ($_SESSION['admin']) {
    $user = $_SESSION['admin'];
} elseif ($_SESSION['kasir']) {
    $user = $_SESSION['kasir'];
} elseif ($_SESSION['owner']) {
    $user = $_SESSION['owner'];
}

$sql_user = $conn->query("select * from tb_user where id='$user'");
$data_user = $sql_user->fetch_assoc();

$id_user = $data_user['id'];

require 'koneksi.php';

$tgl_pinjam = date("Y-m-d");

$sql = $koneksi->query("select id_laundry from tb_laundry order by id_laundry desc");
$data = $sql->fetch_assoc();
$id_laundry = $data['id_laundry'];
$urut = substr($id_laundry, 4, 4);
$tambah = (int) $urut + 1;

if (strlen($tambah) == 1) {
    $format = "DRY-" . "000" . $tambah;
} elseif (strlen($tambah) == 2) {
    $format = "DRY-" . "00" . $tambah;
} elseif (strlen($tambah) == 3) {
    $format = "DRY-" . "0" . $tambah;
} else {
    $format = "DRY-" . $tambah;
}

if (isset($_POST['simpan'])) {
    $pelanggan = $_POST['pelanggan'];
    $outlet = $_POST['outlet'];
    $tgl_terima = $_POST['tgl_terima'];
    $tgl_selesai = $_POST['tgl_selesai'];
    $status = $_POST['status'];
    $diskon = $_POST['diskon'];
    $biaya = $_POST['biaya_tambahan'];
    $id_laundry = $_POST['id_laundry'];

    $paket = $_POST['paket'];
    $pecah_paket = explode(".", $paket);
    $id_paket = $pecah_paket[0];
    $harga = $pecah_paket[1];
    $kg = $pecah_paket[2];

    $query = "INSERT INTO tb_laundry (id_laundry, id_pelanggan, id_outlet, kode_user, tanggal_terima, tanggal_selesai, id_paket, kg, nominal, diskon, biaya_tambahan, proses, status) 
    values('$id_laundry','$pelanggan','$outlet','$id_user','$tgl_terima','$tgl_selesai','$id_paket','$kg','$harga','$diskon','$biaya','baru','$status')";

    $execute = bisa($koneksi, $query);
    if ($execute == 1) {
        $success = 'true';
        $title = 'Berhasil';
        $message = 'Berhasil Simpan Data';
        $type = 'success';
        header('location:transaksik.php?crud=' . $success . '&msg=' . $message . '&type=' . $type . '&title=' . $title);
    } else {
        echo "Gagal Tambah Data";
    }

    if ($status == "lunas") {
        $query = "INSERT INTO tb_transaksi (id_pelanggan, id_outlet, kode_user, tgl_transaksi, id_paket, kg ,nominal, diskon, biaya_tambahan) 
        values('$pelanggan','$outlet','$id_user','$tgl_terima','$id_paket','$kg','$harga','$diskon','$biaya')";
        $execute1 = bisa($koneksi, $query);
        if ($execute1 == 1) {
            $success = 'true';
            $title = 'Berhasil';
            $message = 'Berhasil Simpan Data';
            $type = 'success';
            header('location: transaksik.php?crud=' . $success . '&msg=' . $message . '&type=' . $type . '&title=' . $title);
        } else {
            echo "Gagal Tambah Data";
        }
    }
}
require 'layout_header_kasir.php';

?>
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Master Transaksi</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="transaksi.php">Transaksi</a></li>
                <li><a href="#">Tambah Transaksi</a></li>
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
                        <label>ID Transaksi</label>
                        <input type="text" class="form-control" value="<?php echo $format; ?>" name="id_laundry" readonly placeholder="Masukkan Biaya Tambahan, Jika Tidak Ada Biaya Tambahan Kosongkan Kolom!">
                    </div>
                    <div class="form-group">
                        <label>Nama Pelanggan</label>
                        <select class="form-control select2" style="width: 100%;" name="pelanggan" required>
                            <option selected disabled>-Pilih Pelanggan-</option>
                            <?php
                            $sql = $koneksi->query("select * from tb_pelanggan");
                            while ($data = $sql->fetch_assoc()) {
                                echo "
                                        <option value='$data[kode_pelanggan]'>$data[nama]</option>
                                    ";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Outlet</label>
                        <select class="form-control" name="outlet" id="outlet">
                            <?php
                            include "koneksi3.php";
                            //Perintah sql untuk menampilkan semua data pada tabel jurusan
                            $sql = "select * from tb_outlet";
                            $hasil = mysqli_query($kon, $sql);
                            while ($data = mysqli_fetch_array($hasil)) {
                            ?>
                                <option value="<?php echo $data['kode_outlet']; ?>"><?php echo $data['nama_outlet']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Paket</label>
                        <select class="form-control" name="paket" id="paket">
                            <!-- paket motor akan diload menggunakan ajax, dan ditampilkan disini -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Diskon</label>
                        <input type="number" class="form-control" name="diskon" placeholder="Masukkan Diskon, Jika Tidak Ada Diskon Kosongkan Kolom!">
                    </div>
                    <div class="form-group">
                        <label>Biaya Tambahan</label>
                        <input type="number" class="form-control" name="biaya_tambahan" placeholder="Masukkan Biaya Tambahan, Jika Tidak Ada Biaya Tambahan Kosongkan Kolom!">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Terima</label>
                        <input type="date" class="form-control" name="tgl_terima" value="<?php echo $tgl_pinjam ?>">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Selesai</label>
                        <input type="date" class="form-control" name="tgl_selesai">
                    </div>
                    <div class="form-group">
                        <label>Status Pembayaran</label>
                        <select class="form-control select2" style="width: 100%;" name="status" required>
                            <option selected disabled>-Pilih Status-</option>
                            <option value="lunas">Lunas</option>
                            <option value="belum lunas">Belum Lunas</option>
                        </select>
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
<script>
    $("#outlet").change(function() {
        // variabel dari nilai combo box outlet
        var id_outlet = $("#outlet").val();

        // Menggunakan ajax untuk mengirim dan dan menerima data dari server
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "ambil-data.php",
            data: "outlet=" + id_outlet,
            success: function(data) {
                $("#paket").html(data);
            }
        });
    });
</script>
<?php
require 'layout_footer_kasir.php';
?>