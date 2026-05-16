<?php
// backend/admin/kelola_pesan.php
// Tandai pesan sudah dibaca ATAU hapus pesan — dipanggil dari dashboard admin

session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../pages/auth/Signin.php'); exit;
}
$conn = require '../koneksi.php';

$aksi = $_POST['aksi'] ?? '';          // 'baca' | 'hapus'
$id   = (int)($_POST['id'] ?? 0);

if ($id <= 0) {
    header('Location: ../../pages/admin/dashboard.php?error=' . urlencode('ID tidak valid.')); exit;
}

if ($aksi === 'baca') {
    $stmt = mysqli_prepare($conn, "UPDATE pesan_kontak SET sudah_baca=1 WHERE id=?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    $ok  = mysqli_stmt_execute($stmt);
    $msg = $ok ? 'Pesan ditandai sudah dibaca.' : 'Gagal memperbarui status pesan.';
    $param = $ok ? 'success=' . urlencode($msg) : 'error=' . urlencode($msg);

} elseif ($aksi === 'hapus') {
    $stmt = mysqli_prepare($conn, "DELETE FROM pesan_kontak WHERE id=?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    $ok  = mysqli_stmt_execute($stmt);
    $msg = $ok ? 'Pesan berhasil dihapus.' : 'Gagal menghapus pesan.';
    $param = $ok ? 'success=' . urlencode($msg) : 'error=' . urlencode($msg);

} else {
    $param = 'error=' . urlencode('Aksi tidak dikenali.');
}

header("Location: ../../pages/admin/dashboard.php?$param");
exit;