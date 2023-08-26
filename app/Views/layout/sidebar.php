<div class="page-body-wrapper horizontal-menu">
    <!-- Page Sidebar Start-->
    <header class="main-nav">
        <div class="sidebar-user text-center"><img class="img-90 rounded-circle" src="<?= site_url('/assets/images/dashboard/1.png') ?>" alt="">
            <div class="badge-bottom"></div><a href="user-profile.html">
                <h6 class="mt-3 f-14 f-w-600"><?= $getusers->full_name ?></h6>
            </a>
            <p class="mb-0 font-roboto"></p>

        </div>
        <nav>
            <div class="main-navbar">
                <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                <div id="mainnav">
                    <ul class="nav-menu custom-scrollbar">
                        <li class="back-btn">
                            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                        </li>
                        <?php if ($getusers->role == 1) { ?>
                            <li class="dropdown"><a class="nav-link" href="/dashboard"><i data-feather="home"></i><span>Dashboard</span></a>
                                <!-- <ul class="nav-submenu menu-content">
                                <li><a href="index.html">Default</a></li>
                                <li><a href="dashboard-02.html">Ecommerce</a></li>
                            </ul> -->
                            </li>
                            <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="airplay"></i><span>Master Data</span></a>
                                <ul class="nav-submenu menu-content">
                                    <li><a href="<?= site_url('/master-coa') ?>">Chart Of Account</a></li>
                                    <li><a href="<?= site_url('master-kategori-pengeluaran') ?>">Kategori Pengeluaran</a></li>
                                    <li><a href="/user">User</a></li>
                                    <li><a href="<?= base_url('pengurus') ?>">Pengurus</a></li>
                                    <li><a href="<?= base_url('pengunduranDiri/viewAdmin') ?>">Pengunduran Diri</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="layout"></i><span>Transaksi</span></a>
                                <ul class="nav-submenu menu-content">
                                    <li><a href="<?= site_url('/transaksi-pengeluaran') ?>">Pengeluaran (Beban)</a></li>
                                    <li><a href="/simpanan/simpanan_pokok_view">Simpanan Pokok</a></li>
                                    <li><a href="/simpanan/simpanan_wajib_view">Simpanan Wajib</a></li>
                                    <li><a href="/simpanan/verifikasi_manasuka">Simpanan Manasuka</a></li>
                                    <li><a href="<?= base_url('pembiayaan') ?>">Pembiayaan</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="book"></i><span>Laporan</span></a>
                                <ul class="nav-submenu menu-content">
                                    <!-- <li><a href="/simpanan/simpanan_wajib">Simpanan Wajib</a></li> -->
                                    <li><a href="/laporan/simpanan_pokok">Simpanan Pokok</a></li>
                                    <li><a href="/laporan/simpanan_wajib">Simpanan Wajib</a></li>
                                    <li><a href="/laporan/simpanan_manasuka">Simpanan Manasuka</a></li>
                                    <li><a href="<?= base_url('laporan-pembiayaan') ?>">Laporan Pembiayaan</a></li>

                                    <li><a href="<?= site_url('laporan-jurnal-umum') ?>">Jurnal Umum</a></li>
                                    <li><a href="<?= site_url('laporan-buku-besar') ?>">Buku Besar</a></li>
                                    <li><a href="<?= site_url('laporan-laba-rugi') ?>">Laba Rugi</a></li>
                                    <li><a href="<?= site_url('laporan-arus-kas') ?>">Arus Kas</a></li>
                                    <li><a href="<?= site_url('laporan-neraca-saldo') ?>">Neraca Saldo</a></li>
                                    <li><a href="<?= site_url('sisa-hasil-usaha') ?>">Sisa Hasil Usaha</a></li>

                                </ul>
                            </li>
                        <?php } ?>
                        <?php if ($getusers->role == 2) { ?>
                            <li class="dropdown"><a class="nav-link" href="/dashboard"><i data-feather="home"></i><span>Dashboard</span></a>
                            <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="layout"></i><span>Keuangan</span></a>
                                <ul class="nav-submenu menu-content">
                                    <li><a href="/simpanan/simpanan_pokok">Simpanan Pokok</a></li>
                                    <li><a href="/simpanan/simpanan_wajib">Simpanan Wajib</a></li>
                                    <li><a href="/simpanan/simpanan_manasuka">Simpanan Manasuka</a></li>
                                    <li><a href="<?= base_url('pembiayaan/anggota') ?>">Pembiayaan</a></li>
                                    <li><a href="<?= base_url('pengunduranDiri/index') ?>">Pengunduran Diri</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        <!-- <?php if ($getusers->role == 1) { ?>
                            <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="layout"></i><span>Setting</span></a>
                                <ul class="nav-submenu menu-content">
                                    <li><a href="/setting/aplikasi">Aplikasi</a></li>

                                </ul>
                            </li>
                        <?php } ?> -->

                    </ul>
                </div>
                <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </div>
        </nav>
    </header>
    <!-- Page Sidebar Ends-->