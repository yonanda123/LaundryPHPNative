<?php
$title = 'pengguna';
require 'koneksi.php';

if (isset($_POST['simpan'])) {
    $username = $_POST['username'];
    $nama_user = $_POST['nama_user'];
    $password = $_POST['password'];
    $hak_akses = $_POST['hak_akses'];
    $outlet = $_POST['outlet'];

    $foto = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];

    $upload = move_uploaded_file($lokasi, "images/" . $foto);

    if ($upload) {
        $query = "INSERT INTO tb_user (username, nama_user, password ,id_outlet, level, foto) 
        values('$username','$nama_user','$password','$outlet','$hak_akses','$foto')";

        $execute = bisa($koneksi, $query);
        if ($execute == 1) {
            $success = 'true';
            $title = 'Berhasil';
            $message = 'Berhasil Simpan Data  ' . $hak_akses;
            $type = 'success';
            header('location: pengguna.php?crud=' . $success . '&msg=' . $message . '&type=' . $type . '&title=' . $title);
        } else {
            echo "Gagal Tambah Data";
        }
    }
}
require 'layout_header.php';
?>
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Master Pengguna</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="outlet.php">Pengguna</a></li>
                <li><a href="#">Tambah Pengguna</a></li>
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
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan Username">
                    </div>
                    <div class="form-group">
                        <label>Nama Pengguna</label>
                        <input type="text" name="nama_user" class="form-control" placeholder="Masukkan Nama Pengguna ">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" name="password" class="form-control" placeholder="Masukkan Password">
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select name="hak_akses" class="form-control">
                            <option selected disabled>Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="owner">Owner</option>
                            <option value="kasir">Kasir</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Outlet</label>
                        <select class="form-control select2" style="width: 100%;" name="outlet" required>
                            <option selected disabled>-Pilih outlet-</option>
                            <?php
                            $sql = $koneksi->query("select * from tb_outlet");
                            while ($data = $sql->fetch_assoc()) {
                                echo "
                                        <option value='$data[nama_outlet]'>$data[nama_outlet]</option>
                                    ";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="image-preview" id="imagePreview">
                            <img src="" alt="Image Priview" class="image-preview__image">
                            <span class="image-preview__default-text">Image Priview</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="foto" id="inpFile">
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