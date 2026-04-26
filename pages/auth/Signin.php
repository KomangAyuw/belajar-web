<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - GlowCare Clinic</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;1,400&family=DM+Sans:wght@300;400;500&display=swap">
    <link rel="stylesheet" href="../../asset/css/style.css">
</head>
<body>
    <header>
        <div class="logo">GlowCare Clinic</div>
        <nav>
            <a href="SignUp.php">Sign Up</a>
            <a href="../../index.php">Home</a>
        </nav>
    </header>

    <main>
       <main>
        <section id="kontak">
            <div class="container">
                <div class="section-header">
                    <h1 class="page-title">Selamat Datang Kembali di <em>GlowCare Clinic</em></h1>
                    <p class="form-subtitle">Masukkan akun untuk login</p>
                </div>

                <form class="kontak-form" action="../../index.php" method="GET">
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-input" placeholder="contoh@email.com" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-input" placeholder="Masukkan kata sandi Anda" required>
                    </div>

                    <button type="submit" class="btn-primary" ">
                        Sign In
                    </button>

                    <p class="form-subtitle" style="margin-top: 20px; text-align: center;">
                        Belum punya akun? <a href="SignUp.php">Daftar di sini</a>
                    </p>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <p class="footer-copy">© 2026 GlowCare Clinic. All rights reserved.</p>
    </footer>
</body>
</html>