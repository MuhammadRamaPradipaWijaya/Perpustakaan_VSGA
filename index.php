<?php
include 'config.php';

$sql = "SELECT * FROM buku ORDER BY tahun_terbit DESC LIMIT 4";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Perpustakaan || Beranda</title>

    <style>
        * {
            font-family: 'PT Sans', sans-serif;
        }

        body {
            background-color: #f5f2f2;
        }

        .mytitle {
            width: 100%;
            height: 250px;
            background-image: linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://asset.kompas.com/crops/fPl5r1G3KXbskdrjrJxk1InCebc=/429x39:5529x3439/780x390/data/photo/2021/05/10/609931bb5334c.jpg');
            background-position: center;
            background-size: cover;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .mytitle>button {
            width: 200px;
            height: 50px;
            background-color: transparent;
            color: white;
            border-radius: 50px;
            border: 1px solid white;
            margin-top: 10px;
        }

        .mytitle>button:hover {
            border: 2px solid red;
        }

        .mycards {
            margin: 20px auto 0px auto;
            width: 95%;
            max-width: 1200px;
        }

        .mybtns {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }

        .mybtns>button {
            margin-right: 10px;
        }
    </style>

</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">
        <img src="./img/book.gif" width="40" height="40" class="d-inline-block align-top rounded-circle" alt="Logo Perpustakaan">Perpustakaan</img>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="koleksi.php">Koleksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="kontak.php">Kontak</a>
                </li>

                <?php
                session_start();
                
                if (isset($_SESSION['email'])) {
                    echo '
                    <li class="nav-item">
                        <a class="btn btn-square btn-danger" href="logout.php">Keluar</a>
                    </li>';
                } else {
                    echo '
                    <li class="nav-item">
                        <a href="login.php" class="btn btn-square btn-danger">Masuk</a>
                    </li>';
                }
                ?>

            </ul>
        </div>
    </div>
</nav>

<body><br><br>
    <div class="mytitle">
        <h1 style="text-shadow: 2px 2px 0 white, -2px -2px 0 white, 2px -2px 0 white, -2px 2px 0 white; color: black;">Selamat Datang di Perpustakaan Kami</h1>
        <button><a href="koleksi.php" class="text-decoration-none" style="color: white;">Cari Buku</a></button>
    </div><br>
    <h3 style="margin-left: 30px;">Buku Terbaru</h3>
    <div class="mycards">
        <div class="row row-cols-1 row-cols-md-4 g-4">

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="col">
                        <div class="card h-100">
                            <a href="detail_buku.php?id=<?php echo $row['id']; ?>">
                                <img src="<?php echo $row['gambar']; ?>" alt="" style="width: 100%; height: 300px; object-fit: cover; border-radius: 10px;">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title text-truncate" style="color: #1a6692;"><?php echo $row['judul']; ?></h5>
                                <h6 class="card-title text-truncate"><?php echo $row['penulis']; ?></h6>
                                <p class="card-text text-truncate"><?php echo $row['deskripsi']; ?></p>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "Buku tidak ditemukan";
            }
            ?>
            
        </div>
    </div>
    <br>
    <br>
    <script src="js/bootstrap.min.js"></script>
</body>

<footer class="bg-secondary text-white py-4">
    <div class="container text-center">
        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0">
                <h5>Perpustakaan</h5>
                <p>Jl. Mastrip, Kabupaten Jember, Jawa Timur</p>
            </div>
            <div class="col-md-6">
                <h5>Kontak Kami</h5>
                <p>Email: admin@perpustakaan.com | Telepon: (021) 123-4567</p>
            </div>
        </div>
        <div class="mt-3">
            <p>&copy; 2024 Perpustakaan. All rights reserved.</p>
        </div>
    </div>
</footer>

</html>

<?php
$conn->close();
?>
