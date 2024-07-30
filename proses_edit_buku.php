<?php
include 'config.php';

$id_buku = $_POST['id_buku'];
$judul = $_POST['judul'];
$penulis = $_POST['penulis'];
$kategori = $_POST['kategori'];
$tahun_terbit = $_POST['tahun_terbit'];
$penerbit = $_POST['penerbit'];
$deskripsi = $_POST['deskripsi'];

// File gambar jika diubah
if ($_FILES['gambar']['size'] > 0) {
    $gambar_name = $_FILES['gambar']['name'];
    $gambar_tmp = $_FILES['gambar']['tmp_name'];
    $gambar_extension = pathinfo($gambar_name, PATHINFO_EXTENSION);
    $gambar_new_name = uniqid('img_') . '.' . $gambar_extension;
    $gambar_path = "uploads/gambar/" . $gambar_new_name;

    move_uploaded_file($gambar_tmp, $gambar_path);

    $sql_update_gambar = "UPDATE buku SET gambar=? WHERE id=?";
    $stmt_gambar = $conn->prepare($sql_update_gambar);
    $stmt_gambar->bind_param("si", $gambar_path, $id_buku);
    $stmt_gambar->execute();
    $stmt_gambar->close();
}

// File PDF jika diubah
if ($_FILES['pdf']['size'] > 0) {
    $pdf_name = $_FILES['pdf']['name'];
    $pdf_tmp = $_FILES['pdf']['tmp_name'];
    $pdf_extension = pathinfo($pdf_name, PATHINFO_EXTENSION);
    $pdf_new_name = uniqid('pdf_') . '.' . $pdf_extension;
    $pdf_path = "uploads/pdf/" . $pdf_new_name;

    move_uploaded_file($pdf_tmp, $pdf_path);

    $sql_update_pdf = "UPDATE buku SET pdf=? WHERE id=?";
    $stmt_pdf = $conn->prepare($sql_update_pdf);
    $stmt_pdf->bind_param("si", $pdf_path, $id_buku);
    $stmt_pdf->execute();
    $stmt_pdf->close();
}

$sql_update_buku = "UPDATE buku SET judul=?, penulis=?, kategori=?, tahun_terbit=?, penerbit=?, deskripsi=? WHERE id=?";
$stmt_update = $conn->prepare($sql_update_buku);
$stmt_update->bind_param("ssssssi", $judul, $penulis, $kategori, $tahun_terbit, $penerbit, $deskripsi, $id_buku);

if ($stmt_update->execute()) {
    header("Location: koleksi.php");
    exit();
} else {
    echo "Error: " . $stmt_update->error;
}

$stmt_update->close();
$conn->close();
?>
