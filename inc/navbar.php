<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a href="<?= route('') ?>" class="navbar-brand fw-bold"><?= $_ENV['APP_NAME'] ?></a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav">
                </div>
                <div class="navbar-nav">
                    <a href="<?= route('') ?>" class="nav-item nav-link">Home</a>
                    <a href="<?= route('about.php') ?>" class="nav-item nav-link">About Us</a>
                    <a href="<?= route('contact.php') ?>" class="nav-item nav-link">Contact Us</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Login</a>
                        <div class="dropdown-menu">
                            <a href="<?= route('lecturer/login.php') ?>" class="dropdown-item">Lecturer</a>
                            <a href="<?= route('student/login.php') ?>" class="dropdown-item">Student</a>
                        </div>
                    </div>
                    <a href="<?= route('admin/login.php') ?>" class="nav-item nav-link">Admin</a>
                </div>
            </div>
        </div>
    </nav>
</header>