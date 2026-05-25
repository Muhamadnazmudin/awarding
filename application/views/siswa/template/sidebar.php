<ul
class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
id="accordionSidebar">

    <a
    class="sidebar-brand d-flex align-items-center justify-content-center"
    href="#">

        <div class="sidebar-brand-text">

            VOTING GURU

        </div>

    </a>

    <hr class="sidebar-divider">

    <li class="nav-item active">

        <a
        class="nav-link"
        href="<?= site_url('siswa/dashboard'); ?>">

            <i class="fas fa-home"></i>

            <span>
                Dashboard
            </span>

        </a>

    </li>

    <li class="nav-item">

    <a
    class="nav-link"
    href="<?= site_url('siswa/voting'); ?>">

        <i class="fas fa-vote-yea"></i>

        <span>
            Voting Guru
        </span>

    </a>

</li>

    <li class="nav-item">

        <a
        class="nav-link"
        href="<?= site_url('logout'); ?>">

            <i class="fas fa-sign-out-alt"></i>

            <span>
                Logout
            </span>

        </a>

    </li>

</ul>