<!-- 
 Nama: Ni Komang Ayu Sumeitri
 NIM: F1D02410084 
-->

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
                <a href="#treatment">Treatment</a>
                <a href="jadwal.php">Jadwal</a>
                <a href="#kontak">Kontak</a>
                <a href="SignUp.php" class="btn">Sign Up</a>
            </nav>
        </header>
        <main>
            <section class="hero" id="beranda">
                <article class="hero-content">
                    <h2 class="hero-title">
                        Enhance Your
                        <em>Natural Beauty</em> <!-- tag ini memberikan style italic pada teks -->
                    </h2>
                    <p class="hero-text">
                        Rasakan pengalaman perawatan kecantikan eksklusif yang dirancang 
                        untuk menonjolkan kecantikan alami Anda.
                    </p>
                    <div class="hero-buttons">
                        <a href="#kontak" class="btn">Book Appointment</a>
                    </div>
                </article>
            </section>
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
                        <img src="https://images.unsplash.com/photo-1515377905703-c4788e51af15?w=600&auto=format&fit=crop&q=80" alt="Hydrafacial" class="treatment-img"/>
                        <div class="treatment-body">
                            <h3 class="treatment-name">Hydra Facial</h3>
                            <p class="treatment-desc">Pembersihan mendalam sekaligus hidrasi intensif menggunakan teknologi vortex untuk kulit sehat.</p>
                        </div>
                    </div>
                    <div class="treatment-card">
                        <img src="https://images.unsplash.com/photo-1515377905703-c4788e51af15?w=600&auto=format&fit=crop&q=80" alt="Hydrafacial" class="treatment-img"/>
                        <div class="treatment-body">
                            <h3 class="treatment-name">Hydra Facial</h3>
                            <p class="treatment-desc">Pembersihan mendalam sekaligus hidrasi intensif menggunakan teknologi vortex untuk kulit sehat.</p>
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
                        <input type="text" class="form-input" placeholder="Nama kamu" required> <!-- placeholder itu teks petunjuk sementara dalam input -->
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Telepon</label>
                        <input type="tel" class="form-input" placeholder="+62" required> <!-- required itu kasi pesan kalau belum di inputkan  -->
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-input" placeholder="email@contoh.com" required> 
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Pesan</label>
                        <textarea class="form-textarea" placeholder="Ceritakan keluhan atau pertanyaan kamu..."></textarea>
                        <!-- textarea itu bisa input lebih sebaris dan bisa input enter juga -->
                    </div>
                    <button type="submit" class="btn">Kirim Pesan</button>
                </form>
            </section>
        </main>
        <!-- FOOTER -->
        <footer>
            <div class="logo">BeautyCare</div>
            <div class="footer-copy">@2025 BeautyCare Clinic. All rights reserved.</div>
        </footer>
    </body>
</html>