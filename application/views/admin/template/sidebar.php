<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
id="accordionSidebar">

<a class="sidebar-brand d-flex align-items-center justify-content-center"
href="<?= site_url('admin/dashboard'); ?>">

<div class="sidebar-brand-icon rotate-n-15">
<i class="fas fa-award"></i>
</div>

<div class="sidebar-brand-text mx-3">
VOT GURU
</div>

</a>

<hr class="sidebar-divider">

<li class="nav-item active">

<a class="nav-link"
href="<?= site_url('admin/dashboard'); ?>">

<i class="fas fa-fw fa-tachometer-alt"></i>
<span>Dashboard</span>

</a>

</li>

<hr class="sidebar-divider">

<div class="sidebar-heading">
Master Data
</div>

<li class="nav-item">
    <a class="nav-link"
    href="<?= site_url('admin/jurusan'); ?>">

        <i class="fas fa-school"></i>
        <span>Jurusan</span>

    </a>
</li>

<li class="nav-item <?= ($this->uri->segment(2) == 'kelas') ? 'active' : ''; ?>">

    <a class="nav-link"
    href="<?= site_url('admin/kelas'); ?>">

        <i class="fas fa-door-open"></i>
        <span>Kelas</span>

    </a>

</li>

<li class="nav-item <?= ($this->uri->segment(2) == 'mapel') ? 'active' : ''; ?>">

    <a class="nav-link"
    href="<?= site_url('admin/mapel'); ?>">

        <i class="fas fa-book"></i>
        <span>Mata Pelajaran</span>

    </a>

</li>

<li class="nav-item <?= ($this->uri->segment(2) == 'guru') ? 'active' : ''; ?>">

    <a class="nav-link"
    href="<?= site_url('admin/guru'); ?>">

        <i class="fas fa-chalkboard-teacher"></i>
        <span>Guru</span>

    </a>

</li>

<li class="nav-item <?= ($this->uri->segment(2) == 'siswa') ? 'active' : ''; ?>">

    <a class="nav-link"
    href="<?= site_url('admin/siswa'); ?>">

        <i class="fas fa-user-graduate"></i>
        <span>Siswa</span>

    </a>

</li>

<li class="nav-item">
<a class="nav-link"
href="#">
<i class="fas fa-calendar"></i>
<span>Tahun Pelajaran</span>
</a>
</li>

<li class="nav-item <?= ($this->uri->segment(2) == 'kriteria') ? 'active' : ''; ?>">

    <a class="nav-link"
    href="<?= site_url('admin/kriteria'); ?>">

        <i class="fas fa-award"></i>

        <span>
            Kriteria Penghargaan
        </span>

    </a>

</li>

<hr class="sidebar-divider">

<div class="sidebar-heading">
Voting
</div>

<li class="nav-item <?= ($this->uri->segment(2) == 'pengaturan-voting') ? 'active' : ''; ?>">

    <a class="nav-link"
    href="<?= site_url('admin/pengaturan-voting'); ?>">

        <i class="fas fa-vote-yea"></i>

        <span>
            Pengaturan Voting
        </span>

    </a>

</li>
<li class="nav-item">
    <a class="nav-link"
    href="<?= site_url('admin/monitoring-voting'); ?>">
        <i class="fas fa-users"></i>
        <span>Monitoring Voting</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link"
    href="<?= site_url('admin/hasil-voting'); ?>">
        <i class="fas fa-chart-bar"></i>
        <span>Hasil Voting</span>
    </a>
</li>

<hr class="sidebar-divider">

<li class="nav-item">

<a class="nav-link"
href="<?= site_url('logout'); ?>">

<i class="fas fa-sign-out-alt"></i>
<span>Logout</span>

</a>

</li>

</ul>