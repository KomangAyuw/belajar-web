<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../pages/auth/Signin.php'); exit;
}
$conn = require '../koneksi.php';

$id           = (int)($_POST['id'] ?? 0);
$nama         = trim($_POST['nama'] ?? '');
$no_str       = trim($_POST['no_str'] ?? '');
$spesialisasi = $_POST['spesialisasi'] ?? 'Other';
$telepon      = trim($_POST['telepon'] ?? '');
$email        = trim($_POST['email'] ?? '');
$pengalaman   = (int)($_POST['pengalaman'] ?? 0);
$rating       = (float)($_POST['rating'] ?? 5.0);
$status       = $_POST['status'] ?? 'Aktif';
$bio          = trim($_POST['bio'] ?? '');

if ($nama === '') {
    header('Location: ../../pages/admin/dashboard.php?error='.urlencode('Nama dokter wajib diisi.')); exit;
}
$rating = min(5.0, max(0.0, $rating));

if ($id > 0) {
    $stmt = mysqli_prepare($conn,
        "UPDATE dokter SET nama=?,no_str=?,spesialisasi=?,telepon=?,email=?,pengalaman=?,rating=?,status=?,bio=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, 'sssssidssi',
        $nama,$no_str,$spesialisasi,$telepon,$email,$pengalaman,$rating,$status,$bio,$id);
    $ok  = mysqli_stmt_execute($stmt);
    $msg = $ok ? 'Data dokter berhasil diperbarui.' : mysqli_error($conn);
    $judul = 'Dokter Diperbarui';
    $desk  = "$nama diperbarui oleh admin.";
} else {
    $stmt = mysqli_prepare($conn,
        "INSERT INTO dokter (nama,no_str,spesialisasi,telepon,email,pengalaman,rating,status,bio) VALUES (?,?,?,?,?,?,?,?,?)");
    mysqli_stmt_bind_param($stmt, 'sssssidss',
        $nama,$no_str,$spesialisasi,$telepon,$email,$pengalaman,$rating,$status,$bio);
    $ok  = mysqli_stmt_execute($stmt);
    $msg = $ok ? 'Dokter baru berhasil ditambahkan.' : mysqli_error($conn);
    $judul = 'Dokter Baru';
    $desk  = "$nama ditambahkan oleh admin.";
}

if ($ok) {
    $uid  = (int)$_SESSION['user_id'];
    $tipe = 'Dokter';
    $log  = mysqli_prepare($conn, "INSERT INTO log_aktivitas (user_id,tipe,judul,deskripsi,referensi_tabel) VALUES (?,?,?,?,'dokter')");
    mysqli_stmt_bind_param($log, 'isss', $uid, $tipe, $judul, $desk);
    mysqli_stmt_execute($log);
}

$param = $ok ? 'success='.urlencode($msg) : 'error='.urlencode($msg);
header("Location: ../../pages/admin/dashboard.php?$param");
exit;