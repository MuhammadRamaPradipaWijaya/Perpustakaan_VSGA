<?php
include 'config.php';

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM buku WHERE judul LIKE '%$search%' OR penulis LIKE '%$search%' OR kategori LIKE '%$search%' OR tahun_terbit LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM buku";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Perpustakaan || Koleksi</title>
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
        <h1 style="text-shadow: 2px 2px 0 white, -2px -2px 0 white, 2px -2px 0 white, -2px 2px 0 white; color: black;">Koleksi Buku-Buku Kami</h1><br>
        <form class="d-flex" action="koleksi.php" method="GET">
            <input class="form-control me-2" type="search" placeholder="Cari buku..." aria-label="Search" name="search" style="max-width: 200px;">
            <button class="btn btn-danger text-white" type="submit">Cari</button>
        </form>
    </div>
    <br>

    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        echo '<div class="d-flex justify-content-end mb-4">
                <button type="button" class="btn btn-square btn-success m-2" data-bs-toggle="modal" data-bs-target="#tambah">+ Tambah Buku</button>
            </div>';
    }
    ?>

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
                            
                            <?php
                            if (session_status() == PHP_SESSION_NONE) {
                                session_start();
                            }

                            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                                echo '<div class="text-center">
                                        <hr>
                                        <button type="button" class="btn btn-square btn-primary m-2" data-bs-toggle="modal" data-bs-target="#edit_' . $row['id'] . '">Edit</button>
                                        <button type="button" class="btn btn-square btn-danger m-2" data-bs-toggle="modal" data-bs-target="#hapus_' . $row['id'] . '">Hapus</button>
                                    </div>';
                            }
                            ?>

                        </div>
                    </div>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="edit_<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel_<?php echo $row['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel_<?php echo $row['id']; ?>">Edit Buku</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="proses_edit_buku.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id_buku" value="<?php echo $row['id']; ?>">
                                        <div class="mb-3">
                                            <label for="edit_judul_<?php echo $row['id']; ?>">Judul</label>
                                            <input type="text" class="form-control" id="edit_judul_<?php echo $row['id']; ?>" name="judul" value="<?php echo $row['judul']; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_penulis_<?php echo $row['id']; ?>" class="form-label">Penulis</label>
                                            <input type="text" class="form-control" id="edit_penulis_<?php echo $row['id']; ?>" name="penulis" value="<?php echo $row['penulis']; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_kategori_<?php echo $row['id']; ?>" class="form-label">Kategori</label>
                                            <input type="text" class="form-control" id="edit_kategori_<?php echo $row['id']; ?>" name="kategori" value="<?php echo $row['kategori']; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_tahun_<?php echo $row['id']; ?>" class="form-label">Tahun Terbit</label>
                                            <input type="number" class="form-control" id="edit_tahun_<?php echo $row['id']; ?>" name="tahun_terbit" value="<?php echo $row['tahun_terbit']; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_penerbit_<?php echo $row['id']; ?>" class="form-label">Penerbit</label>
                                            <input type="text" class="form-control" id="edit_penerbit_<?php echo $row['id']; ?>" name="penerbit" value="<?php echo $row['penerbit']; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_deskripsi_<?php echo $row['id']; ?>" class="form-label">Deskripsi</label>
                                            <textarea class="form-control" id="edit_deskripsi_<?php echo $row['id']; ?>" rows="3" name="deskripsi"><?php echo $row['deskripsi']; ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_gambar_<?php echo $row['id']; ?>" class="form-label">Gambar</label>
                                            <input type="file" class="form-control" id="edit_gambar_<?php echo $row['id']; ?>" name="gambar" accept="image/*">
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_pdf_<?php echo $row['id']; ?>" class="form-label">PDF</label>
                                            <input type="file" class="form-control" id="edit_pdf_<?php echo $row['id']; ?>" name="pdf" accept=".pdf">
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Hapus -->
                    <div class="modal fade" id="hapus_<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="hapus_<?php echo $row['id']; ?>Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapus_<?php echo $row['id']; ?>Label">Konfirmasi Hapus</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus buku "<?php echo $row['judul']; ?>"?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <form action="proses_hapus_buku.php" method="POST">
                                        <input type="hidden" name="id_buku" value="<?php echo $row['id']; ?>">
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="proses_tambah_buku.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" required>
                        </div>
                        <div class="mb-3">
                            <label for="penulis">Penulis</label>
                            <input type="text" class="form-control" id="penulis" name="penulis" required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori">Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="kategori" required>
                        </div>
                        <div class="mb-3">
                            <label for="tahun_terbit">Tahun Terbit</label>
                            <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" required>
                        </div>
                        <div class="mb-3">
                            <label for="penerbit">Penerbit</label>
                            <input type="text" class="form-control" id="penerbit" name="penerbit" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" rows="3" name="deskripsi" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="gambar">Gambar</label>
                            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label for="pdf">File PDF</label>
                            <input type="file" class="form-control" id="pdf" name="pdf" accept="application/pdf" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" name="tambah_buku">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body><br>

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
