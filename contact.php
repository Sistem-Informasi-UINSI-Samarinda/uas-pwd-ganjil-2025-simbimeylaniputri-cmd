<?php include 'includes/meta.php'; ?>
<?php include 'includes/header.php'; ?>

<main>
        <section>
            <h2>Hubungi Kami</h2>
            <p>Untuk pertanyaan seputar produk atau kolaborasi, silakan isi formulir di bawah ini.</p>
            
            <form action="#" method="POST" class="contact-form">
                <div>
                    <label for="name">Nama Lengkap:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="message">Pesan:</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <button type="submit" class="button">Kirim Pesan</button>
            </form>
        </section>
    </main>


<?php include 'includes/footer.php'; ?>