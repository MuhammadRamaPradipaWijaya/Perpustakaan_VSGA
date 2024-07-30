<?php
include 'config.php';

$judul = $_POST['judul'];
$penulis = $_POST['penulis'];
$kategori = $_POST['kategori'];
$tahun_terbit = $_POST['tahun_terbit'];
$penerbit = $_POST['penerbit'];
$deskripsi = $_POST['deskripsi'];

// File gambar
$gambar_name = $_FILES['gambar']['name'];
$gambar_tmp = $_FILES['gambar']['tmp_name'];
$gambar_extension = pathinfo($gambar_name, PATHINFO_EXTENSION);
$gambar_new_name = uniqid('img_') . '.' . $gambar_extension;
$gambar_path = "uploads/gambar/" . $gambar_new_name;

// File PDF
$pdf_name = $_FILES['pdf']['name'];
$pdf_tmp = $_FILES['pdf']['tmp_name'];
$pdf_extension = pathinfo($pdf_name, PATHINFO_EXTENSION);
$pdf_new_name = uniqid('pdf_') . '.' . $pdf_extension;
$pdf_path = "uploads/pdf/" . $pdf_new_name;

// Pindahkan file gambar dan PDF ke folder uploads/
move_uploaded_file($gambar_tmp, $gambar_path);
move_uploaded_file($pdf_tmp, $pdf_path);

$stmt = $conn->prepare("INSERT INTO buku (judul, penulis, kategori, tahun_terbit, penerbit, deskripsi, gambar, pdf) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $judul, $penulis, $kategori, $tahun_terbit, $penerbit, $deskripsi, $gambar_path, $pdf_path);

if ($stmt->execute() === TRUE) {
    header("Location: koleksi.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
