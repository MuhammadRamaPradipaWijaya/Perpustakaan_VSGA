<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $kata_sandi = $_POST['kata_sandi'];

    $email = $conn->real_escape_string($email);
    $kata_sandi = $conn->real_escape_string($kata_sandi);

    $sql = "SELECT * FROM pengguna WHERE email = '$email' AND kata_sandi = '$kata_sandi'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $user['email'];
        
        header("Location: koleksi.php");
        exit();
    } else {
        $error = "Email atau kata sandi salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan || Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f5f2f2;
        }

        .container {
            max-width: 400px;
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card"><br>
            <h3 class="text-center">Selamat Datang Admin</h3>
            <div class="card-body">
                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php } ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <a href="index.php" class="text-decoration-none" style="color: black;"><i class="fas fa-arrow-left"></i> Kembali</a><hr>
                    <div class="mb-3"><br>
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="kata_sandi" class="form-label">Kata Sandi</label>
                        <input type="password" class="form-control" id="kata_sandi" name="kata_sandi" required>
                    </div>
                    <button type="submit" class="btn btn-danger">Masuk</button>
                </form><br>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body><br><br>

</html>

<?php
$conn->close();
?>
