<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;1,400&family=DM+Sans:wght@300;400;500&display=swap">
        <link rel="stylesheet" href="asset/css/style.css">
</head>
<body>
     <section id = "SignUp">
        <h2 class="section-header">Daftar <em>Member</em></h2>
            <form class="kontak-form" method = "post" action = "Signin.php">
                <p class="form-subtitle">Isi form di bawah untuk menjadi member dan dapatkan penawaran eksklusif.</p>
                    
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-input" placeholder="Nama kamu" required>
                </div>

                <div class = "form-group">
                    <label class = "form-label">password</label>
                    <input type = "password" class = "form-input" placeholder="Masukkan password" required>

                <div class="form-group">
                    <label class="form-label">Telepon</label>
                    <input type="tel" class="form-input" placeholder="+62" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-input" placeholder="email@contoh.com" required>
                </div>

                <button type="submit" class="btn">Daftar</button>

                <p align="center" class="footer-copy">Sudah punya akun? <a href="Signin.php">Masuk di sini</a></p>
            </form>
    </section>
</body>
</html>