<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../../config/koneksi.php';
$ambilmodel = "SELECT * FROM model ORDER BY id_model DESC";
$model = mysqli_query($conn, $ambilmodel);
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
    <div>
      <h2>Admin Panel</h2>
    </div>
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
        <table>
          <tr>
            <th>No</th>
            <th>Nama Model</th>
            <th>Harga Model</th>
            <th>Foto</th>
            <th>Action</th>
          </tr>
          <?php 
          $no = 1;
          if(mysqli_num_rows($model) > 0){
            while($row = mysqli_fetch_assoc($model)){ 
          ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama_model']; ?></td>
            <td><?= $row['harga_model']; ?></td>
            <td>
              <img src="../../uploads/<?= $row['foto_model']; ?>" alt="" width="80">
            </td>
            <td><a href="editmodel.php?id=<?= $row['id_model'] ?>">Edit</a> |
            <a href="hapusmodel.php?id=<?php echo $row['id_model'] ?>" onclick="return confirm('Yakin ingin menghapus model ini?')">Hapus</a></td>
          </tr>
          <?php
            }
          } ?>
        </table>
      </div>
    </section>
  </div>

</body>
</html>