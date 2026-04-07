<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Sebagai member</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;1,400&family=DM+Sans:wght@300;400;500&display=swap">
    <link rel="stylesheet" href="asset/css/style.css">
</head>
<body>
    <section id = "SignIn">
        <h2 class = "section-header">Masuk <em>Member</em></h2>
            <form class="kontak-form" method="post" action="index.php">  
                <p class="form-subtitle">Masukkan email dan password untuk masuk ke akun kamu.</p>
                    
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-input" placeholder="Masukkan email" required>
                </div>

                <div class = "form-group">
                    <label class = "form-label">Password</label>
                    <input type = "password" class = "form-input" placeholder="Masukkan password" required>
                </div>
                <button type="submit" class="btn">Masuk</button>
            </form>
    </section>

    <a href="index.php" </a>
</body>
</html>