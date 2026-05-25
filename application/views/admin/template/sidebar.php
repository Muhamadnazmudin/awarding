<ul
class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
id="accordionSidebar">

    <!-- BRAND -->

    <a
    class="sidebar-brand d-flex align-items-center justify-content-center"
    href="<?= site_url('admin/dashboard'); ?>">

        <div
        class="sidebar-brand-icon">

            <i
            class="fas fa-award">

            </i>

        </div>

        <div
        class="sidebar-brand-text mx-2">

            VOT GURU

        </div>

    </a>

    <hr
    class="sidebar-divider my-0">


    <!-- DASHBOARD -->

    <li class="nav-item <?= ($this->uri->segment(2) == 'dashboard') ? 'active' : ''; ?>">

        <a
        class="nav-link"
        href="<?= site_url('admin/dashboard'); ?>">

            <i
            class="fas fa-fw fa-home">

            </i>

            <span>
                Dashboard
            </span>

        </a>

    </li>


    <hr class="sidebar-divider">


    <!-- MASTER DATA -->

    <?php
    $master_active =
    in_array(
        $this->uri->segment(2),
        [
            'jurusan',
            'kelas',
            'mapel',
            'guru',
            'siswa',
            'tahun',
            'kriteria'
        ]
    );
    ?>

    <li class="nav-item <?= $master_active ? 'active' : ''; ?>">

        <a
        class="nav-link collapsed"
        href="#"
        data-toggle="collapse"
        data-target="#masterData"
        aria-expanded="<?= $master_active ? 'true' : 'false'; ?>">

            <i
            class="fas fa-database">

            </i>

            <span>
                Master Data
            </span>

        </a>

        <div
        id="masterData"
        class="collapse <?= $master_active ? 'show' : ''; ?>"
        data-parent="#accordionSidebar">

            <div
            class="bg-white py-2 collapse-inner rounded">

                <h6
                class="collapse-header">

                    Data Utama

                </h6>

                <a
                class="collapse-item <?= ($this->uri->segment(2) == 'jurusan') ? 'active' : ''; ?>"
                href="<?= site_url('admin/jurusan'); ?>">

                    Jurusan

                </a>

                <a
                class="collapse-item <?= ($this->uri->segment(2) == 'kelas') ? 'active' : ''; ?>"
                href="<?= site_url('admin/kelas'); ?>">

                    Kelas

                </a>

                <a
                class="collapse-item <?= ($this->uri->segment(2) == 'mapel') ? 'active' : ''; ?>"
                href="<?= site_url('admin/mapel'); ?>">

                    Mata Pelajaran

                </a>

                <a
                class="collapse-item <?= ($this->uri->segment(2) == 'guru') ? 'active' : ''; ?>"
                href="<?= site_url('admin/guru'); ?>">

                    Data Guru

                </a>

                <a
                class="collapse-item <?= ($this->uri->segment(2) == 'siswa') ? 'active' : ''; ?>"
                href="<?= site_url('admin/siswa'); ?>">

                    Data Siswa

                </a>

                <a
                class="collapse-item <?= ($this->uri->segment(2) == 'tahun') ? 'active' : ''; ?>"
                href="<?= site_url('admin/tahun'); ?>">

                    Tahun Pelajaran

                </a>

                <a
                class="collapse-item <?= ($this->uri->segment(2) == 'kriteria') ? 'active' : ''; ?>"
                href="<?= site_url('admin/kriteria'); ?>">

                    Kriteria Award

                </a>

            </div>

        </div>

    </li>


    <!-- VOTING -->

    <?php
    $voting_active =
    in_array(
        $this->uri->segment(2),
        [
            'pengaturan-voting',
            'monitoring-voting',
            'hasil-voting'
        ]
    );
    ?>

    <li class="nav-item <?= $voting_active ? 'active' : ''; ?>">

        <a
        class="nav-link collapsed"
        href="#"
        data-toggle="collapse"
        data-target="#votingMenu"
        aria-expanded="<?= $voting_active ? 'true' : 'false'; ?>">

            <i
            class="fas fa-vote-yea">

            </i>

            <span>
                Voting
            </span>

        </a>

        <div
        id="votingMenu"
        class="collapse <?= $voting_active ? 'show' : ''; ?>"
        data-parent="#accordionSidebar">

            <div
            class="bg-white py-2 collapse-inner rounded">

                <h6
                class="collapse-header">

                    Voting Guru

                </h6>

                <a
                class="collapse-item <?= ($this->uri->segment(2) == 'pengaturan-voting') ? 'active' : ''; ?>"
                href="<?= site_url('admin/pengaturan-voting'); ?>">

                    Pengaturan Voting

                </a>

                <a
                class="collapse-item <?= ($this->uri->segment(2) == 'monitoring-voting') ? 'active' : ''; ?>"
                href="<?= site_url('admin/monitoring-voting'); ?>">

                    Monitoring Voting

                </a>

                <a
                class="collapse-item <?= ($this->uri->segment(2) == 'hasil-voting') ? 'active' : ''; ?>"
                href="<?= site_url('admin/hasil-voting'); ?>">

                    Hasil Voting

                </a>

            </div>

        </div>

    </li>


    <!-- SYSTEM -->

    <?php
    $system_active =
    in_array(
        $this->uri->segment(2),
        [
            'user'
        ]
    );
    ?>

    <li class="nav-item <?= $system_active ? 'active' : ''; ?>">

        <a
        class="nav-link collapsed"
        href="#"
        data-toggle="collapse"
        data-target="#systemMenu"
        aria-expanded="<?= $system_active ? 'true' : 'false'; ?>">

            <i
            class="fas fa-cogs">

            </i>

            <span>
                System
            </span>

        </a>

        <div
        id="systemMenu"
        class="collapse <?= $system_active ? 'show' : ''; ?>"
        data-parent="#accordionSidebar">

            <div
            class="bg-white py-2 collapse-inner rounded">

                <h6
                class="collapse-header">

                    Management

                </h6>

                <a
                class="collapse-item <?= ($this->uri->segment(2) == 'user') ? 'active' : ''; ?>"
                href="<?= site_url('admin/user'); ?>">

                    Management User

                </a>

            </div>

        </div>

    </li>


    <hr
    class="sidebar-divider">


    <!-- LOGOUT -->

    <li class="nav-item">

        <a
        class="nav-link"
        href="<?= site_url('logout'); ?>"
        onclick="return confirm('Yakin logout?')">

            <i
            class="fas fa-sign-out-alt">

            </i>

            <span>
                Logout
            </span>

        </a>

    </li>

</ul>