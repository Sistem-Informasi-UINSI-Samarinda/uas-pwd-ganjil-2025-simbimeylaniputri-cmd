<?php include 'includes/meta.php'; ?>
<?php include 'includes/header.php'; ?>

<?php 
include 'config/koneksi.php';

$tes = "SELECT * FROM model";

$model = mysqli_query($conn, $tes);
?>


<main>
        <section>
            <h2>Katalog Sepatu</h2>
            <p>Jelajahi pilihan terbaik kami berdasarkan gaya dan fungsi.</p>
            
            <div class="grid-container">
                <?php while($data = mysqli_fetch_assoc($model)) { ?>
                    <article class="grid-item">
                        <img src="uploads/<?= $data["foto_model"] ?>" alt="Sepatu">
                        <h4><?= $data["nama_model"] ?></h4>
                        <p><?= $data["deskripsi_model"] ?></p>
                        <a href="#" class="button"><?= $data["harga_model"] ?></a>
                    </article>
                <?php } ?>
            </div>
        </section>
    </main>



<?php include 'includes/footer.php'; ?>