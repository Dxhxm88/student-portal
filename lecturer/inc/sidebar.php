<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <a href="<?= route('lecturer/') ?>" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5 d-none d-sm-inline"><?= $_ENV['APP_NAME'] ?></span>
        </a>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li class="nav-item">
                <a href="<?= route('lecturer/') ?>" class="nav-link text-white align-middle px-0">
                    <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#result" data-bs-toggle="collapse" class="nav-link text-white px-0 align-middle">
                    <span class="ms-1 d-none d-sm-inline dropdown-toggle">Result</span>
                </a>
                <ul class="collapse nav flex-column ms-1" id="result">
                    <li class="w-100">
                        <a href="<?= route('lecturer/result.php') ?>" class="ms-2 nav-link text-white px-0">Manage Result</a>
                    </li>
                </ul>
            </li>
        </ul>
        <hr>
        <div class="dropdown pb-4">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="d-none d-sm-inline mx-1"><?= $_SESSION['name'] ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item" href="<?= route('lecturer/profile.php') ?>">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?= route('lecturer/index.php?logout=1') ?>">Sign out</a></li>
            </ul>
        </div>
    </div>
</div>