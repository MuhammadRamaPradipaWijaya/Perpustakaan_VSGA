<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Perpustakaan || Kontak</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
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

        .icon-circle {
            border: 2px solid #000;
            padding: 20px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
        }
    
        .text-muted {
            color: #515151;
        }
    
        .ml-2 {
            margin-left: 10px;
        }
    
        .mb-3 {
            margin-bottom: 1rem;
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
        <h1 style="text-shadow: 2px 2px 0 white, -2px -2px 0 white, 2px -2px 0 white, -2px 2px 0 white; color: black;">Kontak Kami</h1>
    </div>

    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-9"></div>
                <div class="row w-100">
                    <div class="col-lg-6 my-4">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.424154373016!2d113.72049837427969!3d-8.159949781753275!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd695b617d8f623%3A0xf6c4437632474338!2sState%20Polytechnic%20of%20Jember!5e0!3m2!1sen!2sid!4v1721093766885!5m2!1sen!2sid" class="w-100" height="400" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="col-lg-6 my-4 d-flex align-items-center">
                        <ul class="social-icons list-unstyled">
                            <li class="mb-3">
                                <a href="#" class="d-flex align-items-start text-decoration-none">
                                    <span class="icon-circle">
                                        <i class="fas fa-map-marker-alt" style="color: red;"></i>
                                    </span>
                                    <div class="ml-2 text-muted">
                                        Jl. Mastrip, Kabupaten Jember, Jawa Timur
                                    </div>
                                </a>
                            </li>
                            <li class="mb-3">
                                <a href="#" class="d-flex align-items-start text-decoration-none">
                                    <span class="icon-circle">
                                        <i class="fab fa-whatsapp" style="color: red;"></i>
                                    </span>
                                    <div class="ml-2 text-muted">
                                        (021) 123-4567
                                    </div>
                                </a>
                            </li>
                            <li class="mb-3">
                                <a href="#" class="d-flex align-items-start text-decoration-none">
                                    <span class="icon-circle">
                                        <i class="fab fa-instagram" style="color: red;"></i>
                                    </span>
                                    <div class="ml-2 text-muted">
                                        perpustakaan_buku
                                    </div>
                                </a>
                            </li>
                            <li class="mb-3">
                                <a href="#" class="d-flex align-items-start text-decoration-none">
                                    <span class="icon-circle">
                                        <i class="fab fa-tiktok" style="color: red;"></i>
                                    </span>
                                    <div class="ml-2 text-muted">
                                        @perpustakaan_buku
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

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