<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlowCare — Dashboard Dokter</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=DM+Sans:wght@300;400;500&display=swap">
    <link rel="stylesheet" href="../../asset/css/dokter.css">
</head>
<body>

    <!-- ══ SIDEBAR ══ -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="brand">GlowCare Clinic</div>
            <div class="role">Doctor Portal</div>
        </div>

        <div class="sidebar-doctor">
            <div class="sidebar-doc-avatar">
                <img src="https://images.unsplash.com/photo-1651008376811-b90baee60c1f?auto=format&fit=crop&w=200&q=80" alt="Dr. Anisa">
            </div>
            <div class="sidebar-doc-info">
                <div class="doc-name">Dr. Anisa Putri</div>
                <div class="doc-spec">Plastic Surgeon</div>
                <div class="doc-status">Sedang Bertugas</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Menu Utama</div>
            <a class="nav-item active" onclick="showPanel('overview', this)">
                <span class="nav-icon">📊</span> Overview
            </a>
            <a class="nav-item" onclick="showPanel('jadwal', this)">
                <span class="nav-icon">📅</span> Jadwal Praktik
            </a>

            <div class="nav-section-label" style="margin-top:8px">Pasien</div>
            <a class="nav-item" onclick="showPanel('daftar-pasien', this)">
                <span class="nav-icon">👥</span> Daftar Pasien
                <span class="nav-badge">5</span>
            </a>
            <a class="nav-item" onclick="showPanel('rekam-medis', this)">
                <span class="nav-icon">📋</span> Rekam Medis
            </a>

            <div class="nav-section-label" style="margin-top:8px">Akun</div>
            <a class="nav-item" onclick="showPanel('profil', this)">
                <span class="nav-icon">👤</span> Profil Saya
            </a>
        </nav>

        <div class="sidebar-footer">
            <a class="logout-btn">
                <span>↩</span> Keluar
            </a>
        </div>
    </aside>

    <!-- ══ MAIN ══ -->
    <div class="main">

        <!-- TOPBAR -->
        <div class="topbar">
            <div>
                <div class="topbar-title" id="topbar-title">Overview</div>
                <div class="topbar-bc" id="topbar-bc">GlowCare Dokter → Overview</div>
            </div>
            <div class="topbar-right">
                <div class="topbar-date">📅 Sabtu, 02 Mei 2026</div>
                <div class="notif-btn">🔔<div class="notif-dot"></div></div>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="content">

            <!-- ══ PANEL: OVERVIEW ══ -->
            <div class="panel active" id="panel-overview">
                <p class="section-sub">Selamat pagi, <strong>Dr. Anisa</strong> — berikut ringkasan hari ini.</p>

                <div class="stats-row">
                    <div class="stat-card">
                        <div class="stat-icon">📅</div>
                        <div class="stat-value">8</div>
                        <div class="stat-label">Jadwal Hari Ini</div>
                    </div>
                    <div class="stat-card teal">
                        <div class="stat-icon">✅</div>
                        <div class="stat-value">3</div>
                        <div class="stat-label">Sudah Ditangani</div>
                    </div>
                    <div class="stat-card purple">
                        <div class="stat-icon">⏳</div>
                        <div class="stat-value">5</div>
                        <div class="stat-label">Menunggu</div>
                    </div>
                    <div class="stat-card orange">
                        <div class="stat-icon">👥</div>
                        <div class="stat-value">412</div>
                        <div class="stat-label">Total Pasien</div>
                    </div>
                </div>

                <div class="two-col">
                    <!-- Jadwal hari ini -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Jadwal Hari Ini</div>
                            <a class="card-action" onclick="showPanel('jadwal', document.querySelector('[onclick*=jadwal]'))">Lihat semua →</a>
                        </div>
                        <div class="schedule-list">
                            <div class="schedule-item">
                                <div class="sch-time-col">09:00</div>
                                <div class="sch-bar pink"></div>
                                <div>
                                    <div class="sch-info-title">Siti Rahayu</div>
                                    <div class="sch-info-sub">Facelift Consultation · Selesai ✓</div>
                                </div>
                                <span class="badge badge-green" style="margin-left:auto; align-self:center">Selesai</span>
                            </div>
                            <div class="schedule-item">
                                <div class="sch-time-col">10:30</div>
                                <div class="sch-bar teal"></div>
                                <div>
                                    <div class="sch-info-title">Dewi Anggraini</div>
                                    <div class="sch-info-sub">Rhinoplasty Consultation · Selesai ✓</div>
                                </div>
                                <span class="badge badge-green" style="margin-left:auto; align-self:center">Selesai</span>
                            </div>
                            <div class="schedule-item">
                                <div class="sch-time-col">12:00</div>
                                <div class="sch-bar purple"></div>
                                <div>
                                    <div class="sch-info-title">Maya Sari</div>
                                    <div class="sch-info-sub">Blepharoplasty · Berlangsung</div>
                                </div>
                                <span class="badge badge-yellow" style="margin-left:auto; align-self:center">Berlangsung</span>
                            </div>
                            <div class="schedule-item">
                                <div class="sch-time-col">13:30</div>
                                <div class="sch-bar"></div>
                                <div>
                                    <div class="sch-info-title">Rina Wulandari</div>
                                    <div class="sch-info-sub">Facelift Follow-up</div>
                                </div>
                                <span class="badge badge-pink" style="margin-left:auto; align-self:center">Menunggu</span>
                            </div>
                            <div class="schedule-item">
                                <div class="sch-time-col">15:00</div>
                                <div class="sch-bar orange"></div>
                                <div>
                                    <div class="sch-info-title">Andini Kusuma</div>
                                    <div class="sch-info-sub">Body Contouring Consultation</div>
                                </div>
                                <span class="badge badge-gray" style="margin-left:auto; align-self:center">Terjadwal</span>
                            </div>
                        </div>
                    </div>

                    <!-- Pasien berikutnya -->
                    <div style="display:flex; flex-direction:column; gap:22px">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Pasien Berikutnya</div>
                            </div>
                            <div style="padding: 0 24px 24px">
                                <div style="display:flex; align-items:center; gap:14px; margin-bottom:16px">
                                    <div class="pasien-detail-avatar" style="width:52px;height:52px;font-size:18px">M</div>
                                    <div>
                                        <div style="font-family:'Playfair Display',serif; font-size:16px; color:#3d1a22">Maya Sari</div>
                                        <div style="font-size:11px; color:#b89098">28 Tahun · Perempuan</div>
                                    </div>
                                    <span class="badge badge-yellow" style="margin-left:auto">12:00</span>
                                </div>
                                <div style="background:#fdf0f5; border-radius:8px; padding:14px; font-size:12px; color:#7a4d5c; line-height:1.7; font-weight:300">
                                    <strong style="color:#3d1a22; font-size:11px; letter-spacing:1px; text-transform:uppercase">Keluhan:</strong><br>
                                    Kelopak mata atas terasa berat dan mulai menutupi pandangan, menginginkan koreksi blepharoplasty fungsional dan estetika.
                                </div>
                                <div style="display:flex; gap:8px; margin-top:14px">
                                    <button class="btn-primary" style="font-size:10px; padding:8px 18px" onclick="openModal('modal-rm-baru')">+ Rekam Medis</button>
                                    <button class="btn-outline" style="font-size:10px; padding:8px 18px" onclick="showPanel('rekam-medis', document.querySelector('[onclick*=rekam-medis]'))">Lihat Riwayat</button>
                                </div>
                            </div>
                        </div>

                        <!-- Quick stats -->
                        <div class="card">
                            <div class="card-header"><div class="card-title">Statistik Bulan Ini</div></div>
                            <div style="padding:0 24px 20px; display:flex; flex-direction:column; gap:14px">
                                <div style="display:flex; justify-content:space-between; align-items:center">
                                    <span style="font-size:12px; color:#7a4d5c">Total Pasien Ditangani</span>
                                    <span style="font-family:'Playfair Display',serif; font-size:18px; color:#c55085">86</span>
                                </div>
                                <div style="height:1px; background:#fdf0f5"></div>
                                <div style="display:flex; justify-content:space-between; align-items:center">
                                    <span style="font-size:12px; color:#7a4d5c">Treatment Facelift</span>
                                    <span style="font-size:14px; color:#3d1a22; font-weight:500">34</span>
                                </div>
                                <div style="display:flex; justify-content:space-between; align-items:center">
                                    <span style="font-size:12px; color:#7a4d5c">Rhinoplasty</span>
                                    <span style="font-size:14px; color:#3d1a22; font-weight:500">28</span>
                                </div>
                                <div style="display:flex; justify-content:space-between; align-items:center">
                                    <span style="font-size:12px; color:#7a4d5c">Blepharoplasty</span>
                                    <span style="font-size:14px; color:#3d1a22; font-weight:500">24</span>
                                </div>
                                <div style="height:1px; background:#fdf0f5"></div>
                                <div style="display:flex; justify-content:space-between; align-items:center">
                                    <span style="font-size:12px; color:#7a4d5c">Rating Rata-rata</span>
                                    <span style="font-size:14px; color:#3d1a22; font-weight:500">⭐ 5.0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ══ PANEL: JADWAL ══ -->
            <div class="panel" id="panel-jadwal">
                <div class="page-header">
                    <div>
                        <h2 class="section-title">Jadwal <em>Praktik</em></h2>
                        <p class="section-sub">Jadwal yang telah ditentukan oleh admin klinik</p>
                    </div>
                    <div style="display:flex; gap:10px; align-items:center">
                        <div style="font-size:11px; color:#b89098; padding:8px 14px; background:#fff; border:1px solid #f2c4ce; border-radius:50px">
                            ← 28 Apr – 03 Mei 2026 →
                        </div>
                    </div>
                </div>

                <!-- Week grid -->
                <div class="week-grid">
                    <div class="wg-head">Jam</div>
                    <div class="wg-head">Senin<br><span style="font-size:10px; color:#c55085">28 Apr</span></div>
                    <div class="wg-head">Selasa<br><span style="font-size:10px">29 Apr</span></div>
                    <div class="wg-head">Rabu<br><span style="font-size:10px">30 Apr</span></div>
                    <div class="wg-head">Kamis<br><span style="font-size:10px">01 Mei</span></div>
                    <div class="wg-head">Jumat<br><span style="font-size:10px; color:#c55085">02 Mei ●</span></div>
                    <div class="wg-head">Sabtu<br><span style="font-size:10px">03 Mei</span></div>

                    <div class="wg-time">09:00</div>
                    <div class="wg-cell"><div class="wg-event">Siti R.<br>Facelift</div></div>
                    <div class="wg-cell"></div>
                    <div class="wg-cell"><div class="wg-event teal">Andini K.<br>Konsultasi</div></div>
                    <div class="wg-cell"></div>
                    <div class="wg-cell"><div class="wg-event">Maya S.<br>Blepharoplasty</div></div>
                    <div class="wg-cell"></div>

                    <div class="wg-time">10:30</div>
                    <div class="wg-cell"><div class="wg-event purple">Dewi A.<br>Rhinoplasty</div></div>
                    <div class="wg-cell"></div>
                    <div class="wg-cell"></div>
                    <div class="wg-cell"><div class="wg-event">Rina W.<br>Facelift</div></div>
                    <div class="wg-cell"><div class="wg-event teal">Dewi A.<br>Follow-up</div></div>
                    <div class="wg-cell"><div class="wg-event purple">Budi S.<br>Konsultasi</div></div>

                    <div class="wg-time">13:00</div>
                    <div class="wg-cell"></div>
                    <div class="wg-cell"><div class="wg-event orange">Maya S.<br>Follow-up</div></div>
                    <div class="wg-cell"><div class="wg-event">Siti R.<br>Follow-up</div></div>
                    <div class="wg-cell"></div>
                    <div class="wg-cell"><div class="wg-event orange">Rina W.<br>Follow-up</div></div>
                    <div class="wg-cell"></div>

                    <div class="wg-time">15:00</div>
                    <div class="wg-cell"><div class="wg-event teal">Andini K.<br>Body Cont.</div></div>
                    <div class="wg-cell"></div>
                    <div class="wg-cell"></div>
                    <div class="wg-cell"><div class="wg-event purple">Maya S.<br>Rhinoplasty</div></div>
                    <div class="wg-cell"><div class="wg-event">Andini K.<br>Konsultasi</div></div>
                    <div class="wg-cell"></div>
                </div>

                <!-- Detail list -->
                <div class="card">
                    <div class="card-header"><div class="card-title">Detail Jadwal Hari Ini — Jumat, 02 Mei 2026</div></div>
                    <table class="data-table">
                        <thead>
                            <tr><th>Jam</th><th>Pasien</th><th>Treatment</th><th>Ruangan</th><th>Durasi</th><th>Status</th><th>Aksi</th></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="td-jam" style="color:#c55085; font-weight:500">09:00</td>
                                <td><span class="avatar">S</span><span class="td-name">Siti Rahayu</span></td>
                                <td>Facelift Consultation</td>
                                <td>Ruang A-1</td>
                                <td>60 menit</td>
                                <td><span class="badge badge-green">Selesai</span></td>
                                <td><button class="act-btn" onclick="showPanel('rekam-medis', document.querySelector('[onclick*=rekam-medis]'))">📋</button></td>
                            </tr>
                            <tr>
                                <td class="td-jam" style="color:#c55085; font-weight:500">10:30</td>
                                <td><span class="avatar">D</span><span class="td-name">Dewi Anggraini</span></td>
                                <td>Rhinoplasty Follow-up</td>
                                <td>Ruang A-1</td>
                                <td>45 menit</td>
                                <td><span class="badge badge-green">Selesai</span></td>
                                <td><button class="act-btn" onclick="showPanel('rekam-medis', document.querySelector('[onclick*=rekam-medis]'))">📋</button></td>
                            </tr>
                            <tr>
                                <td class="td-jam" style="color:#c55085; font-weight:500">12:00</td>
                                <td><span class="avatar">M</span><span class="td-name">Maya Sari</span></td>
                                <td>Blepharoplasty</td>
                                <td>Ruang Operasi B</td>
                                <td>90 menit</td>
                                <td><span class="badge badge-yellow">Berlangsung</span></td>
                                <td><button class="act-btn" onclick="openModal('modal-rm-baru')">📋</button></td>
                            </tr>
                            <tr>
                                <td class="td-jam">13:30</td>
                                <td><span class="avatar">R</span><span class="td-name">Rina Wulandari</span></td>
                                <td>Facelift Follow-up</td>
                                <td>Ruang A-2</td>
                                <td>30 menit</td>
                                <td><span class="badge badge-pink">Menunggu</span></td>
                                <td><button class="act-btn">📋</button></td>
                            </tr>
                            <tr>
                                <td class="td-jam">15:00</td>
                                <td><span class="avatar">A</span><span class="td-name">Andini Kusuma</span></td>
                                <td>Body Contouring Consultation</td>
                                <td>Ruang A-1</td>
                                <td>60 menit</td>
                                <td><span class="badge badge-gray">Terjadwal</span></td>
                                <td><button class="act-btn">📋</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ══ PANEL: DAFTAR PASIEN ══ -->
            <div class="panel" id="panel-daftar-pasien">
                <div class="page-header">
                    <div>
                        <h2 class="section-title">Daftar <em>Pasien</em></h2>
                        <p class="section-sub">Pasien yang akan dan pernah berkonsultasi dengan Anda</p>
                    </div>
                </div>

                <div class="filter-bar">
                    <input class="filter-input" type="text" placeholder="🔍 Cari nama pasien...">
                    <select class="filter-select">
                        <option>Semua Status</option>
                        <option>Hari Ini</option>
                        <option>Menunggu</option>
                        <option>Selesai</option>
                    </select>
                    <select class="filter-select">
                        <option>Semua Treatment</option>
                        <option>Facelift</option>
                        <option>Rhinoplasty</option>
                        <option>Blepharoplasty</option>
                        <option>Body Contouring</option>
                    </select>
                </div>

                <div class="card">
                    <table class="data-table">
                        <thead>
                            <tr><th>Pasien</th><th>Usia</th><th>Kontak</th><th>Treatment</th><th>Jadwal</th><th>Kunjungan</th><th>Status</th><th>Aksi</th></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="avatar">S</span><div style="display:inline-block; vertical-align:middle"><span class="td-name">Siti Rahayu</span><span class="td-sub">#P-0041</span></div></td>
                                <td>28 Thn</td>
                                <td><div style="font-size:12px">+62 812 1234 5678</div></td>
                                <td>Facelift</td>
                                <td style="color:#c55085; font-size:12px">Hari ini 09:00</td>
                                <td style="text-align:center">12</td>
                                <td><span class="badge badge-green">Selesai</span></td>
                                <td>
                                    <button class="act-btn" title="Lihat detail" onclick="showPasienDetail('Siti Rahayu')">👁️</button>
                                    <button class="act-btn" title="Rekam medis" onclick="openModal('modal-rm-baru')">📋</button>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="avatar">D</span><div style="display:inline-block; vertical-align:middle"><span class="td-name">Dewi Anggraini</span><span class="td-sub">#P-0044</span></div></td>
                                <td>38 Thn</td>
                                <td><div style="font-size:12px">+62 878 5555 6666</div></td>
                                <td>Rhinoplasty</td>
                                <td style="color:#c55085; font-size:12px">Hari ini 10:30</td>
                                <td style="text-align:center">9</td>
                                <td><span class="badge badge-green">Selesai</span></td>
                                <td>
                                    <button class="act-btn" onclick="showPasienDetail('Dewi Anggraini')">👁️</button>
                                    <button class="act-btn" onclick="openModal('modal-rm-baru')">📋</button>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="avatar">M</span><div style="display:inline-block; vertical-align:middle"><span class="td-name">Maya Sari</span><span class="td-sub">#P-0048</span></div></td>
                                <td>31 Thn</td>
                                <td><div style="font-size:12px">+62 813 7777 8888</div></td>
                                <td>Blepharoplasty</td>
                                <td style="color:#c9970e; font-size:12px">Hari ini 12:00</td>
                                <td style="text-align:center">3</td>
                                <td><span class="badge badge-yellow">Berlangsung</span></td>
                                <td>
                                    <button class="act-btn" onclick="showPasienDetail('Maya Sari')">👁️</button>
                                    <button class="act-btn" onclick="openModal('modal-rm-baru')">📋</button>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="avatar">R</span><div style="display:inline-block; vertical-align:middle"><span class="td-name">Rina Wulandari</span><span class="td-sub">#P-0043</span></div></td>
                                <td>25 Thn</td>
                                <td><div style="font-size:12px">+62 857 3333 4444</div></td>
                                <td>Facelift Follow-up</td>
                                <td style="font-size:12px">Hari ini 13:30</td>
                                <td style="text-align:center">5</td>
                                <td><span class="badge badge-pink">Menunggu</span></td>
                                <td>
                                    <button class="act-btn" onclick="showPasienDetail('Rina Wulandari')">👁️</button>
                                    <button class="act-btn" onclick="openModal('modal-rm-baru')">📋</button>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="avatar">A</span><div style="display:inline-block; vertical-align:middle"><span class="td-name">Andini Kusuma</span><span class="td-sub">#P-0042</span></div></td>
                                <td>32 Thn</td>
                                <td><div style="font-size:12px">+62 813 9876 5432</div></td>
                                <td>Body Contouring</td>
                                <td style="font-size:12px">Hari ini 15:00</td>
                                <td style="text-align:center">7</td>
                                <td><span class="badge badge-gray">Terjadwal</span></td>
                                <td>
                                    <button class="act-btn" onclick="showPasienDetail('Andini Kusuma')">👁️</button>
                                    <button class="act-btn" onclick="openModal('modal-rm-baru')">📋</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Detail pasien (tersembunyi, muncul saat klik 👁️) -->
                <div id="pasien-detail-box" style="display:none; margin-top:22px">
                    <div class="card">
                        <div class="pasien-detail-header">
                            <div class="pasien-detail-avatar" id="detail-avatar">S</div>
                            <div>
                                <div class="pasien-detail-name" id="detail-name">Siti Rahayu</div>
                                <div class="pasien-detail-meta">28 Tahun · Perempuan · #P-0041</div>
                            </div>
                            <div style="margin-left:auto; display:flex; gap:10px; align-items:center">
                                <span class="badge badge-green">Pasien Aktif</span>
                                <button class="btn-outline" style="font-size:10px; padding:7px 16px" onclick="openModal('modal-rm-baru')">+ Rekam Medis</button>
                            </div>
                        </div>
                        <div class="info-grid">
                            <div class="info-item"><div class="info-label">Telepon</div><div class="info-value">+62 812 1234 5678</div></div>
                            <div class="info-item"><div class="info-label">Email</div><div class="info-value">siti@email.com</div></div>
                            <div class="info-item"><div class="info-label">Golongan Darah</div><div class="info-value">O+</div></div>
                            <div class="info-item"><div class="info-label">Alergi</div><div class="info-value">Tidak ada</div></div>
                            <div class="info-item"><div class="info-label">Kondisi Khusus</div><div class="info-value">Hipertensi ringan</div></div>
                            <div class="info-item"><div class="info-label">Total Kunjungan</div><div class="info-value">12 kali</div></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ══ PANEL: REKAM MEDIS ══ -->
            <div class="panel" id="panel-rekam-medis">
                <div class="page-header">
                    <div>
                        <h2 class="section-title">Rekam <em>Medis</em></h2>
                        <p class="section-sub">Kelola dan perbarui rekam medis pasien</p>
                    </div>
                    <button class="btn-primary" onclick="openModal('modal-rm-baru')">+ Tambah Rekam Medis</button>
                </div>

                <div class="filter-bar">
                    <input class="filter-input" type="text" placeholder="🔍 Cari nama pasien...">
                    <select class="filter-select">
                        <option>Semua Treatment</option>
                        <option>Facelift</option>
                        <option>Rhinoplasty</option>
                        <option>Blepharoplasty</option>
                    </select>
                    <select class="filter-select">
                        <option>Semua Bulan</option>
                        <option>Mei 2026</option>
                        <option>April 2026</option>
                        <option>Maret 2026</option>
                    </select>
                </div>

                <!-- Tabs -->
                <div class="rm-tabs">
                    <div class="rm-tab active" onclick="switchTab('rm-list', this)">Daftar Rekam Medis</div>
                    <div class="rm-tab" onclick="switchTab('rm-timeline', this)">Timeline Pasien</div>
                </div>

                <!-- Tab: List -->
                <div class="rm-content active" id="tab-rm-list">
                    <div class="rm-card">
                        <div class="rm-card-header">
                            <div>
                                <div class="rm-card-title">Siti Rahayu · Facelift Consultation</div>
                                <div style="font-size:11px; color:#b89098; margin-top:3px">#P-0041 · Ruang A-1</div>
                            </div>
                            <div style="text-align:right">
                                <div class="rm-date">02 Mei 2026 · 09:00</div>
                                <span class="badge badge-green" style="margin-top:6px; display:inline-block">Selesai</span>
                            </div>
                        </div>
                        <div class="rm-body">
                            <strong style="font-size:11px; letter-spacing:1px; text-transform:uppercase; color:#3d1a22">Anamnesis:</strong><br>
                            Pasien mengeluhkan kulit wajah yang mulai kendur di area pipi dan leher sejak 2 tahun terakhir. Tidak ada riwayat operasi wajah sebelumnya. Tekanan darah normal 120/80 mmHg.
                            <br><br>
                            <strong style="font-size:11px; letter-spacing:1px; text-transform:uppercase; color:#3d1a22">Rencana Tindakan:</strong><br>
                            Direncanakan prosedur mini facelift dengan pendekatan SMAS teknik untuk mengencangkan area mid-face dan cervical. Dijadwalkan 3 minggu ke depan.
                        </div>
                        <div class="rm-tags">
                            <span class="rm-tag">Facelift</span>
                            <span class="rm-tag">SMAS</span>
                            <span class="rm-tag">Follow-up: 23 Mei</span>
                        </div>
                        <div style="display:flex; gap:8px; margin-top:16px">
                            <button class="btn-outline" style="font-size:10px; padding:7px 16px" onclick="openModal('modal-rm-edit')">✏️ Edit</button>
                            <button class="btn-outline" style="font-size:10px; padding:7px 16px">🖨️ Cetak</button>
                        </div>
                    </div>

                    <div class="rm-card">
                        <div class="rm-card-header">
                            <div>
                                <div class="rm-card-title">Dewi Anggraini · Rhinoplasty Follow-up</div>
                                <div style="font-size:11px; color:#b89098; margin-top:3px">#P-0044 · Ruang A-1</div>
                            </div>
                            <div style="text-align:right">
                                <div class="rm-date">02 Mei 2026 · 10:30</div>
                                <span class="badge badge-green" style="margin-top:6px; display:inline-block">Selesai</span>
                            </div>
                        </div>
                        <div class="rm-body">
                            <strong style="font-size:11px; letter-spacing:1px; text-transform:uppercase; color:#3d1a22">Evaluasi Pasca Operasi:</strong><br>
                            Pasien kontrol minggu ke-6 pasca rhinoplasty. Pembengkakan berkurang signifikan, bentuk hidung sesuai target. Tidak ada tanda infeksi. Jahitan sudah lepas dengan baik.
                            <br><br>
                            <strong style="font-size:11px; letter-spacing:1px; text-transform:uppercase; color:#3d1a22">Catatan:</strong><br>
                            Pasien disarankan menghindari aktivitas berat 2 minggu lagi. Kontrol berikutnya 3 bulan mendatang.
                        </div>
                        <div class="rm-tags">
                            <span class="rm-tag">Rhinoplasty</span>
                            <span class="rm-tag">Post-op W6</span>
                            <span class="rm-tag">Follow-up: Agustus 2026</span>
                        </div>
                        <div style="display:flex; gap:8px; margin-top:16px">
                            <button class="btn-outline" style="font-size:10px; padding:7px 16px" onclick="openModal('modal-rm-edit')">✏️ Edit</button>
                            <button class="btn-outline" style="font-size:10px; padding:7px 16px">🖨️ Cetak</button>
                        </div>
                    </div>

                    <div class="rm-card">
                        <div class="rm-card-header">
                            <div>
                                <div class="rm-card-title">Rina Wulandari · Facelift Consultation</div>
                                <div style="font-size:11px; color:#b89098; margin-top:3px">#P-0043 · Ruang A-2</div>
                            </div>
                            <div style="text-align:right">
                                <div class="rm-date">15 April 2026 · 11:00</div>
                                <span class="badge badge-green" style="margin-top:6px; display:inline-block">Selesai</span>
                            </div>
                        </div>
                        <div class="rm-body">
                            Konsultasi awal facelift. Pasien berusia 25 tahun dengan keluhan garis senyum mulai terlihat dan ingin peremajaan wajah secara keseluruhan. Disarankan untuk pendekatan non-surgical terlebih dahulu mengingat usia pasien.
                        </div>
                        <div class="rm-tags">
                            <span class="rm-tag">Facelift</span>
                            <span class="rm-tag">Konsultasi Awal</span>
                            <span class="rm-tag">Non-surgical</span>
                        </div>
                        <div style="display:flex; gap:8px; margin-top:16px">
                            <button class="btn-outline" style="font-size:10px; padding:7px 16px" onclick="openModal('modal-rm-edit')">✏️ Edit</button>
                            <button class="btn-outline" style="font-size:10px; padding:7px 16px">🖨️ Cetak</button>
                        </div>
                    </div>
                </div>

                <!-- Tab: Timeline -->
                <div class="rm-content" id="tab-rm-timeline">
                    <div style="margin-bottom:16px; display:flex; gap:10px; align-items:center">
                        <span style="font-size:12px; color:#7a4d5c">Pasien:</span>
                        <select class="filter-select">
                            <option>Siti Rahayu</option>
                            <option>Dewi Anggraini</option>
                            <option>Maya Sari</option>
                            <option>Rina Wulandari</option>
                        </select>
                    </div>
                    <div class="timeline">
                        <div class="tl-item">
                            <div class="tl-dot">💉</div>
                            <div class="tl-body">
                                <div class="tl-title">Facelift Consultation</div>
                                <div class="tl-desc">Konsultasi awal, evaluasi kondisi kulit dan rencana tindakan mini facelift SMAS technique.</div>
                                <div class="tl-date">02 Mei 2026</div>
                            </div>
                        </div>
                        <div class="tl-item">
                            <div class="tl-dot teal">✓</div>
                            <div class="tl-body">
                                <div class="tl-title">Botox Follow-up</div>
                                <div class="tl-desc">Evaluasi hasil botox forehead 4 minggu pasca tindakan. Hasil memuaskan, kerutan berkurang 70%.</div>
                                <div class="tl-date">10 April 2026</div>
                            </div>
                        </div>
                        <div class="tl-item">
                            <div class="tl-dot">💉</div>
                            <div class="tl-body">
                                <div class="tl-title">Botox Forehead</div>
                                <div class="tl-desc">Injeksi botox area dahi dan frown lines. Dosis total 24 unit. Tidak ada efek samping.</div>
                                <div class="tl-date">12 Maret 2026</div>
                            </div>
                        </div>
                        <div class="tl-item">
                            <div class="tl-dot gray">📋</div>
                            <div class="tl-body">
                                <div class="tl-title">Konsultasi Pertama</div>
                                <div class="tl-desc">Kunjungan pertama, asesmen kulit menyeluruh, perencanaan treatment jangka panjang.</div>
                                <div class="tl-date">05 Januari 2026</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ══ PANEL: PROFIL ══ -->
            <div class="panel" id="panel-profil">
                <div class="page-header">
                    <div>
                        <h2 class="section-title">Profil <em>Saya</em></h2>
                        <p class="section-sub">Kelola data profil dan informasi profesional Anda</p>
                    </div>
                    <button class="btn-primary" onclick="showToast('Profil berhasil disimpan ✓')">Simpan Perubahan</button>
                </div>

                <!-- Hero profil -->
                <div class="profil-hero">
                    <div class="profil-avatar-wrap">
                        <div class="profil-avatar">
                            <img src="https://images.unsplash.com/photo-1651008376811-b90baee60c1f?auto=format&fit=crop&w=400&q=80" alt="Dr. Anisa">
                        </div>
                        <div class="profil-edit-avatar">✏️</div>
                    </div>
                    <div class="profil-info">
                        <div class="profil-name">Dr. Anisa Putri, Sp.BP-RE</div>
                        <div class="profil-spec">Plastic Surgeon · GlowCare Clinic</div>
                        <div class="profil-meta">
                            <div class="profil-meta-item">
                                <span class="profil-meta-label">No. STR</span>
                                <span class="profil-meta-value">STR-4521/2014</span>
                            </div>
                            <div class="profil-meta-item">
                                <span class="profil-meta-label">Pengalaman</span>
                                <span class="profil-meta-value">10+ Tahun</span>
                            </div>
                            <div class="profil-meta-item">
                                <span class="profil-meta-label">Bergabung</span>
                                <span class="profil-meta-value">Maret 2018</span>
                            </div>
                            <div class="profil-meta-item">
                                <span class="profil-meta-label">Rating</span>
                                <span class="profil-meta-value">⭐ 5.0</span>
                            </div>
                        </div>
                        <div class="profil-tags">
                            <span class="profil-tag">Facelift</span>
                            <span class="profil-tag">Rhinoplasty</span>
                            <span class="profil-tag">Blepharoplasty</span>
                            <span class="profil-tag">Body Contouring</span>
                        </div>
                    </div>
                    <div class="profil-stats">
                        <div class="profil-stat">
                            <div class="profil-stat-val">412</div>
                            <div class="profil-stat-lbl">Total Pasien</div>
                        </div>
                        <div class="profil-stat" style="margin-top:8px">
                            <div class="profil-stat-val">86</div>
                            <div class="profil-stat-lbl">Bulan Ini</div>
                        </div>
                    </div>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:22px">
                    <!-- Data diri -->
                    <div class="card">
                        <div class="card-header"><div class="card-title">Data Pribadi</div></div>
                        <div style="padding:0 24px 24px">
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input class="form-input" value="Anisa Putri">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Gelar</label>
                                    <input class="form-input" value="Dr., Sp.BP-RE">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">No. Telepon</label>
                                    <input class="form-input" value="+62 811 2222 3333">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input class="form-input" value="anisa@glowcare.com">
                                </div>
                                <div class="form-group full">
                                    <label class="form-label">Alamat</label>
                                    <input class="form-input" value="Jl. Pejanggik No. 8, Mataram, NTB">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data profesional -->
                    <div class="card">
                        <div class="card-header"><div class="card-title">Informasi Profesional</div></div>
                        <div style="padding:0 24px 24px">
                            <div class="form-group">
                                <label class="form-label">Spesialisasi</label>
                                <select class="form-select">
                                    <option selected>Plastic Surgeon</option>
                                    <option>Aesthetic Physician</option>
                                    <option>Dermatologist</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">No. STR</label>
                                <input class="form-input" value="STR-4521/2014">
                            </div>
                            <div class="form-group">
                                <label class="form-label">No. SIP</label>
                                <input class="form-input" value="SIP-7812/2014">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tahun Pengalaman</label>
                                <input class="form-input" type="number" value="10">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Bio Singkat</label>
                                <textarea class="form-textarea">Berpengalaman lebih dari 10 tahun dalam prosedur bedah wajah dan rekonstruksi estetika. Lulusan FK UI dengan fellowship di Seoul Korea.</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Ganti password -->
                    <div class="card" style="grid-column:1/-1">
                        <div class="card-header"><div class="card-title">Keamanan Akun</div></div>
                        <div style="padding:0 24px 24px">
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Password Lama</label>
                                    <input class="form-input" type="password" placeholder="••••••••">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Password Baru</label>
                                    <input class="form-input" type="password" placeholder="••••••••">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Konfirmasi Password</label>
                                    <input class="form-input" type="password" placeholder="••••••••">
                                </div>
                            </div>
                            <button class="btn-outline" onclick="showToast('Password berhasil diubah ✓')">Ubah Password</button>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /content -->
    </div><!-- /main -->

    <!-- ══ MODAL: REKAM MEDIS BARU ══ -->
    <div class="modal-overlay" id="modal-rm-baru" onclick="closeModalOutside(event,'modal-rm-baru')">
        <div class="modal">
            <h3 class="modal-title">Tambah <em>Rekam Medis</em></h3>
            <p class="modal-sub">Isi data rekam medis pasien dengan lengkap</p>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nama Pasien</label>
                    <select class="form-select">
                        <option>Siti Rahayu (#P-0041)</option>
                        <option>Dewi Anggraini (#P-0044)</option>
                        <option>Maya Sari (#P-0048)</option>
                        <option>Rina Wulandari (#P-0043)</option>
                        <option>Andini Kusuma (#P-0042)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal Kunjungan</label>
                    <input class="form-input" type="date" value="2026-05-02">
                </div>
                <div class="form-group">
                    <label class="form-label">Treatment</label>
                    <select class="form-select">
                        <option>Facelift</option>
                        <option>Rhinoplasty</option>
                        <option>Blepharoplasty</option>
                        <option>Body Contouring</option>
                        <option>Konsultasi</option>
                        <option>Follow-up</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Ruangan</label>
                    <select class="form-select">
                        <option>Ruang A-1</option>
                        <option>Ruang A-2</option>
                        <option>Ruang Operasi B</option>
                    </select>
                </div>
                <div class="form-group full">
                    <label class="form-label">Anamnesis / Keluhan Pasien</label>
                    <textarea class="form-textarea" placeholder="Tulis keluhan dan riwayat penyakit pasien..."></textarea>
                </div>
                <div class="form-group full">
                    <label class="form-label">Hasil Pemeriksaan & Tindakan</label>
                    <textarea class="form-textarea" placeholder="Tuliskan hasil pemeriksaan fisik, tindakan yang dilakukan, dosis obat, dll..."></textarea>
                </div>
                <div class="form-group full">
                    <label class="form-label">Rencana Tindak Lanjut</label>
                    <textarea class="form-textarea" placeholder="Rencana follow-up, obat yang diberikan, jadwal kunjungan berikutnya..."></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select class="form-select">
                        <option>Selesai</option>
                        <option>Dalam Perawatan</option>
                        <option>Follow-up Diperlukan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Jadwal Follow-up</label>
                    <input class="form-input" type="date">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-outline" onclick="closeModal('modal-rm-baru')">Batal</button>
                <button class="btn-primary" onclick="closeModal('modal-rm-baru'); showToast('Rekam medis berhasil disimpan ✓')">Simpan Rekam Medis</button>
            </div>
        </div>
    </div>

    <!-- ══ MODAL: EDIT REKAM MEDIS ══ -->
    <div class="modal-overlay" id="modal-rm-edit" onclick="closeModalOutside(event,'modal-rm-edit')">
        <div class="modal">
            <h3 class="modal-title">Edit <em>Rekam Medis</em></h3>
            <p class="modal-sub">Perbarui data rekam medis — Siti Rahayu · 02 Mei 2026</p>
            <div class="form-group">
                <label class="form-label">Anamnesis / Keluhan Pasien</label>
                <textarea class="form-textarea">Pasien mengeluhkan kulit wajah yang mulai kendur di area pipi dan leher sejak 2 tahun terakhir. Tidak ada riwayat operasi wajah sebelumnya. Tekanan darah normal 120/80 mmHg.</textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Hasil Pemeriksaan & Tindakan</label>
                <textarea class="form-textarea">Direncanakan prosedur mini facelift dengan pendekatan SMAS teknik untuk mengencangkan area mid-face dan cervical. Dijadwalkan 3 minggu ke depan.</textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Rencana Tindak Lanjut</label>
                <textarea class="form-textarea">Follow-up pre-operasi 23 Mei 2026. Pasien diminta melakukan cek lab darah lengkap dan EKG.</textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select class="form-select"><option selected>Selesai</option><option>Follow-up Diperlukan</option></select>
                </div>
                <div class="form-group">
                    <label class="form-label">Jadwal Follow-up</label>
                    <input class="form-input" type="date" value="2026-05-23">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-outline" onclick="closeModal('modal-rm-edit')">Batal</button>
                <button class="btn-primary" onclick="closeModal('modal-rm-edit'); showToast('Rekam medis berhasil diperbarui ✓')">Perbarui</button>
            </div>
        </div>
    </div>

    <!-- Toast -->
    <div class="toast" id="toast">✅ <span id="toast-msg">Berhasil disimpan</span></div>

    <script src="../../asset/js/dokter.js"></script>
</body>
</html>