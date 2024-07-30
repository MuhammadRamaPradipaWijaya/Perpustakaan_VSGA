<?php
session_start();

// Hapus semua variabel sesi
session_unset();

// Hapus sesi
session_destroy();

header("Location: index.php");
exit();
?>
