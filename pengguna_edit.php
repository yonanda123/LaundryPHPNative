<?php
$title = 'pengguna';
require 'koneksi.php';

$id = $_GET['id'];
$sql = $koneksi->query("select * from tb_user where id= '$id' ");
$data = $sql->fetch_assoc();
$hak_akses = $data['level'];

if (isset($_POST['simpan'])) {
    $username = $_POST['username'];
    $nama_user = $_POST['nama_user'];
    $password = $_POST['password'];
    $hak_akses = $_POST['hak_akses'];
    $outlet = $_POST['outlet'];

    $foto = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name']; 

    if (!empty($lokasi)) {

        move_uploaded_file($lokasi, "images/" . $foto);
        $query = "UPDATE tb_user SET username='$username', nama_user='$nama_user', password='$password', id_outlet='$outlet' , level='$hak_akses', foto='$foto' where id='$id'";
        $execute = bisa($koneksi,$query);
        if ($execute == 1) {
            $success = 'true';
            $title = 'Berhasil';
            $message = 'Berhasil Edit Data  ' .$hak_akses;
            $type = 'success';
            header('location: pengguna.php?crud=' . $success . '&msg=' . $message . '&type=' . $type . '&title=' . $title);
        } else {
            echo "Gagal Tambah Data";
        }
    } else {
        $query = "UPDATE tb_user SET username='$username', nama_user='$nama_user', password='$password', id_outlet='$outlet' , level='$hak_akses' where id='$id'";
        $execute = bisa($koneksi,$query);
        if ($execute == 1) {
            $success = 'true';
            $title = 'Berhasil';
            $message = 'Berhasil Edit Data  ' .$hak_akses;
            $type = 'success';
            header('location: pengguna.php?crud=' . $success . '&msg=' . $message . '&type=' . $type . '&title=' . $title);
        }else{
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
                        <input type="text" name="username" class="form-control" value="<?php echo $data['username']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Nama Pengguna</label>
                        <input type="text" name="nama_user" class="form-control" value="<?php echo $data['nama_user']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" name="password" class="form-control" value="<?php echo $data['password']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Nama Outlet</label>
                        <select class="form-control select2" style="width: 100%;" name="outlet" required>
                            <option selected disabled><?php echo $data['id_outlet'] ?></option>
                            <?php
                            $sql = $koneksi->query("select * from tb_outlet");
                            while ($dat = $sql->fetch_assoc()) {
                                echo "
                                        <option value='$dat[nama_outlet]'>$dat[nama_outlet]</option>
                                    ";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select name="hak_akses" class="form-control">
                            <option value="admin" <?php if ($hak_akses == 'admin') {
                                                        echo "selected";
                                                    } ?>>Admin</option>
                            <option value="kasir" <?php if ($hak_akses == 'kasir') {
                                                        echo "selected";
                                                    } ?>>Kasir</option>
                            <option value="owner" <?php if ($hak_akses == 'owner') {
                                                        echo "selected";
                                                    } ?>>Owner</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><img src="images/<?php echo $data['foto'] ?>" width="150" height="150" alt=""></label>
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="foto"> 
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