<?php
include 'config.php';

$id_buku = $_POST['id_buku'];

$sql = "DELETE FROM buku WHERE id = '$id_buku'";

if ($conn->query($sql) === TRUE) {
    header("Location: koleksi.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
