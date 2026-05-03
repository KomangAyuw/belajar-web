<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../pages/auth/Signin.php');
    exit;
}
$username = htmlspecialchars($_SESSION['username'] ?? 'User');
$email = htmlspecialchars($_SESSION['email'] ?? '');
$initial = strtoupper(substr($username, 0, 1));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlowCare - Dashboard User</title>
    <link rel="stylesheet" href="../../asset/css/style.css">
</head>
<body>
    <header>
        <div class="logo">GlowCare Clinic</div>
        <nav>
            <a href="../../index.php">Beranda</a>
            <a href="../../jadwal.php">Jadwal</a>
            <a href="../../pages/auth/Signin.php">Akun</a>
            <a href="../../bacckend/logout.php" class="btn">Logout</a>
        </nav>
    </header>
    <main>
        <section class="hero">
            <div class="hero-left">
                <div class="profile-card">
                    <div class="profile-content">
                        <p class="profile-badge">GlowCare Clinic
                        <h1 class="hero-title">Halo, <em><?php echo $username; ?></em></h1>
                        <p class="hero-text">Selamat datang di dashboard GlowCare. Kelola booking, lihat status layanan dan informasi akunmu di satu tempat.</p>
                    </div>
                </div>
                <div class="hero-buttons">
                    <a href="../../pages/auth/Signin.php" class="btn-primary">Ubah Password</a>
                    <a href="../../bacckend/logout.php" class="btn-secondary">Keluar</a>
                </div>
            </div>
            <div class="hero-right">
                <img src="../../asset/img/beauty2.png" alt="Dashboard User" />
            </div>
        </section>

        <section id="dashboard">
            <h2 class="section-header">Profil dan Booking</h2>
            <p class="section-subheader">Informasi akun Anda tertera di bawah ini. Silakan cek status booking terbaru dan detail profil.</p>

            <div class="services-grid">
                <div class="service-card">
                    <div class="service-body">
                        <h3 class="service-name">Profil Saya</h3>
                        <p class="service-desc">Nama: <?php echo $username; ?><br>Email: <?php echo $email; ?><br>Status: Aktif</p>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-body">
                        <h3 class="service-name">Booking Aktif</h3>
                        <p class="service-desc">2 booking aktif. Silakan datang sesuai jadwal dan konfirmasi melalui email Anda.</p>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-body">
                        <h3 class="service-name">Riwayat Treatment</h3>
                        <p class="service-desc">5 treatment selesai. Tetap jaga kesehatan kulit dengan perawatan lanjutan.</p>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-body">
                        <h3 class="service-name">Kepuasan</h3>
                        <p class="service-desc">98% kepuasan pengguna. Terima kasih telah memilih GlowCare Clinic.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>