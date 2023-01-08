<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse p-0">
    <div class="pt-3" style="height: inherit">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link link-dark" href="<?= route('teacher/index.php') ?>">
                    <i class="bi bi-house pe-3"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-dark" href="<?= route('teacher/query.php') ?>">
                    <i class="bi bi-archive pe-3"></i> Queries
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link link-dark" href="<?= route('teacher/profile.php') ?>">
                    <i class="bi bi-person pe-3"></i> Profile
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link link-dark" href="<?= route('teacher/change-password.php') ?>">
                    <i class="bi bi-gear pe-3"></i> Change Password
                </a>
            </li>
        </ul>
    </div>
</nav>
