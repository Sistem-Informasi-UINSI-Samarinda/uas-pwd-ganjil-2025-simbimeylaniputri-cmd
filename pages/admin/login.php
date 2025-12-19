<?php 
session_start();
include '../../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../assets/css/adminStyles.css">
    <style>
        body {
            background: #f4f6f9;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <?php 
    if(isset($_POST['login'])){
        $input = $_POST['username'];
        $password = $_POST['password'];

        if(filter_var($input, FILTER_VALIDATE_EMAIL)){
            $query = "SELECT * FROM users WHERE email ='$input'";
        } else {
            $query = "SELECT * FROM users WHERE username ='$input'";
        }

        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);

            if(password_verify($password, $row['password'])){
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
                $_SESSION['username'] = $row['username'];

                // arahkan ke admin
                header("Location: dashboard.php");
                exit();
            }
            else {
                echo "<p style='color: red'> Password Salah</p>";
            }
        }
        else{
            echo "<p style='color: red'> Username/email tidak sesuai</p>";
        }
    }
    ?>

    <form class="login-form" method="post" action="">
    <h2 style="text-align: center; margin-bottom: 20px; color: #1E3A8A;">Login Admin</h2>
        <label class="label-login">Username atau Email</label> <br> 
        <input class="input-login" style="width: 380px;" type="text" name="username" placeholder="Masukkan Username Email" required> <br>

        <label class="label-login">Password</label> <br>
        <input class="input-login" style="width: 380px;"  type="password" name="password" placeholder="Masukkan Password" required> <br>
        <br>

        <button class="submit-login" type="submit" name="login">Login</button>
    </form>
    
</body>
</html>