<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Aesthetic Theme</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../asset/css/style.css"> 
</head>
<body>

    <header>
        <div class="logo">GlowCare Clinic</div>
        <nav>
            <a href="Signin.php">Login</a>
        </nav>
    </header>

    <section id="kontak">
        <div class="container">
            
            <div class="section-header">
                <h1 class="page-title">Mulai Perjalanan <em>Baru</em></h1>
                <p class="form-subtitle">Silahkan lengkapi data di bawah ini untuk mendaftar.</p>
            </div>

            <form class="kontak-form">
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-input" placeholder="Masukkan username Anda" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-input" placeholder="contoh@email.com" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-input" placeholder="Kata sandi minimal 8 karakter" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-input" placeholder="Ulangi kata sandi Anda" required>
                </div>

                <button type="submit" class="btn-primary">
                    Daftar Sekarang
                </button>
                
                <p class="form-subtitle" style="margin-top: 10px;">
                    Sudah punya akun? <a href="Signin.php">Masuk di sini</a>
                </p>
            </form>
        </div>
    </section>

    <footer>
        <p class="footer-copy">© 2026 GlowCare Clinic. All rights reserved.</p>
    </footer>

</body>
</html>