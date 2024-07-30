<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id_buku = $_GET['id'];

    $sql = "SELECT * FROM buku WHERE id = $id_buku";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Buku tidak ditemukan";
        exit;
    }
} else {
    echo "Parameter ID buku tidak ditemukan";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Perpustakaan || Detail Buku: <?php echo $row['judul']; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f5f2f2;
        }

        * { font-family: 'PT Sans', sans-serif; }
        @media (max-width: 768px) {
            #nav-deskripsi { padding-left: 50px; }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
        <img src="./img/book.gif" width="40" height="40" class="d-inline-block align-top rounded-circle" alt="Logo Perpustakaan">Perpustakaan</img>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
                aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link active" href="koleksi.php">Koleksi</a></li>
                    <li class="nav-item"><a class="nav-link active" href="kontak.php">Kontak</a></li>
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

    <section><br>
        <div class="container">
            <div class="row">
                <div class="col-md-5 offset-md-2"><br><br>
                <a href="koleksi.php" class="text-decoration-none" style="color: black;"><i class="fas fa-arrow-left"></i> Kembali</a><hr>
                    <div class="pro-img-details" style="width: 80%; height: 400px; overflow: hidden; border-radius: 10px; border: 2px solid black;">
                        <img src="<?php echo $row['gambar']; ?>" alt="" style="width: 100%; height: 100%; border-radius: 10px; border: 2px solid black;">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="product-details">
                        <br><br><br>
                        <div>
                            <hr style="width: 70%;">
                            <div class="card" style="width: 70%; background-color: #f8f9fa;">
                                <div class="card-body">
                                    <h6 style="margin-bottom: 15px; font-size: 20px; color: #1a6692;"><?php echo $row['judul']; ?></h6>
                                    <h6 style="margin-bottom: 15px;">Penulis: <?php echo $row['penulis']; ?></h6>
                                    <h6 style="margin-bottom: 15px;">Tahun Terbit: <?php echo $row['tahun_terbit']; ?></h6>
                                    <h6 style="margin-bottom: 15px;">Penerbit: <?php echo $row['penerbit']; ?></h6>
                                    <h6 style="margin-bottom: 15px;">Kategori: <?php echo $row['kategori']; ?></h6>
                                    <a href="<?php echo $row['pdf']; ?>" target="_blank" class="btn btn-danger mt-3">Lihat</a>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 offset-md-2" style="width: 80%;">
                    <hr>
                    <div class="product-description">
                        <h5>Deskripsi</h5>
                        <div class="tab-content" id="nav-tabContent" style="width: 80%;">
                            <a style="white-space: pre-line;">
                                <?php echo $row['deskripsi']; ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><br><br>

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

    <script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
