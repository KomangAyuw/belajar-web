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
                <a href="#services">Treatment</a>
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
            
            <!-- Services -->
            <section id="services">
            <h2 class="section-header">Pilihan <em>Services</em></h2>
            <p class="section-subheader">Temukan rangkaian perawatan kecantikan eksklusif kami yang dirancang untuk menonjolkan kecantikan alami Anda</p>
        
            <div class="services-grid">
        
                <!-- Facelift -->
                <div class="service-card">
                    <div class="service-img-wrap">
                        <img 
                            src="https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=700&auto=format&fit=crop&q=80" 
                            alt="Facelift Procedures" 
                            class="service-img"
                        />
                        <div class="service-img-overlay"></div>
                    </div>
                    <div class="service-body">
                        <span class="service-tag">Surgical</span>
                        <h3 class="service-name">Facelift Procedures</h3>
                        <p class="service-desc">Teknik bedah canggih untuk memulihkan kontur wajah yang tampak muda dengan hasil alami dan tahan lama.</p>
                        <a href="facelift.php" class="service-link">
                            Learn more
                            <span class="service-link-arrow">→</span>
                        </a>
                    </div>
                </div>
        
                <!-- Botox & Fillers -->
                <div class="service-card">
                    <div class="service-img-wrap">
                        <img 
                            src="https://images.unsplash.com/photo-1512290923902-8a9f81dc236c?w=700&auto=format&fit=crop&q=80" 
                            alt="Botox & Fillers" 
                            class="service-img"
                        />
                        <div class="service-img-overlay"></div>
                    </div>
                    <div class="service-body">
                        <span class="service-tag">Injectable</span>
                        <h3 class="service-name">Botox & Fillers</h3>
                        <p class="service-desc">Perawatan suntik yang disetujui FDA untuk menghaluskan kerutan dan memulihkan volume wajah secara alami.</p>
                        <a href="botox.php" class="service-link">
                            Learn more
                            <span class="service-link-arrow">→</span>
                        </a>
                    </div>
                </div>
        
                <!-- Laser Treatments -->
                <div class="service-card">
                    <div class="service-img-wrap">
                        <img 
                            src="https://images.unsplash.com/photo-1515377905703-c4788e51af15?w=700&auto=format&fit=crop&q=80" 
                            alt="Laser Treatments" 
                            class="service-img"
                        />
                        <div class="service-img-overlay"></div>
                    </div>
                    <div class="service-body">
                        <span class="service-tag">Technology</span>
                        <h3 class="service-name">Laser Treatments</h3>
                        <p class="service-desc">Teknologi laser terkini untuk mengatasi pigmentasi, bekas jerawat, dan tanda penuaan secara efektif.</p>
                        <a href="laser.php" class="service-link">
                            Learn more
                            <span class="service-link-arrow">→</span>
                        </a>
                    </div>
                </div>
        
                <!-- Body Contouring -->
                <div class="service-card">
                    <div class="service-img-wrap">
                        <img 
                            src="https://images.unsplash.com/photo-1607619056574-7b8d3ee536b2?w=700&auto=format&fit=crop&q=80" 
                            alt="Body Contouring" 
                            class="service-img"
                        />
                        <div class="service-img-overlay"></div>
                    </div>
                    <div class="service-body">
                        <span class="service-tag">Contouring</span>
                        <h3 class="service-name">Body Contouring</h3>
                        <p class="service-desc">Perawatan khusus untuk membentuk dan merampingkan tubuh, menargetkan lemak membandel dengan presisi.</p>
                        <a href="contouring.php" class="service-link">
                            Learn more
                            <span class="service-link-arrow">→</span>
                        </a>
                    </div>
                </div>
        
            </div>
        
            <!-- CTA -->
            <div class="services-cta">
                <h3 class="services-cta-title">Siap untuk transformasi kecantikan Anda?</h3>
                <a href="#kontak" class="btn-primary">Book a Consultation Now</a>
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