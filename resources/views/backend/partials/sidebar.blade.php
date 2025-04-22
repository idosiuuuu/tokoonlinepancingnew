<aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('backend.beranda') }} " aria-expanded="false"><i
                                    class="mdi mdi-view-dashboard"></i><span class="hide-menu">Beranda</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('backend.user.index') }}" aria-expanded="false"><i
                                    class="mdi mdi-account"></i><span class="hide-menu">User</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('backend.customer.index') }}" aria-expanded="false"><i
                                    class="mdi mdi-account-outline"></i><span class="hide-menu">Customer</span></a>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                                href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-basket"></i><span
                                    class="hide-menu">Data Produk </span></a>
                            <ul aria-expanded="false" class="first-level collapse">
                                <li class="sidebar-item"><a href="{{ route('backend.kategori.index') }}"
                                        class="sidebar-link"><i class="mdi mdi-clipboard"></i><span
                                            class="hide-menu"> Kategori
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="{{ route('backend.produk.index') }}"
                                        class="sidebar-link"><i class="mdi mdi-cart"></i><span
                                            class="hide-menu"> Produk </span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                                href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span
                                    class="hide-menu">Laporan </span></a>
                            <ul aria-expanded="false" class="first-level collapse">
                                <li class="sidebar-item"><a href="{{ route('backend.laporan.formuser') }}"
                                        class="sidebar-link"><i class="mdi mdi-chevron-right"></i><span
                                            class="hide-menu"> User </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('backend.laporan.formproduk') }}"
                                        class="sidebar-link"><i class="mdi mdi-chevron-right"></i><span
                                            class="hide-menu"> Produk </span></a></li>
                            </ul>
                        </li>


                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>