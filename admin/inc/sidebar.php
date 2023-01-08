<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse p-0">
    <div class="pt-3" style="height: inherit">
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link link-dark" href="<?= route('admin/') ?>">
                    <i class="bi bi-house pe-3"></i> Dashboard
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link link-dark dropdown-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#subject-dropdown" aria-expanded="false">
                    <i class="bi bi-book pe-3"></i> Subject
                </a>
                <div class="collapse" id="subject-dropdown">
                    <ul class="nav flex-column">
                        <li class="nav-item ms-2"><a href="<?= route('admin/subject.php') ?>" class="nav-link link-dark">Manage</a></li>
                        <li class="nav-item ms-2"><a href="<?= route('admin/subject-add.php') ?>" class="nav-link link-dark">Add new subject</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link link-dark dropdown-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#teacher-dropdown" aria-expanded="false">
                    <i class="bi bi-people pe-3"></i> Teacher
                </a>
                <div class="collapse" id="teacher-dropdown">
                    <ul class="nav flex-column">
                        <li class="nav-item ms-2"><a href="<?= route('admin/teacher.php') ?>" class="nav-link link-dark">Manage</a></li>
                        <li class="nav-item ms-2"><a href="<?= route('admin/teacher-add.php') ?>" class="nav-link link-dark">Add new teacher</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link link-dark dropdown-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#class-dropdown" aria-expanded="false">
                    <i class="bi bi-person-video3 pe-3"></i> Class
                </a>
                <div class="collapse" id="class-dropdown">
                    <ul class="nav flex-column">
                        <li class="nav-item ms-2"><a href="<?= route('admin/kelas.php') ?>" class="nav-link link-dark">Manage</a></li>
                        <li class="nav-item ms-2"><a href="<?= route('admin/kelas-add.php') ?>" class="nav-link link-dark">Add new class</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link link-dark dropdown-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#timetable-dropdown" aria-expanded="false">
                    <i class="bi bi-calendar pe-3"></i> Timetable
                </a>
                <div class="collapse" id="timetable-dropdown">
                    <ul class="nav flex-column">
                        <li class="nav-item ms-2"><a href="<?= route('admin/timetable.php') ?>" class="nav-link link-dark">Manage</a></li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</nav>
