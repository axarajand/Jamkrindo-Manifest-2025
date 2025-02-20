<?php
session_start();
include 'koneksi.php';

if (!isset($_GET['user_nama_lengkap']) || empty(trim($_GET['user_nama_lengkap']))) {
    $_SESSION['swal_message'] = "<p><b>Nama tidak valid!</b></p>";
    $_SESSION['swal_icon'] = "warning";
    header("Location: ../index.php");
    exit;
}

$user_nama_lengkap = trim($_GET['user_nama_lengkap']);

$stmt = $koneksi->prepare("INSERT INTO tb_absen (absen_nama_lengkap) VALUES (?)");
$stmt->bind_param("s", $user_nama_lengkap);

if ($stmt->execute()) {
    $_SESSION['swal_message'] = "<p><b>Checkpoint berhasil!</b><br>Terima kasih, {$user_nama_lengkap}!</p>";
    $_SESSION['swal_icon'] = "success";
} else {
    $_SESSION['swal_message'] = "<p><b>Checkpoint gagal!</b><br>Silakan coba lagi.</p>";
    $_SESSION['swal_icon'] = "error";
}

$stmt->close();
$koneksi->close();
header("Location: ../index.php#absensi");
exit;
?>
