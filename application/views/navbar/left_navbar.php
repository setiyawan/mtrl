<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li> <a class="waves-effect waves-dark <?= $active_page == 'dashboard' ? ' active' : '' ?>" href="<?= base_url() ?>dashboard" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard</span></a>
                </li>
               <!--  <li> <a class="waves-effect waves-dark <?= $active_page == 'transaction' ? ' active' : '' ?>" href="<?= base_url() ?>transaksi" aria-expanded="false"><i class="mdi mdi-cart"></i><span class="hide-menu">Transaksi</span></a>
                </li> -->

                 <li class="sidebar-item <?= $active_page == 'transaction' ? ' active' : '' ?>"> <a class="sidebar-link has-arrow waves-effect waves-dark <?= $active_page == 'transaction' ? ' active' : '' ?>" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Transaksi</span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="<?= base_url() ?>transaksi" class="sidebar-link <?= $active_sub_page == 'daily_transaction' ? ' active' : '' ?>">
                                <!-- <i class="mdi mdi-account-box"></i>  -->
                                <span class="hide-menu"> Harian </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?= base_url() ?>transaksi/belumlunas" class="sidebar-link <?= $active_sub_page == 'unpaid_transaction' ? ' active' : '' ?>">
                                <!-- <i class="mdi mdi-account-box"></i>  -->
                                <span class="hide-menu"> Belum Lunas </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li> <a class="waves-effect waves-dark <?= $active_page == 'income' ? ' active' : '' ?>" href="<?= base_url() ?>pemasukan" aria-expanded="false"><i class="mdi mdi-square-inc-cash"></i><span class="hide-menu">Pemasukan</span></a>
                </li>
                <li> <a class="waves-effect waves-dark <?= $active_page == 'expense' ? ' active' : '' ?>" href="<?= base_url() ?>pengeluaran" aria-expanded="false"><i class="mdi mdi-cash-multiple"></i><span class="hide-menu">Pengeluaran</span></a>
                </li>
                <!-- <li> <a class="waves-effect waves-dark <?= $active_page == 'report' ? ' active' : '' ?>" href="<?= base_url() ?>laporan" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Laporan</span></a>
                </li> -->

                <li class="sidebar-item <?= $active_page == 'report' ? ' active' : '' ?>"> <a class="sidebar-link has-arrow waves-effect waves-dark <?= $active_page == 'report' ? ' active' : '' ?>" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Laporan</span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="<?= base_url() ?>laporan/harian" class="sidebar-link <?= $active_sub_page == 'daily_report' ? ' active' : '' ?>">
                                <!-- <i class="mdi mdi-account-box"></i>  -->
                                <span class="hide-menu"> Harian</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?= base_url() ?>laporan/bulanan" class="sidebar-link <?= $active_sub_page == 'monthly_report' ? ' active' : '' ?>">
                                <!-- <i class="mdi mdi-account-box"></i>  -->
                                <span class="hide-menu"> Bulanan</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li> <a class="waves-effect waves-dark <?= $active_page == 'material' ? ' active' : '' ?>" href="<?= base_url() ?>material" aria-expanded="false"><i class="mdi mdi-shovel"></i><span class="hide-menu">Material</span></a>
                </li>
                <li> <a class="waves-effect waves-dark <?= $active_page == 'vehicle' ? ' active' : '' ?>" href="<?= base_url() ?>kendaraan" aria-expanded="false"><i class="mdi mdi-truck"></i><span class="hide-menu">Kendaraan</span></a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    <!-- End Bottom points-->
</aside>