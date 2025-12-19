<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../../config/koneksi.php';
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="../../assets/css/adminStyles.css">
</head>
<body>

  <div class="sidebar">
    <h2>Admin Panel</h2>
    <ul>
      <li><a href="dashboard.php">Dashboard</a></li>
      <li><a href="model.php">Model</a></li>
      <li><a href="logout.php" class="logout">Logout</a></li>
    </ul>
  </div>

  <div class="main-content">
    <header>
        <a href="tambahmodel.php">+ Tambah Model</a>
    </header>

    <section class="cards">
        <div class="card">
            <form class="tambah-form" action="" method="POST" enctype="multipart/form-data">
                <label class="label-tambah" for="">Nama Model</label> <br>
                <input class="tambah-input" type="text" name="nama_model" placeholder="isikan nama model" required>
                <br>
                <br>
                <br>
                
                <label class="label-edit" for="">Deskripsi Model</label> <br>
                <textarea class="tambah-textarea" name="deskripsi_model" rows="15" cols="70"></textarea>
                <br>
                <label class="label-edit" for="">Harga Model</label> <br>
                <input class="tambah-input" type="text" name="harga_model" placeholder="isikan nama model" required>
                
                <br>
                <label class="label-edit" for="">Tanggal Liris Model</label> <br>
                <input class="tambah-input" type="date" name="tanggal_liris_model">

                <label class="label-tambah" for="">Gambar Model</label> <br>
                <input class="tambah-input" type="file" name="foto_model">

                <br>
                <br>
                <button class="tambah-simpan" type="submit" name="simpan">Simpan Model</button>
            </form>
        </div>
    </section>
  </div>

<?php 
    if(isset($_POST['simpan'])){
        $nama_model = $_POST['nama_model'];
        $deskripsi_model = $_POST['deskripsi_model'];
        $harga_model = $_POST['harga_model'];
        $tanggal_rilis_model = $_POST['tanggal_rilis_model'];

        // Upload File
        $foto = $_FILES['foto_model']['name'];
        $tmp = $_FILES['foto_model']['tmp_name'];
        $folder = '../../uploads/';

        // agar nama file unique
        $foto_model = uniqid() .  "_" . $foto;

        // opsional
        if($_FILES['foto_model']['error'] !== UPLOAD_ERR_OK){
            echo "ERROR UPLOAD GAMBAR, KODE: ". $_FILES['foto_model']['error'];
        }
        // eksekusi Upload
        move_uploaded_file($tmp, $folder . $foto_model);

        $query = "
        INSERT INTO model (nama_model, deskripsi_model, harga_model, foto_model, tanggal_rilis_model)
        VALUES ('$nama_model', '$deskripsi_model', '$harga_model','$foto_model', '$tanggal_rilis_model')
        ";

        if(mysqli_query($conn, $query)){
            echo "<script>
                alert('Model Telah di unggah');
                window.location.href='model.php';
            </script>";
        }
        else {
             echo "<script>
                alert('Model Gagal di unggah');
                window.location.href='model.php';
            </script>";
        }
    }
?>

</body>
</html>
