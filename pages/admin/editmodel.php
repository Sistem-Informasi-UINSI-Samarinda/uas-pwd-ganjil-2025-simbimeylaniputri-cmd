<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../../config/koneksi.php';

if(isset($_GET['id'])){
    $id_model = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM model WHERE id_model = '$id_model'");
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        echo "<script>
            alert('Data model tidak ditemukan!');
            window.location.href='model.php';
        </script>";
        exit();
    }
} else {
    echo "<script>
        alert('ID model tidak ditemukan!');
        window.location.href='model.php';
    </script>";
    exit();
}

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
    <section class="cards">
                    <form class="edit-form" action="" method="POST" enctype="multipart/form-data">
                <label class="label-edit" for="">Nama Model</label> <br>
                <input class="edit-input" type="text" name="nama_model" value="<?php echo $data['nama_model'] ?>" placeholder="isikan nama model" required>
                <br>
                <label class="label-edit" for="">Deskripsi Model</label> <br>
                <textarea class="edit-textarea" minlength="160" maxlength="255" name="deskripsi_model" rows="15" cols="70"><?php echo $data['deskripsi_model'] ?></textarea>
                <br>
                <label class="label-edit" for="">Harga Model</label> <br>
                <input class="edit-input" type="text" name="harga_model" value="<?php echo $data['harga_model'] ?>" placeholder="isikan harga model" required>
                <br>
                <br>
                <label class="label-edit" for="">Tanggal Rilis Model</label> <br>
                <input class="edit-input" type="date" name="tanggal_rilis_model" value="<?php echo $data['tanggal_rilis_model'] ?>">
                <br>
                <br>

                <label class="label-edit" for="">Gambar Model</label> <br>
                <img src="../../uploads/<?= $data['foto_model'] ?>" width="120">
                <input class="edit-input" type="file" name="foto_model" >

                <br>
                <button class="edit-simpan" type="submit" name="simpan">Simpan Model</button>
            </form>
    </section>
  </div>
<?php 

if(isset($_POST['simpan'])){
        $nama_model = $_POST['nama_model'];
        $deskripsi_model = $_POST['deskripsi_model'];
        $harga_model = $_POST['harga_model'];
        $tanggal_rilis_model = $_POST['tanggal_rilis_model'];

         if($_FILES['foto_model']['name'] != ""){
        $foto = $_FILES['foto_model']['name'];
        $tmp = $_FILES['foto_model']['tmp_name'];
        $folder = '../../uploads/';
        $foto_model = uniqid() . "_" . $foto;

        move_uploaded_file($tmp, $folder . $foto_model);

        $query = "
            UPDATE model 
            SET nama_model = '$nama_model',
                deskripsi_model = '$deskripsi_model',
                harga_model = '$harga_model',
                tanggal_rilis_model = '$tanggal_rilis_model',
                foto_model = '$foto_model'
            WHERE id_model = '$id_model'
        ";
    } else {
            $query = "
            UPDATE model 
            SET nama_model = '$nama_model',
                deskripsi_model = '$deskripsi_model',
                harga_model = '$harga_model',
                tanggal_rilis_model = '$tanggal_rilis_model'
            WHERE id_model = '$id_model'
        ";
    }

    if(mysqli_query($conn, $query)){
        header("Location: model.php");
        exit();
    }
    else{
        echo "Gagal menambahkan data: ". mysqli_error($conn);
    }
}
?>

</body>
</html>