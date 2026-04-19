<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Landing_Page</title>
        <!-- link ini dari google font karena pakai font eksternal dari google -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;1,400&family=DM+Sans:wght@300;400;500&display=swap">
        <link rel="stylesheet" href="asset/css/style.css">
    </head>
    <body>
        <!-- HEADER -->
        <header>
            <div class="logo">GlowCare Clinic</div>
            <nav>
                <a href="#beranda">Beranda</a>
                <a href="#tentang">Tentang kami</a>
                <a href="#treatment">Treatment</a>
                <a href="#treatment">Spesialis</a>
                <a href="jadwal.php">Jadwal</a>
                <a href="#kontak">Kontak</a>
                <a href="SignUp.php" class="btn">Sign Up</a>
            </nav>
        </header>
        <main>
            <!-- ══ HERO ══ -->
            <article id="beranda" class="hero">
                <section class="hero-left">
                    <p class="hero-eyebrow">Premium Beauty Clinic</p>
                    <h1 class="hero-title">
                        Enhance Your
                        <em>Natural Beauty</em>
                    </h1>
                    <div class="hero-divider"><div class="divider-dot"></div></div>
                    <p class="hero-text">
                        Rasakan pengalaman perawatan kecantikan eksklusif yang dirancang untuk menonjolkan
                        kecantikan alami Anda.
                    </p>
                    <div class="hero-buttons">
                        <a href="#jadwal" class="btn-primary">Book Appointment</a>
                        <a href="#treatment" class="btn-secondary">Explore Services</a>
                    </div>
                </section>
                <section class="hero-right">
                    <img src="asset/img/heroa.png" alt="Beauty"/>
                </section>
            
                <section class="hero-stats-bar">
                    <div class="stat-item"><div class="stat-num">5.000+</div><div class="stat-label">Happy Clients</div></div>
                    <div class="stat-item"><div class="stat-num">15+</div><div class="stat-label">Treatments</div></div>
                    <div class="stat-item"><div class="stat-num">8+</div><div class="stat-label">Specialists</div></div>
                    <div class="stat-item"><div class="stat-num">6 Thn</div><div class="stat-label">Pengalaman</div></div>
                </section>
            </article>
            
            <!-- Treatment -->
            <section id="treatment">
                <h2 class="section-header">Pilihan <em>Treatment</em></h2>
                <div class="treatment-grid">
                    <div class="treatment-card">
                        <img src="https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=600&auto=format&fit=crop&q=80" alt="Facial" class="treatment-img"/>
                        <div class="treatment-body">
                            <h3 class="treatment-name">Luxury Facial</h3>
                            <p class="treatment-desc">Perawatan wajah mendalam dengan serum premium dan teknik massage eksklusif.</p>
                        </div>
                    </div>
                    <div class="treatment-card">
                        <img src="https://images.unsplash.com/photo-1512290923902-8a9f81dc236c?w=600&auto=format&fit=crop&q=80" alt="Laser" class="treatment-img"/>
                        <div class="treatment-body">
                            <h3 class="treatment-name">Laser Facial</h3>
                            <p class="treatment-desc">Teknologi laser terkini untuk mengatasi flek, bekas jerawat, dan tanda penuaan secara efektif dan aman.</p>
                        </div>
                    </div>
                    <div class="treatment-card">
                        <img src="https://images.unsplash.com/photo-1515377905703-c4788e51af15?w=600&auto=format&fit=crop&q=80" alt="Hydrafacial" class="treatment-img"/>
                        <div class="treatment-body">
                            <h3 class="treatment-name">Hydra Facial</h3>
                            <p class="treatment-desc">Pembersihan mendalam sekaligus hidrasi intensif menggunakan teknologi vortex untuk kulit sehat.</p>
                        </div>
                    </div>
                    <div class="treatment-card">
                        <img src="asset/img/chemicalPeeling.jpg" alt="Chemical Peeling" class="treatment-img"/>
                        <div class="treatment-body">
                            <h3 class="treatment-name">Chemical Peeling</h3>
                            <p class="treatment-desc">Pengolesan cairan kimia khusus untuk mengelupas lapisan kulit mati. Tujuannya untuk mencerahkan, meratakan warna kulit, dan memperbaiki tekstur.</p>
                        </div>
                    </div>
                    <div class="treatment-card">
                        <img src="asset/img/microdermabrasion.jpg" alt="Microdermabrasion" class="treatment-img"/>
                        <div class="treatment-body">
                            <h3 class="treatment-name">Microdermabrasion</h3>
                            <p class="treatment-desc">Teknik pengelupasan kulit menggunakan kristal halus atau tip berlian untuk mengangkat sel kulit mati, sehingga kulit terasa lebih halus dan pori-pori tampak mengecil.</p>
                        </div>
                    </div>
                    <div class="treatment-card">
                        <img src="asset/img/skinBooster.jpg" alt="Skin Booster" class="treatment-img"/>
                        <div class="treatment-body">
                            <h3 class="treatment-name">Skin Booster</h3>
                            <p class="treatment-desc">Suntikan nutrisi atau asam hialuronat dosis rendah ke seluruh permukaan wajah untuk memberikan hidrasi mendalam dan efek kulit bercahaya (glowing).</p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Kontak -->
            <section id="kontak">
                <h2 class="section-header">Hubungi <em>Kami</em></h2>
                <form class="kontak-form">
                    <p class="form-subtitle">Isi form di bawah dan tim kami akan menghubungi Anda untuk konfirmasi jadwal.</p>
                    
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-input"  name="nama" placeholder="Nama kamu"> <!-- placeholder itu teks petunjuk sementara dalam input -->
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Telepon</label>
                        <input type="tel" class="form-input" name="telp" placeholder="+62"> 
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-input" name="email" placeholder="email@contoh.com" > 
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Pesan</label>
                        <textarea class="form-textarea" name="pesan" placeholder="Ceritakan keluhan atau pertanyaan kamu..."></textarea>
                        <!-- textarea itu bisa input lebih sebaris dan bisa input enter juga -->
                    </div>
                    <button type="submit" class="btn">Kirim Pesan</button>
                </form>
            </section>
        </main>
        <!-- FOOTER -->
        <footer>
            <div class="logo">GlowCare Clinic</div>
            <div class="footer-copy">@2025 GlowCare Clinic. All rights reserved.</div>
        </footer>

        <script src="asset/js/script.js"></script>
    </body>
</html>