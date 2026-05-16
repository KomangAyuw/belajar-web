<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../pages/auth/Signin.php');
    exit;
}
$conn = require_once '../../backend/koneksi.php';

// ── Statistik ──
$total_pasien     = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS n FROM pasien"))['n'];
$dokter_aktif     = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS n FROM dokter WHERE status='Aktif'"))['n'];
$appt_hari_ini    = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS n FROM appointment WHERE tanggal=CURDATE()"))['n'];
$pendapatan_bulan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COALESCE(SUM(jumlah),0) AS n FROM pembayaran WHERE status='Lunas' AND MONTH(created_at)=MONTH(NOW()) AND YEAR(created_at)=YEAR(NOW())"))['n'];

// ── Data per panel ──
$appt_today   = mysqli_query($conn, "SELECT a.id,a.jam,a.status,p.nama AS nama_pasien,d.nama AS nama_dokter,t.nama AS nama_treatment FROM appointment a JOIN pasien p ON a.pasien_id=p.id JOIN dokter d ON a.dokter_id=d.id LEFT JOIN treatment t ON a.treatment_id=t.id WHERE a.tanggal=CURDATE() ORDER BY a.jam ASC LIMIT 10");
$aktivitas    = mysqli_query($conn, "SELECT * FROM log_aktivitas ORDER BY created_at DESC LIMIT 5");
$pasien_list  = mysqli_query($conn, "SELECT p.*, (SELECT t.nama FROM appointment a2 LEFT JOIN treatment t ON t.id=a2.treatment_id WHERE a2.pasien_id=p.id ORDER BY a2.id DESC LIMIT 1) AS treatment_terakhir FROM pasien p ORDER BY p.id DESC LIMIT 100");
$dokter_list  = mysqli_query($conn, "SELECT * FROM dokter ORDER BY id ASC");
$jadwal_list  = mysqli_query($conn, "SELECT j.*,d.nama AS nama_dokter,t.nama AS nama_treatment FROM jadwal_dokter j JOIN dokter d ON j.dokter_id=d.id LEFT JOIN treatment t ON j.treatment_id=t.id ORDER BY d.nama ASC");
$log_list     = mysqli_query($conn, "SELECT * FROM log_aktivitas ORDER BY created_at DESC LIMIT 50");
$treatment_list = mysqli_query($conn, "SELECT * FROM treatment ORDER BY urutan ASC");
$laporan      = mysqli_query($conn, "SELECT d.nama AS nama_dokter,COUNT(a.id) AS total_appt,SUM(a.status='Selesai') AS selesai,SUM(a.status='Dibatalkan') AS batal,COALESCE(SUM(py.jumlah),0) AS pendapatan,d.rating FROM dokter d LEFT JOIN appointment a ON a.dokter_id=d.id AND MONTH(a.tanggal)=MONTH(NOW()) AND YEAR(a.tanggal)=YEAR(NOW()) LEFT JOIN pembayaran py ON py.appointment_id=a.id AND py.status='Lunas' GROUP BY d.id,d.nama,d.rating ORDER BY pendapatan DESC");
$pesan_list  = mysqli_query($conn, "SELECT * FROM pesan_kontak ORDER BY created_at DESC LIMIT 50");
$pesan_belum = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS n FROM pesan_kontak WHERE sudah_baca=0"))['n'];
$admin        = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=".(int)$_SESSION['user_id']));

// Daftar dokter & treatment untuk select di modal
$dlist_modal  = mysqli_query($conn, "SELECT id,nama FROM dokter WHERE status='Aktif' ORDER BY nama");
$tlist_modal  = mysqli_query($conn, "SELECT id,nama FROM treatment WHERE status='Aktif' ORDER BY urutan");

function rupiah(float $n): string {
    if ($n >= 1_000_000) return 'Rp '.number_format($n/1_000_000,1,',','.').' Jt';
    return 'Rp '.number_format($n,0,',','.');
}
function badge_appt(string $s): string {
    return match($s) {
        'Selesai'     => '<span class="badge badge-green">Selesai</span>',
        'Berlangsung' => '<span class="badge badge-yellow">Berlangsung</span>',
        'Terjadwal'   => '<span class="badge badge-gray">Terjadwal</span>',
        'Dibatalkan'  => '<span class="badge badge-pink">Dibatalkan</span>',
        default       => '<span class="badge badge-gray">'.$s.'</span>',
    };
}
$bln_ind = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
$hari_ind = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
$tgl_now  = $hari_ind[date('w')].', '.date('d').' '.$bln_ind[(int)date('n')].' '.date('Y');
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>GlowCare Admin Dashboard</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=DM+Sans:wght@300;400;500&display=swap">
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'DM Sans',sans-serif;background:#fdf0f5;color:#3d1a22;display:flex;min-height:100vh;overflow-x:hidden}
/* SIDEBAR */
.sidebar{width:240px;background:#3d1a22;min-height:100vh;position:fixed;top:0;left:0;display:flex;flex-direction:column;z-index:100}
.sidebar-logo{padding:28px 24px 20px;border-bottom:1px solid rgba(255,255,255,.08)}
.sidebar-logo .brand{font-family:'Playfair Display',serif;font-size:18px;font-style:italic;color:#f2c4ce;letter-spacing:1px}
.sidebar-logo .role{font-size:9px;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,.3);margin-top:4px}
.sidebar-nav{flex:1;padding:20px 0;overflow-y:auto}
.nav-section-label{font-size:8px;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,.25);padding:12px 24px 6px}
.nav-item{display:flex;align-items:center;gap:10px;padding:10px 24px;font-size:13px;color:rgba(255,255,255,.5);cursor:pointer;transition:all .2s;border-left:3px solid transparent;text-decoration:none}
.nav-item:hover{background:rgba(255,255,255,.05);color:rgba(255,255,255,.85)}
.nav-item.active{background:rgba(197,80,133,.15);color:#f2c4ce;border-left-color:#c55085}
.nav-badge{margin-left:auto;background:#c55085;color:#fff;font-size:9px;padding:2px 7px;border-radius:20px}
.sidebar-footer{padding:18px 24px;border-top:1px solid rgba(255,255,255,.08)}
.sidebar-user{display:flex;align-items:center;gap:10px;cursor:pointer}
.user-avatar{width:34px;height:34px;border-radius:50%;background:#c55085;display:flex;align-items:center;justify-content:center;font-size:13px;color:#fff;font-family:'Playfair Display',serif;flex-shrink:0}
.user-info .name{font-size:13px;color:rgba(255,255,255,.8);font-weight:500}
.user-info .label{font-size:10px;color:rgba(255,255,255,.3)}
/* MAIN */
.main{margin-left:240px;flex:1;display:flex;flex-direction:column;min-height:100vh}
.topbar{background:#fff;border-bottom:1px solid #f2c4ce;padding:0 36px;height:60px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:50}
.topbar-left .page-title{font-family:'Playfair Display',serif;font-size:18px;color:#3d1a22}
.topbar-left .breadcrumb{font-size:11px;color:#b89098}
.topbar-right{display:flex;align-items:center;gap:12px}
.logout-btn{font-size:11px;letter-spacing:1px;text-transform:uppercase;color:#b89098;text-decoration:none;padding:7px 14px;border:1px solid #f2c4ce;border-radius:50px;transition:all .2s}
.logout-btn:hover{background:#fdf0f5;color:#c55085}
/* CONTENT */
.content{padding:32px 36px;flex:1}
.panel{display:none}
.panel.active{display:block;animation:fadeIn .3s ease}
@keyframes fadeIn{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}
/* SECTION */
.section-title{font-family:'Playfair Display',serif;font-size:26px;font-weight:400;color:#3d1a22;margin-bottom:4px}
.section-title em{font-style:italic;color:#c55085}
.section-sub{font-size:13px;color:#b89098;margin-bottom:28px;font-weight:300}
/* STATS */
.stats-row{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;margin-bottom:28px}
.stat-card{background:#fff;border-radius:12px;padding:22px;border:1px solid #f2c4ce;position:relative;overflow:hidden;transition:transform .2s,box-shadow .2s}
.stat-card:hover{transform:translateY(-3px);box-shadow:0 8px 24px rgba(197,80,133,.1)}
.stat-card::before{content:"";position:absolute;top:0;left:0;right:0;height:3px;background:#c55085}
.stat-card.green::before{background:#6dbf9e}
.stat-card.purple::before{background:#9b7dd4}
.stat-card.orange::before{background:#e8956d}
.stat-icon{font-size:20px;margin-bottom:10px}
.stat-value{font-family:'Playfair Display',serif;font-size:30px;color:#3d1a22;line-height:1;margin-bottom:4px}
.stat-label{font-size:11px;color:#b89098;letter-spacing:1px;text-transform:uppercase}
/* CARD */
.two-col{display:grid;grid-template-columns:1.4fr 1fr;gap:22px;margin-bottom:22px}
.card{background:#fff;border-radius:12px;border:1px solid #f2c4ce;overflow:hidden;margin-bottom:22px}
.card-header{padding:18px 22px 0;display:flex;align-items:center;justify-content:space-between;margin-bottom:18px}
.card-title{font-family:'Playfair Display',serif;font-size:15px;color:#3d1a22}
.card-action{font-size:11px;letter-spacing:1px;text-transform:uppercase;color:#c55085;cursor:pointer;text-decoration:none}
/* TABLE */
.data-table{width:100%;border-collapse:collapse}
.data-table thead tr{background:#fdf0f5}
.data-table thead th{padding:11px 18px;font-size:9px;letter-spacing:2px;text-transform:uppercase;color:#b89098;font-weight:500;text-align:left;white-space:nowrap}
.data-table tbody tr{border-bottom:1px solid #fdf0f5;transition:background .15s}
.data-table tbody tr:last-child{border-bottom:none}
.data-table tbody tr:hover{background:#fdf0f5}
.data-table tbody td{padding:12px 18px;font-size:13px;color:#3d1a22;font-weight:300;vertical-align:middle}
.td-name{font-family:'Playfair Display',serif;font-size:14px;font-weight:400}
.td-sub{font-size:10px;letter-spacing:1px;text-transform:uppercase;color:#b89098;display:block;margin-top:2px}
/* BADGE */
.badge{display:inline-block;padding:3px 11px;border-radius:50px;font-size:10px;letter-spacing:.5px;font-weight:500}
.badge-green{background:#e8f9f1;color:#3dab74}
.badge-pink{background:#fde8f2;color:#c55085}
.badge-yellow{background:#fef9e7;color:#c9970e}
.badge-gray{background:#f5f5f5;color:#888}
/* AVATAR */
.avatar{width:30px;height:30px;border-radius:50%;background:#f2c4ce;display:inline-flex;align-items:center;justify-content:center;font-size:12px;font-family:'Playfair Display',serif;color:#c55085;margin-right:8px;vertical-align:middle;flex-shrink:0}
/* BUTTONS */
.act-btn{background:none;border:none;cursor:pointer;font-size:13px;padding:4px 6px;border-radius:4px;transition:background .15s;color:#b89098}
.act-btn:hover{background:#fdf0f5;color:#c55085}
.btn-add{display:inline-flex;align-items:center;gap:8px;background:#c55085;color:#fff;padding:10px 20px;border-radius:50px;font-size:11px;letter-spacing:1.5px;text-transform:uppercase;font-family:'DM Sans',sans-serif;border:none;cursor:pointer;transition:background .2s,transform .15s}
.btn-add:hover{background:#a33d6d;transform:translateY(-1px)}
/* PAGE HEADER */
.page-header{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:24px}
/* ACTIVITY */
.activity-list{padding:0 22px 22px}
.activity-item{display:flex;gap:12px;padding:10px 0;border-bottom:1px solid #fdf0f5}
.activity-item:last-child{border-bottom:none}
.activity-dot{width:8px;height:8px;border-radius:50%;background:#c55085;margin-top:5px;flex-shrink:0}
.activity-dot.green{background:#6dbf9e}
.activity-text{font-size:13px;color:#3d1a22;line-height:1.5;font-weight:300}
.activity-text strong{font-weight:500}
.activity-time{font-size:10px;color:#b89098;margin-top:2px}
/* CHART */
.chart-area{padding:22px}
.chart-bars{display:flex;align-items:flex-end;gap:10px;height:130px;border-bottom:1px solid #f2c4ce;padding-bottom:6px}
.chart-bar-wrap{flex:1;display:flex;flex-direction:column;align-items:center;gap:4px;height:100%;justify-content:flex-end}
.chart-bar{width:100%;background:linear-gradient(to top,#c55085,#e87fb4);border-radius:4px 4px 0 0;transition:opacity .2s}
.chart-bar:hover{opacity:.8}
.chart-label{font-size:9px;color:#b89098;letter-spacing:1px;text-transform:uppercase;margin-top:6px}
/* MODAL */
.modal-overlay{display:none;position:fixed;inset:0;background:rgba(61,26,34,.45);backdrop-filter:blur(4px);z-index:999;align-items:center;justify-content:center}
.modal-overlay.open{display:flex;animation:fadeIn .2s ease}
.modal{background:#fff;border-radius:16px;width:560px;max-height:90vh;overflow-y:auto;padding:36px;position:relative}
.modal-title{font-family:'Playfair Display',serif;font-size:20px;color:#3d1a22;margin-bottom:4px}
.modal-title em{color:#c55085;font-style:italic}
.modal-sub{font-size:12px;color:#b89098;margin-bottom:24px;font-weight:300}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:14px}
.form-group{display:flex;flex-direction:column;gap:5px;margin-bottom:14px}
.form-group.full{grid-column:1/-1}
.form-label{font-size:9px;letter-spacing:2px;text-transform:uppercase;color:#7a4d5c}
.form-input,.form-select,.form-textarea{background:#fdf0f5;border:1px solid transparent;border-radius:6px;padding:10px 13px;font-size:13px;font-weight:300;color:#3d1a22;font-family:'DM Sans',sans-serif;outline:none;width:100%;transition:border-color .3s}
.form-input:focus,.form-select:focus,.form-textarea:focus{border-color:#f2c4ce;background:#fff}
.form-textarea{resize:vertical;min-height:75px}
.modal-footer{display:flex;gap:10px;justify-content:flex-end;margin-top:6px}
.btn-cancel{background:transparent;border:1px solid #f2c4ce;color:#7a4d5c;padding:9px 22px;border-radius:50px;font-size:11px;letter-spacing:1.5px;text-transform:uppercase;font-family:'DM Sans',sans-serif;cursor:pointer;transition:background .2s}
.btn-cancel:hover{background:#fdf0f5}
.btn-save{background:#c55085;color:#fff;border:none;padding:9px 26px;border-radius:50px;font-size:11px;letter-spacing:1.5px;text-transform:uppercase;font-family:'DM Sans',sans-serif;cursor:pointer;transition:background .2s}
.btn-save:hover{background:#a33d6d}
/* TOAST */
.toast{position:fixed;bottom:28px;right:28px;background:#3d1a22;color:#fff;padding:13px 22px;border-radius:50px;font-size:13px;z-index:9999;display:none;align-items:center;gap:10px;box-shadow:0 6px 24px rgba(0,0,0,.15)}
.toast.show{display:flex;animation:slideUp .3s ease}
@keyframes slideUp{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)}}
/* PROFIL */
.profil-hero{background:#fff;border:1px solid #f2c4ce;border-radius:16px;padding:32px;margin-bottom:20px;display:flex;gap:28px;align-items:flex-start}
.profil-avatar{width:90px;height:90px;border-radius:50%;background:linear-gradient(135deg,#f2c4ce,#c55085);display:flex;align-items:center;justify-content:center;font-size:34px;font-family:'Playfair Display',serif;color:#fff;flex-shrink:0}
.profil-info{flex:1}
.profil-name{font-family:'Playfair Display',serif;font-size:22px;color:#3d1a22;margin-bottom:4px}
.profil-role{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:#c55085;margin-bottom:14px}
.profil-meta{display:flex;flex-wrap:wrap;gap:20px}
.profil-meta-label{font-size:9px;letter-spacing:2px;text-transform:uppercase;color:#b89098}
.profil-meta-value{font-size:13px;color:#3d1a22}
/* CONFIRM DELETE */
.confirm-overlay{display:none;position:fixed;inset:0;background:rgba(61,26,34,.45);backdrop-filter:blur(4px);z-index:1000;align-items:center;justify-content:center}
.confirm-overlay.open{display:flex}
.confirm-box{background:#fff;border-radius:14px;padding:32px;text-align:center;max-width:360px}
.confirm-icon{font-size:36px;margin-bottom:12px}
.confirm-title{font-family:'Playfair Display',serif;font-size:18px;color:#3d1a22;margin-bottom:8px}
.confirm-desc{font-size:13px;color:#b89098;margin-bottom:22px;line-height:1.6}
.confirm-btns{display:flex;gap:10px;justify-content:center}
.treatment-thumb{width:50px;height:38px;object-fit:cover;border-radius:6px;border:1px solid #f2c4ce}
</style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="sidebar-logo">
        <div class="brand">GlowCare Clinic</div>
        <div class="role">Admin Panel</div>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-section-label">Utama</div>
        <a class="nav-item active" onclick="showPanel('dashboard',this)">📊 Dashboard</a>
        <a class="nav-item" onclick="showPanel('aktivitas',this)">
            🔔 Aktivitas
            <?php $unread=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS n FROM log_aktivitas WHERE DATE(created_at)=CURDATE()"))['n']; if($unread>0) echo "<span class='nav-badge'>$unread</span>"; ?>
        </a>
        <div class="nav-section-label">Manajemen</div>
        <a class="nav-item" onclick="showPanel('pasien',this)">👤 Data Pasien</a>
        <a class="nav-item" onclick="showPanel('dokter',this)">🩺 Data Dokter</a>
        <a class="nav-item" onclick="showPanel('jadwal',this)">📅 Jadwal Dokter</a>
        <div class="nav-section-label">Konten</div>
        <a class="nav-item" onclick="showPanel('treatment',this)">💉 Treatment</a>
        <div class="nav-section-label">Pesan</div>
        <a class="nav-item" onclick="showPanel('pesan',this)">
            ✉️ Pesan Kontak
            <?php if ($pesan_belum > 0): ?>
                <span class="nav-badge"><?= $pesan_belum ?></span>
            <?php endif; ?>
        </a>
        <div class="nav-section-label">Laporan</div>
        <a class="nav-item" onclick="showPanel('laporan',this)">📋 Laporan</a>
        <div class="nav-section-label">Akun</div>
        <a class="nav-item" onclick="showPanel('profil',this)">⚙️ Profil</a>
    </nav>
    <div class="sidebar-footer">
        <div class="sidebar-user" onclick="showPanel('profil',document.querySelector('[onclick*=profil]'))">
            <div class="user-avatar"><?= strtoupper(substr($admin['username'],0,1)) ?></div>
            <div class="user-info">
                <div class="name"><?= htmlspecialchars($admin['username']) ?></div>
                <div class="label">Administrator</div>
            </div>
        </div>
    </div>
</aside>

<!-- MAIN -->
<div class="main">
    <div class="topbar">
        <div class="topbar-left">
            <div class="page-title" id="topbar-title">Dashboard</div>
            <div class="breadcrumb" id="topbar-bc">GlowCare Admin → Dashboard</div>
        </div>
        <div class="topbar-right">
            <a href="../../backend/logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

    <div class="content">

    <!-- ══ PANEL DASHBOARD ══ -->
    <div class="panel active" id="panel-dashboard">
        <p class="section-sub">Selamat datang, <strong><?= htmlspecialchars($admin['username']) ?></strong> — <?= $tgl_now ?></p>
        <div class="stats-row">
            <div class="stat-card"><div class="stat-icon">👤</div><div class="stat-value"><?= number_format($total_pasien) ?></div><div class="stat-label">Total Pasien</div></div>
            <div class="stat-card green"><div class="stat-icon">📅</div><div class="stat-value"><?= $appt_hari_ini ?></div><div class="stat-label">Janji Hari Ini</div></div>
            <div class="stat-card purple"><div class="stat-icon">🩺</div><div class="stat-value"><?= $dokter_aktif ?></div><div class="stat-label">Dokter Aktif</div></div>
            <div class="stat-card orange"><div class="stat-icon">💰</div><div class="stat-value"><?= rupiah((float)$pendapatan_bulan) ?></div><div class="stat-label">Pendapatan Bulan Ini</div></div>
        </div>
        <div class="two-col">
            <div class="card">
                <div class="card-header"><div class="card-title">Kunjungan Pasien — <?= date('Y') ?></div></div>
                <div class="chart-area">
                    <?php
                    $bulan_lbl=['Jan','Feb','Mar','Apr','Mei','Jun'];
                    $chart_data=[];
                    for($m=1;$m<=6;$m++){$r=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS n FROM appointment WHERE MONTH(tanggal)=$m AND YEAR(tanggal)=".date('Y')));$chart_data[$m]=(int)$r['n'];}
                    $max_val=max(array_values($chart_data))?:1;
                    ?>
                    <div class="chart-bars">
                    <?php for($m=1;$m<=6;$m++): $h=max(round(($chart_data[$m]/$max_val)*100),5); ?>
                        <div class="chart-bar-wrap">
                            <div class="chart-bar" style="height:<?=$h?>%" title="<?=$chart_data[$m]?> kunjungan"></div>
                            <div class="chart-label"><?=$bulan_lbl[$m-1]?></div>
                        </div>
                    <?php endfor; ?>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Aktivitas Terkini</div>
                    <a class="card-action" onclick="showPanel('aktivitas',document.querySelector('[onclick*=aktivitas]'))">Semua →</a>
                </div>
                <div class="activity-list">
                <?php mysqli_data_seek($aktivitas,0); while($ak=mysqli_fetch_assoc($aktivitas)): ?>
                    <div class="activity-item">
                        <div class="activity-dot"></div>
                        <div>
                            <div class="activity-text"><strong><?= htmlspecialchars($ak['judul']) ?></strong> — <?= htmlspecialchars($ak['deskripsi']) ?></div>
                            <div class="activity-time"><?= date('d M Y, H:i',strtotime($ak['created_at'])) ?></div>
                        </div>
                    </div>
                <?php endwhile; ?>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><div class="card-title">Appointment Hari Ini</div></div>
            <table class="data-table">
                <thead><tr><th>Pasien</th><th>Dokter</th><th>Treatment</th><th>Jam</th><th>Status</th></tr></thead>
                <tbody>
                <?php if(mysqli_num_rows($appt_today)===0): ?>
                    <tr><td colspan="5" style="text-align:center;color:#b89098;padding:24px">Tidak ada appointment hari ini.</td></tr>
                <?php else: while($ap=mysqli_fetch_assoc($appt_today)): ?>
                    <tr>
                        <td><span class="avatar"><?= strtoupper(substr($ap['nama_pasien'],0,1)) ?></span><?= htmlspecialchars($ap['nama_pasien']) ?></td>
                        <td><?= htmlspecialchars($ap['nama_dokter']) ?></td>
                        <td><?= htmlspecialchars($ap['nama_treatment']??'-') ?></td>
                        <td><?= date('H:i',strtotime($ap['jam'])) ?></td>
                        <td><?= badge_appt($ap['status']) ?></td>
                    </tr>
                <?php endwhile; endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ══ PANEL PASIEN ══ -->
    <div class="panel" id="panel-pasien">
        <div class="page-header">
            <div><h2 class="section-title">Data <em>Pasien</em></h2><p class="section-sub">Kelola seluruh data pasien terdaftar</p></div>
            <button class="btn-add" onclick="openModal('modal-pasien')">+ Tambah Pasien</button>
        </div>
        <div class="card">
            <table class="data-table">
                <thead><tr><th>No. Pasien</th><th>Nama</th><th>Kontak</th><th>Treatment Terakhir</th><th>Kunjungan</th><th>Status</th><th>Aksi</th></tr></thead>
                <tbody>
                <?php mysqli_data_seek($pasien_list,0); while($p=mysqli_fetch_assoc($pasien_list)):
                    $usia=$p['tanggal_lahir']?(date('Y')-date('Y',strtotime($p['tanggal_lahir']))).''  :'-'; ?>
                    <tr>
                        <td style="color:#b89098;font-size:11px">#<?= htmlspecialchars($p['no_pasien']) ?></td>
                        <td>
                            <div style="display:flex;align-items:center;gap:8px">
                                <span class="avatar"><?= strtoupper(substr($p['nama'],0,1)) ?></span>
                                <div><div class="td-name"><?= htmlspecialchars($p['nama']) ?></div><span class="td-sub"><?= $usia ?> Thn · <?= $p['jenis_kelamin'] ?></span></div>
                            </div>
                        </td>
                        <td><div><?= htmlspecialchars($p['telepon']??'-') ?></div><div style="font-size:11px;color:#b89098"><?= htmlspecialchars($p['email']??'-') ?></div></td>
                        <td><?= htmlspecialchars($p['treatment_terakhir']??'-') ?></td>
                        <td style="text-align:center"><?= $p['total_kunjungan'] ?></td>
                        <td><?= $p['status']==='Aktif'?'<span class="badge badge-green">Aktif</span>':'<span class="badge badge-gray">Tidak Aktif</span>' ?></td>
                        <td>
                            <button class="act-btn" onclick="editPasien(<?= htmlspecialchars(json_encode($p)) ?>)" title="Edit">✏️</button>
                            <button class="act-btn" onclick="confirmDelete('hapus_pasien.php','<?= $p['id'] ?>','pasien <?= htmlspecialchars(addslashes($p['nama'])) ?>')" title="Hapus">🗑️</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
            <div style="padding:14px 18px;border-top:1px solid #fdf0f5;font-size:12px;color:#b89098">Total <?= number_format($total_pasien) ?> pasien terdaftar</div>
        </div>
    </div>

    <!-- ══ PANEL DOKTER ══ -->
    <div class="panel" id="panel-dokter">
        <div class="page-header">
            <div><h2 class="section-title">Data <em>Dokter</em></h2><p class="section-sub">Kelola profil dan spesialisasi dokter</p></div>
            <button class="btn-add" onclick="openModal('modal-dokter')">+ Tambah Dokter</button>
        </div>
        <div class="card">
            <table class="data-table">
                <thead><tr><th>ID</th><th>Nama</th><th>Spesialisasi</th><th>Pengalaman</th><th>Total Pasien</th><th>Rating</th><th>Status</th><th>Aksi</th></tr></thead>
                <tbody>
                <?php mysqli_data_seek($dokter_list,0); while($d=mysqli_fetch_assoc($dokter_list)):
                    $badge_d=match($d['status']){'Aktif'=>'badge-green','Cuti'=>'badge-yellow',default=>'badge-gray'}; ?>
                    <tr>
                        <td style="color:#b89098;font-size:11px">#D-00<?= $d['id'] ?></td>
                        <td><div style="display:flex;align-items:center;gap:8px"><span class="avatar"><?= strtoupper(substr($d['nama'],0,1)) ?></span><span class="td-name"><?= htmlspecialchars($d['nama']) ?></span></div></td>
                        <td><span class="badge badge-pink"><?= htmlspecialchars($d['spesialisasi']) ?></span></td>
                        <td><?= $d['pengalaman'] ?>+ Thn</td>
                        <td style="text-align:center"><?= number_format($d['total_pasien']) ?></td>
                        <td>⭐ <?= number_format($d['rating'],1) ?></td>
                        <td><span class="badge <?= $badge_d ?>"><?= $d['status'] ?></span></td>
                        <td>
                            <button class="act-btn" onclick="editDokter(<?= htmlspecialchars(json_encode($d)) ?>)" title="Edit">✏️</button>
                            <button class="act-btn" onclick="confirmDelete('hapus_dokter.php','<?= $d['id'] ?>','dokter <?= htmlspecialchars(addslashes($d['nama'])) ?>')" title="Hapus">🗑️</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ══ PANEL JADWAL ══ -->
    <div class="panel" id="panel-jadwal">
        <div class="page-header">
            <div><h2 class="section-title">Jadwal <em>Dokter</em></h2><p class="section-sub">Atur jadwal praktik seluruh dokter</p></div>
            <button class="btn-add" onclick="openModal('modal-jadwal')">+ Tambah Jadwal</button>
        </div>
        <div class="card">
            <table class="data-table">
                <thead><tr><th>Dokter</th><th>Hari</th><th>Jam Mulai</th><th>Jam Selesai</th><th>Treatment</th><th>Max Pasien</th><th>Status</th><th>Aksi</th></tr></thead>
                <tbody>
                <?php mysqli_data_seek($jadwal_list,0); while($j=mysqli_fetch_assoc($jadwal_list)): ?>
                    <tr>
                        <td><span class="td-name"><?= htmlspecialchars($j['nama_dokter']) ?></span></td>
                        <td><?= htmlspecialchars($j['hari']) ?></td>
                        <td><?= date('H:i',strtotime($j['jam_mulai'])) ?></td>
                        <td><?= date('H:i',strtotime($j['jam_selesai'])) ?></td>
                        <td><?= htmlspecialchars($j['nama_treatment']??'Semua Treatment') ?></td>
                        <td style="text-align:center"><?= $j['max_pasien'] ?></td>
                        <td><span class="badge badge-green">Aktif</span></td>
                        <td>
                            <button class="act-btn" onclick="editJadwal(<?= htmlspecialchars(json_encode($j)) ?>)" title="Edit">✏️</button>
                            <button class="act-btn" onclick="confirmDelete('hapus_jadwal.php','<?= $j['id'] ?>','jadwal ini')" title="Hapus">🗑️</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ══ PANEL TREATMENT ══ -->
    <div class="panel" id="panel-treatment">
        <div class="page-header">
            <div><h2 class="section-title">Kelola <em>Treatment</em></h2><p class="section-sub">Data treatment yang tampil di halaman utama</p></div>
            <button class="btn-add" onclick="openModal('modal-treatment')">+ Tambah Treatment</button>
        </div>
        <div class="card">
            <table class="data-table">
                <thead><tr><th>No</th><th>Gambar</th><th>Nama</th><th>Kategori</th><th>Deskripsi</th><th>Status</th><th>Aksi</th></tr></thead>
                <tbody>
                <?php mysqli_data_seek($treatment_list,0); while($tr=mysqli_fetch_assoc($treatment_list)):
                    $img=$tr['gambar_url']?:($tr['gambar_file']?'../../uploads/treatment/'.$tr['gambar_file']:''); ?>
                    <tr>
                        <td style="color:#b89098;font-size:11px"><?= $tr['urutan'] ?></td>
                        <td>
                            <?php if($img): ?>
                                <img src="<?= htmlspecialchars($img) ?>" class="treatment-thumb">
                            <?php else: ?>
                                <div style="width:50px;height:38px;background:#f2c4ce;border-radius:6px;display:flex;align-items:center;justify-content:center">💉</div>
                            <?php endif; ?>
                        </td>
                        <td><div class="td-name"><?= htmlspecialchars($tr['nama']) ?></div></td>
                        <td><span class="badge badge-pink"><?= htmlspecialchars($tr['kategori']) ?></span></td>
                        <td style="max-width:200px;font-size:12px;color:#7a4d5c"><?= htmlspecialchars(mb_substr($tr['deskripsi'],0,70)) ?>...</td>
                        <td><?= $tr['status']==='Aktif'?'<span class="badge badge-green">Aktif</span>':'<span class="badge badge-gray">Nonaktif</span>' ?></td>
                        <td>
                            <button class="act-btn" onclick="editTreatment(<?= htmlspecialchars(json_encode($tr)) ?>)" title="Edit">✏️</button>
                            <button class="act-btn" onclick="confirmDelete('hapus_treatment.php','<?= $tr['id'] ?>','treatment <?= htmlspecialchars(addslashes($tr['nama'])) ?>')" title="Hapus">🗑️</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ══ PANEL AKTIVITAS ══ -->
    <div class="panel" id="panel-aktivitas">
        <h2 class="section-title">Log <em>Aktivitas</em></h2>
        <p class="section-sub">Seluruh aktivitas sistem tercatat di sini</p>
        <div class="card">
            <div class="card-header"><div class="card-title">Riwayat Aktivitas</div></div>
            <div style="padding:0 22px 22px">
            <?php mysqli_data_seek($log_list,0); while($lg=mysqli_fetch_assoc($log_list)): ?>
                <div class="activity-item">
                    <div class="activity-dot"></div>
                    <div style="flex:1">
                        <div class="activity-text"><strong><?= htmlspecialchars($lg['judul']) ?></strong><?= $lg['deskripsi']?' — '.htmlspecialchars($lg['deskripsi']):'' ?></div>
                        <div class="activity-time"><?= date('d M Y, H:i',strtotime($lg['created_at'])) ?></div>
                    </div>
                    <span class="badge badge-gray"><?= $lg['tipe'] ?></span>
                </div>
            <?php endwhile; ?>
            </div>
        </div>
    </div>
    <!-- ══ PANEL PESAN KONTAK ══ -->
    <div class="panel" id="panel-pesan">
        <div class="page-header">
            <div>
                <h2 class="section-title">Pesan <em>Kontak</em></h2>
                <p class="section-sub">Pesan yang masuk dari form kontak di halaman utama</p>
            </div>
        </div>
        <div class="card">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Pengirim</th>
                        <th>Kontak</th>
                        <th>Pesan</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if (mysqli_num_rows($pesan_list) === 0): ?>
                    <tr>
                        <td colspan="6" style="text-align:center;color:#b89098;padding:32px">
                            Belum ada pesan masuk.
                        </td>
                    </tr>
                <?php else:
                    mysqli_data_seek($pesan_list, 0);
                    while ($pk = mysqli_fetch_assoc($pesan_list)):
                        $belum = !$pk['sudah_baca'];
                ?>
                    <tr style="<?= $belum ? 'background:#fff8fb;font-weight:500' : '' ?>">
    
                        <!-- Pengirim -->
                        <td>
                            <div style="display:flex;align-items:center;gap:8px">
                                <span class="avatar"><?= strtoupper(substr($pk['nama'], 0, 1)) ?></span>
                                <div>
                                    <div class="td-name"><?= htmlspecialchars($pk['nama']) ?></div>
                                    <?php if ($belum): ?>
                                        <span style="font-size:9px;letter-spacing:1px;text-transform:uppercase;color:#c55085">● Baru</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
    
                        <!-- Kontak -->
                        <td>
                            <div><?= htmlspecialchars($pk['telepon'] ?: '-') ?></div>
                            <div style="font-size:11px;color:#b89098"><?= htmlspecialchars($pk['email'] ?: '-') ?></div>
                        </td>
    
                        <!-- Pesan (preview) -->
                        <td style="max-width:260px">
                            <div style="font-size:12px;color:#3d1a22;line-height:1.5;cursor:pointer"
                                onclick="lihatPesan(<?= htmlspecialchars(json_encode($pk)) ?>)">
                                <?= htmlspecialchars(mb_substr($pk['pesan'], 0, 80)) ?>
                                <?= mb_strlen($pk['pesan']) > 80 ? '…' : '' ?>
                            </div>
                        </td>
    
                        <!-- Waktu -->
                        <td style="white-space:nowrap;font-size:12px;color:#b89098">
                            <?= date('d M Y', strtotime($pk['created_at'])) ?><br>
                            <?= date('H:i', strtotime($pk['created_at'])) ?>
                        </td>
    
                        <!-- Status -->
                        <td>
                            <?= $belum
                                ? '<span class="badge badge-pink">Belum Dibaca</span>'
                                : '<span class="badge badge-green">Sudah Dibaca</span>' ?>
                        </td>
    
                        <!-- Aksi -->
                        <td style="white-space:nowrap">
                            <!-- Tombol Lihat / tandai baca -->
                            <button class="act-btn"
                                    onclick="lihatPesan(<?= htmlspecialchars(json_encode($pk)) ?>)"
                                    title="Lihat pesan">👁️</button>
    
                            <?php if ($belum): ?>
                            <!-- Tandai sudah dibaca -->
                            <form method="POST" action="../../backend/admin/kelola_pesan.php"
                                style="display:inline">
                                <input type="hidden" name="aksi" value="baca">
                                <input type="hidden" name="id" value="<?= $pk['id'] ?>">
                                <button type="submit" class="act-btn" title="Tandai sudah dibaca">✅</button>
                            </form>
                            <?php endif; ?>
    
                            <!-- Hapus -->
                            <button class="act-btn"
                                    onclick="confirmDelete('kelola_pesan.php','<?= $pk['id'] ?>','pesan dari <?= htmlspecialchars(addslashes($pk['nama'])) ?>')"
                                    title="Hapus">🗑️</button>
                        </td>
                    </tr>
                <?php endwhile; endif; ?>
                </tbody>
            </table>
    
            <div style="padding:14px 18px;border-top:1px solid #fdf0f5;font-size:12px;color:#b89098">
                Total <?= mysqli_num_rows($pesan_list) ?> pesan
                <?php if ($pesan_belum > 0): ?>
                    · <span style="color:#c55085;font-weight:600"><?= $pesan_belum ?> belum dibaca</span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- ══ PANEL LAPORAN ══ -->
    <div class="panel" id="panel-laporan">
        <h2 class="section-title">Laporan <em>Bulanan</em></h2>
        <p class="section-sub">Ringkasan data klinik bulan ini</p>
        <div class="card">
            <div class="card-header"><div class="card-title">Ringkasan — <?= $bln_ind[(int)date('n')].' '.date('Y') ?></div></div>
            <table class="data-table">
                <thead><tr><th>Dokter</th><th>Total Appointment</th><th>Selesai</th><th>Dibatalkan</th><th>Pendapatan</th><th>Rating</th></tr></thead>
                <tbody>
                <?php $tot_a=$tot_s=$tot_b=$tot_p=0; mysqli_data_seek($laporan,0); while($lp=mysqli_fetch_assoc($laporan)):
                    $tot_a+=$lp['total_appt'];$tot_s+=$lp['selesai'];$tot_b+=$lp['batal'];$tot_p+=$lp['pendapatan']; ?>
                    <tr>
                        <td><span class="td-name"><?= htmlspecialchars($lp['nama_dokter']) ?></span></td>
                        <td style="text-align:center"><?= $lp['total_appt'] ?></td>
                        <td style="text-align:center"><?= $lp['selesai'] ?></td>
                        <td style="text-align:center;color:#c55085"><?= $lp['batal'] ?></td>
                        <td><?= rupiah((float)$lp['pendapatan']) ?></td>
                        <td>⭐ <?= number_format($lp['rating'],1) ?></td>
                    </tr>
                <?php endwhile; ?>
                    <tr style="background:#fdf0f5;font-weight:600">
                        <td><strong>Total</strong></td>
                        <td style="text-align:center"><strong><?= $tot_a ?></strong></td>
                        <td style="text-align:center"><strong><?= $tot_s ?></strong></td>
                        <td style="text-align:center;color:#c55085"><strong><?= $tot_b ?></strong></td>
                        <td><strong><?= rupiah((float)$tot_p) ?></strong></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ══ PANEL PROFIL ══ -->
    <div class="panel" id="panel-profil">
        <div class="page-header">
            <div><h2 class="section-title">Profil & <em>Keamanan</em></h2><p class="section-sub">Kelola informasi akun admin</p></div>
        </div>
        <div class="profil-hero">
            <div class="profil-avatar"><?= strtoupper(substr($admin['username'],0,1)) ?></div>
            <div class="profil-info">
                <div class="profil-name"><?= htmlspecialchars($admin['username']) ?></div>
                <div class="profil-role">Super Admin · GlowCare Clinic</div>
                <div class="profil-meta">
                    <div><div class="profil-meta-label">Email</div><div class="profil-meta-value"><?= htmlspecialchars($admin['email']) ?></div></div>
                    <div><div class="profil-meta-label">Bergabung</div><div class="profil-meta-value"><?= date('d M Y',strtotime($admin['created_at'])) ?></div></div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><div class="card-title">Ganti <em>Password</em></div></div>
            <div style="padding:22px">
                <form method="POST" action="../../backend/admin/ganti_password.php">
                    <div class="form-row">
                        <div class="form-group full"><label class="form-label">Password Saat Ini</label><input class="form-input" type="password" name="password_lama" placeholder="••••••••" required></div>
                        <div class="form-group"><label class="form-label">Password Baru</label><input class="form-input" type="password" name="password_baru" placeholder="Min. 8 karakter" required></div>
                        <div class="form-group"><label class="form-label">Konfirmasi</label><input class="form-input" type="password" name="konfirmasi" placeholder="Ulangi password" required></div>
                    </div>
                    <button type="submit" class="btn-save">Ubah Password</button>
                </form>
            </div>
        </div>
    </div>

    </div><!-- /content -->
</div><!-- /main -->

<!-- ═══ MODAL PASIEN ═══ -->
<div class="modal-overlay" id="modal-pasien" onclick="closeModalOutside(event,'modal-pasien')">
    <div class="modal">
        <h3 class="modal-title" id="mp-title">Tambah <em>Pasien</em></h3>
        <p class="modal-sub">Isi data pasien dengan lengkap dan benar</p>
        <form method="POST" id="form-pasien">
            <input type="hidden" name="id" id="mp-id">
            <div class="form-row">
                <div class="form-group"><label class="form-label">Nama Lengkap</label><input class="form-input" name="nama" id="mp-nama" placeholder="Nama lengkap" required></div>
                <div class="form-group"><label class="form-label">No. Pasien</label><input class="form-input" name="no_pasien" id="mp-no" placeholder="P-XXXX" required></div>
                <div class="form-group"><label class="form-label">Tanggal Lahir</label><input class="form-input" type="date" name="tanggal_lahir" id="mp-tgl"></div>
                <div class="form-group"><label class="form-label">Jenis Kelamin</label>
                    <select class="form-select" name="jenis_kelamin" id="mp-jk"><option>Perempuan</option><option>Laki-laki</option></select>
                </div>
                <div class="form-group"><label class="form-label">No. Telepon</label><input class="form-input" name="telepon" id="mp-telp" placeholder="+62"></div>
                <div class="form-group"><label class="form-label">Email</label><input class="form-input" type="email" name="email" id="mp-email" placeholder="email@contoh.com"></div>
                <div class="form-group full"><label class="form-label">Alamat</label><input class="form-input" name="alamat" id="mp-alamat" placeholder="Alamat lengkap"></div>
                <div class="form-group"><label class="form-label">Status</label>
                    <select class="form-select" name="status" id="mp-status"><option>Aktif</option><option>Tidak Aktif</option></select>
                </div>
                <div class="form-group full"><label class="form-label">Catatan Medis</label><textarea class="form-textarea" name="catatan_medis" id="mp-catatan" placeholder="Alergi, kondisi khusus..."></textarea></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal('modal-pasien')">Batal</button>
                <button type="submit" class="btn-save">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- ═══ MODAL DOKTER ═══ -->
<div class="modal-overlay" id="modal-dokter" onclick="closeModalOutside(event,'modal-dokter')">
    <div class="modal">
        <h3 class="modal-title" id="md-title">Tambah <em>Dokter</em></h3>
        <p class="modal-sub">Lengkapi profil dan spesialisasi dokter</p>
        <form method="POST" id="form-dokter">
            <input type="hidden" name="id" id="md-id">
            <div class="form-row">
                <div class="form-group"><label class="form-label">Nama Lengkap</label><input class="form-input" name="nama" id="md-nama" placeholder="Dr. Nama Lengkap" required></div>
                <div class="form-group"><label class="form-label">No. STR / SIP</label><input class="form-input" name="no_str" id="md-str" placeholder="STR-XX-000"></div>
                <div class="form-group full"><label class="form-label">Spesialisasi</label>
                    <select class="form-select" name="spesialisasi" id="md-spesialis">
                        <option>Plastic Surgeon</option><option>Aesthetic Physician</option><option>Dermatologist</option><option>Other</option>
                    </select>
                </div>
                <div class="form-group"><label class="form-label">No. Telepon</label><input class="form-input" name="telepon" id="md-telp" placeholder="+62"></div>
                <div class="form-group"><label class="form-label">Email</label><input class="form-input" type="email" name="email" id="md-email" placeholder="dokter@glowcare.com"></div>
                <div class="form-group"><label class="form-label">Pengalaman (Tahun)</label><input class="form-input" type="number" name="pengalaman" id="md-exp" placeholder="0" min="0"></div>
                <div class="form-group"><label class="form-label">Rating</label><input class="form-input" type="number" name="rating" id="md-rating" placeholder="5.0" min="0" max="5" step="0.1"></div>
                <div class="form-group full"><label class="form-label">Status</label>
                    <select class="form-select" name="status" id="md-status"><option>Aktif</option><option>Cuti</option><option>Tidak Aktif</option></select>
                </div>
                <div class="form-group full"><label class="form-label">Bio Singkat</label><textarea class="form-textarea" name="bio" id="md-bio" placeholder="Deskripsi singkat dokter..."></textarea></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal('modal-dokter')">Batal</button>
                <button type="submit" class="btn-save">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- ═══ MODAL JADWAL ═══ -->
<div class="modal-overlay" id="modal-jadwal" onclick="closeModalOutside(event,'modal-jadwal')">
    <div class="modal">
        <h3 class="modal-title" id="mj-title">Tambah <em>Jadwal</em></h3>
        <p class="modal-sub">Atur jadwal praktik dokter</p>
        <form method="POST" id="form-jadwal">
            <input type="hidden" name="id" id="mj-id">
            <div class="form-row">
                <div class="form-group full"><label class="form-label">Dokter</label>
                    <select class="form-select" name="dokter_id" id="mj-dokter">
                        <?php mysqli_data_seek($dlist_modal,0); while($dl=mysqli_fetch_assoc($dlist_modal)): ?>
                            <option value="<?= $dl['id'] ?>"><?= htmlspecialchars($dl['nama']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group full"><label class="form-label">Hari</label>
                    <select class="form-select" name="hari" id="mj-hari">
                        <?php foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $hr): ?>
                            <option><?= $hr ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group"><label class="form-label">Jam Mulai</label><input class="form-input" type="time" name="jam_mulai" id="mj-mulai" value="09:00"></div>
                <div class="form-group"><label class="form-label">Jam Selesai</label><input class="form-input" type="time" name="jam_selesai" id="mj-selesai" value="17:00"></div>
                <div class="form-group"><label class="form-label">Max Pasien/Hari</label><input class="form-input" type="number" name="max_pasien" id="mj-max" value="8" min="1"></div>
                <div class="form-group"><label class="form-label">Treatment</label>
                    <select class="form-select" name="treatment_id" id="mj-treatment">
                        <option value="">Semua Treatment</option>
                        <?php mysqli_data_seek($tlist_modal,0); while($tl=mysqli_fetch_assoc($tlist_modal)): ?>
                            <option value="<?= $tl['id'] ?>"><?= htmlspecialchars($tl['nama']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group full"><label class="form-label">Status</label>
                    <select class="form-select" name="status" id="mj-status"><option>Aktif</option><option>Nonaktif</option></select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal('modal-jadwal')">Batal</button>
                <button type="submit" class="btn-save">Simpan Jadwal</button>
            </div>
        </form>
    </div>
</div>

<!-- ═══ MODAL TREATMENT ═══ -->
<div class="modal-overlay" id="modal-treatment" onclick="closeModalOutside(event,'modal-treatment')">
    <div class="modal" style="width:600px">
        <h3 class="modal-title" id="mt-title">Tambah <em>Treatment</em></h3>
        <p class="modal-sub">Data ini akan tampil di halaman index klinik</p>
        <form method="POST" id="form-treatment">
            <input type="hidden" name="id" id="mt-id">
            <div class="form-row">
                <div class="form-group full"><label class="form-label">Nama Treatment</label><input class="form-input" name="nama" id="mt-nama" placeholder="Contoh: Facelift Procedures" required></div>
                <div class="form-group"><label class="form-label">Kategori</label>
                    <select class="form-select" name="kategori" id="mt-kategori">
                        <option>Surgical</option><option>Injectable</option><option>Technology</option><option>Contouring</option><option>Skincare</option><option>Other</option>
                    </select>
                </div>
                <div class="form-group"><label class="form-label">Urutan Tampil</label><input class="form-input" type="number" name="urutan" id="mt-urutan" value="1" min="1"></div>
                <div class="form-group full"><label class="form-label">URL Gambar</label><input class="form-input" name="gambar_url" id="mt-gambar" placeholder="https://images.unsplash.com/..."></div>
                <div class="form-group full"><label class="form-label">Link Halaman Detail</label><input class="form-input" name="link_halaman" id="mt-link" placeholder="pages/treatment/nama.php"></div>
                <div class="form-group full"><label class="form-label">Deskripsi Singkat (tampil di index)</label><textarea class="form-textarea" name="deskripsi" id="mt-desc" placeholder="Deskripsi singkat..."></textarea></div>
                <div class="form-group full"><label class="form-label">Deskripsi Lengkap</label><textarea class="form-textarea" style="min-height:90px" name="deskripsi_panjang" id="mt-desc-panjang" placeholder="Deskripsi lengkap treatment..."></textarea></div>
                <div class="form-group full"><label class="form-label">Status</label>
                    <select class="form-select" name="status" id="mt-status"><option>Aktif</option><option>Nonaktif</option></select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal('modal-treatment')">Batal</button>
                <button type="submit" class="btn-save">Simpan & Publikasikan</button>
            </div>
        </form>
    </div>
</div>
<!-- ═══ MODAL DETAIL PESAN ═══ -->
<div class="modal-overlay" id="modal-pesan" onclick="closeModalOutside(event,'modal-pesan')">
    <div class="modal" style="width:540px">
        <h3 class="modal-title">Detail <em>Pesan</em></h3>
        <p class="modal-sub" id="mp-pengirim-sub">Dari pengunjung</p>
 
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:18px">
            <div class="form-group">
                <label class="form-label">Nama</label>
                <div class="form-input" id="mp-detail-nama" style="background:#fdf0f5;cursor:default"></div>
            </div>
            <div class="form-group">
                <label class="form-label">Telepon</label>
                <div class="form-input" id="mp-detail-telp" style="background:#fdf0f5;cursor:default"></div>
            </div>
            <div class="form-group" style="grid-column:1/-1">
                <label class="form-label">Email</label>
                <div class="form-input" id="mp-detail-email" style="background:#fdf0f5;cursor:default"></div>
            </div>
            <div class="form-group" style="grid-column:1/-1">
                <label class="form-label">Pesan</label>
                <div class="form-textarea" id="mp-detail-pesan"
                     style="background:#fdf0f5;cursor:default;min-height:100px;line-height:1.6"></div>
            </div>
        </div>
 
        <!-- Tombol aksi di dalam modal -->
        <div class="modal-footer" id="mp-detail-footer">
            <!-- JS akan inject tombol "Tandai Baca" jika belum dibaca -->
            <button class="btn-cancel" onclick="closeModal('modal-pesan')">Tutup</button>
        </div>
    </div>
</div>
<!-- CONFIRM DELETE -->
<div class="confirm-overlay" id="confirm-overlay">
    <div class="confirm-box">
        <div class="confirm-icon">🗑️</div>
        <div class="confirm-title">Yakin ingin menghapus?</div>
        <div class="confirm-desc" id="confirm-desc">Data ini akan dihapus permanen.</div>
        <div class="confirm-btns">
            <button class="btn-cancel" onclick="closeConfirm()">Batal</button>
            <form method="POST" id="confirm-form">
                <input type="hidden" name="id" id="confirm-id">
                <button type="submit" class="btn-save" style="background:#e05050">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>

<div class="toast" id="toast">✅ <span id="toast-msg">Berhasil</span></div>

<script>
const titles = {dashboard:'Dashboard',pasien:'Data Pasien',dokter:'Data Dokter',jadwal:'Jadwal Dokter',aktivitas:'Aktivitas',pesan:'Pesan Kontak',laporan:'Laporan',treatment:'Treatment',profil:'Profil'};

function showPanel(id,el){
    document.querySelectorAll('.panel').forEach(p=>p.classList.remove('active'));
    document.getElementById('panel-'+id).classList.add('active');
    document.querySelectorAll('.nav-item').forEach(n=>n.classList.remove('active'));
    if(el) el.classList.add('active');
    document.getElementById('topbar-title').textContent=titles[id]||id;
    document.getElementById('topbar-bc').textContent='GlowCare Admin → '+(titles[id]||id);
}
function openModal(id){document.getElementById(id).classList.add('open');}
function closeModal(id){document.getElementById(id).classList.remove('open');}
function closeModalOutside(e,id){if(e.target.classList.contains('modal-overlay'))closeModal(id);}
function showToast(msg,ok=true){
    const t=document.getElementById('toast');
    t.innerHTML=(ok?'✅ ':'❌ ')+'<span>'+msg+'</span>';
    t.classList.add('show');
    setTimeout(()=>t.classList.remove('show'),3500);
}

// ── PASIEN ──
function editPasien(p){
    document.getElementById('mp-title').innerHTML='Edit <em>Pasien</em>';
    document.getElementById('form-pasien').action='../../backend/admin/simpan_pasien.php';
    document.getElementById('mp-id').value=p.id;
    document.getElementById('mp-nama').value=p.nama;
    document.getElementById('mp-no').value=p.no_pasien;
    document.getElementById('mp-tgl').value=p.tanggal_lahir||'';
    document.getElementById('mp-jk').value=p.jenis_kelamin;
    document.getElementById('mp-telp').value=p.telepon||'';
    document.getElementById('mp-email').value=p.email||'';
    document.getElementById('mp-alamat').value=p.alamat||'';
    document.getElementById('mp-status').value=p.status;
    document.getElementById('mp-catatan').value=p.catatan_medis||'';
    openModal('modal-pasien');
}
document.getElementById('modal-pasien').addEventListener('click',function(e){
    if(e.target===this) closeModal('modal-pasien');
});
document.querySelector('#form-pasien button[type=submit]').addEventListener('click',function(){
    const f=document.getElementById('form-pasien');
    if(!f.action.includes('simpan_pasien')) f.action='../../backend/admin/simpan_pasien.php';
});
// Reset modal pasien saat tambah baru
document.querySelector('[onclick="openModal(\'modal-pasien\')"]') && document.querySelectorAll('[onclick="openModal(\'modal-pasien\')"]').forEach(btn=>{
    btn.addEventListener('click',()=>{
        document.getElementById('mp-title').innerHTML='Tambah <em>Pasien</em>';
        document.getElementById('form-pasien').action='../../backend/admin/simpan_pasien.php';
        document.getElementById('form-pasien').reset();
        document.getElementById('mp-id').value='';
    });
});

// ── DOKTER ──
function editDokter(d){
    document.getElementById('md-title').innerHTML='Edit <em>Dokter</em>';
    document.getElementById('form-dokter').action='../../backend/admin/simpan_dokter.php';
    document.getElementById('md-id').value=d.id;
    document.getElementById('md-nama').value=d.nama;
    document.getElementById('md-str').value=d.no_str||'';
    document.getElementById('md-spesialis').value=d.spesialisasi;
    document.getElementById('md-telp').value=d.telepon||'';
    document.getElementById('md-email').value=d.email||'';
    document.getElementById('md-exp').value=d.pengalaman||0;
    document.getElementById('md-rating').value=d.rating||5;
    document.getElementById('md-status').value=d.status;
    document.getElementById('md-bio').value=d.bio||'';
    openModal('modal-dokter');
}

// ── JADWAL ──
function editJadwal(j){
    document.getElementById('mj-title').innerHTML='Edit <em>Jadwal</em>';
    document.getElementById('form-jadwal').action='../../backend/admin/simpan_jadwal.php';
    document.getElementById('mj-id').value=j.id;
    document.getElementById('mj-dokter').value=j.dokter_id;
    document.getElementById('mj-hari').value=j.hari;
    document.getElementById('mj-mulai').value=j.jam_mulai;
    document.getElementById('mj-selesai').value=j.jam_selesai;
    document.getElementById('mj-max').value=j.max_pasien;
    document.getElementById('mj-treatment').value=j.treatment_id||'';
    document.getElementById('mj-status').value=j.status;
    openModal('modal-jadwal');
}

// ── TREATMENT ──
function editTreatment(t){
    document.getElementById('mt-title').innerHTML='Edit <em>Treatment</em>';
    document.getElementById('form-treatment').action='../../backend/admin/simpan_treatment.php';
    document.getElementById('mt-id').value=t.id;
    document.getElementById('mt-nama').value=t.nama;
    document.getElementById('mt-kategori').value=t.kategori;
    document.getElementById('mt-urutan').value=t.urutan;
    document.getElementById('mt-gambar').value=t.gambar_url||'';
    document.getElementById('mt-link').value=t.link_halaman||'';
    document.getElementById('mt-desc').value=t.deskripsi||'';
    document.getElementById('mt-desc-panjang').value=t.deskripsi_panjang||'';
    document.getElementById('mt-status').value=t.status;
    openModal('modal-treatment');
}

function lihatPesan(pk) {
    document.getElementById('mp-detail-nama').textContent  = pk.nama  || '-';
    document.getElementById('mp-detail-telp').textContent  = pk.telepon || '-';
    document.getElementById('mp-detail-email').textContent = pk.email  || '-';
    document.getElementById('mp-detail-pesan').textContent = pk.pesan  || '-';
    document.getElementById('mp-pengirim-sub').textContent =
        'Dikirim pada ' + new Date(pk.created_at.replace(' ','T')).toLocaleString('id-ID');
 
    // Tombol "Tandai Baca" jika belum dibaca
    const footer = document.getElementById('mp-detail-footer');
    const existing = footer.querySelector('form.baca-form');
    if (existing) existing.remove();
 
    if (!pk.sudah_baca || pk.sudah_baca == 0) {
        const f = document.createElement('form');
        f.method = 'POST';
        f.action = '../../backend/admin/kelola_pesan.php';
        f.className = 'baca-form';
        f.style.display = 'inline';
        f.innerHTML = `
            <input type="hidden" name="aksi" value="baca">
            <input type="hidden" name="id"   value="${pk.id}">
            <button type="submit" class="btn-save">✅ Tandai Sudah Dibaca</button>
        `;
        footer.insertBefore(f, footer.querySelector('button.btn-cancel'));
    }
 
    openModal('modal-pesan');
}
// Set form action untuk Tambah baru
document.getElementById('form-pasien').action='../../backend/admin/simpan_pasien.php';
document.getElementById('form-dokter').action='../../backend/admin/simpan_dokter.php';
document.getElementById('form-jadwal').action='../../backend/admin/simpan_jadwal.php';
document.getElementById('form-treatment').action='../../backend/admin/simpan_treatment.php';

// ── CONFIRM DELETE ──
function confirmDelete(file,id,nama){
    document.getElementById('confirm-desc').textContent='Data '+nama+' akan dihapus permanen dan tidak bisa dikembalikan.';
    document.getElementById('confirm-form').action='../../backend/admin/'+file;
    document.getElementById('confirm-id').value=id;
    document.getElementById('confirm-overlay').classList.add('open');
}
function closeConfirm(){document.getElementById('confirm-overlay').classList.remove('open');}

// Toast dari URL param
const up=new URLSearchParams(window.location.search);
if(up.get('success')) showToast(decodeURIComponent(up.get('success')));
if(up.get('error'))   showToast(decodeURIComponent(up.get('error')),false);
</script>
</body>
</html>
<?php mysqli_close($conn); ?>