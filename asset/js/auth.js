document.addEventListener('DOMContentLoaded', function () {
    // Tambah class enter saat halaman dimuat
    document.body.classList.add('page-enter');

    document.querySelectorAll('a[href="SignIn.php"], a[href="SignUp.php"]').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const target = this.href;

            document.body.classList.remove('page-enter');
            document.body.classList.add('page-exit');

            setTimeout(() => {
                window.location.href = target;
            }, 400);
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    document.body.classList.add('page-enter');

    const links = document.querySelectorAll('a[href="SignIn.php"], a[href="SignUp.php"], a.back-home');
    
    links.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const target = this.href;

            document.body.classList.remove('page-enter');
            document.body.classList.add('page-exit');

            setTimeout(() => {
                window.location.href = target;
            }, 400);
        });
    });
});