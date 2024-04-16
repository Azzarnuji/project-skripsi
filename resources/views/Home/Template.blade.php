<html lang="id">
    {{-- @dd(\App\Helpers\Utils::base_url_web_sekolah()) --}}

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Home</title>
        <!-- Stylesheet -->
        <link rel="shorcut icon" type="text/css" href="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'assets/images/favicon.png'; ?>">
        <link href="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/css/style.css'; ?>" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/css/ddsmoothmenu.css'; ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/css/jquery.fancybox-1.3.4.css'; ?>" media="screen" />
        <!-- Javascript -->
        <script src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/js/jquery.min.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/js/ddsmoothmenu.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/js/contentslider.js'; ?>" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/js/jcarousellite_1.0.1.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/js/jquery.easing.1.1.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/js/cufon-yui.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/js/DIN_500.font.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/js/menu.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/js/tabs.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/js/jquery.mousewheel-3.0.4.pack.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/js/jquery.fancybox-1.3.4.pack.js'; ?>"></script>
        @yield('contentJS')
    </head>

    <body>
        <div id="bg">
            <!-- Wapper Sec -->
            <div id="wrapper_sec">
                <!-- masterhead -->
                <div id="masterhead">
                    <!-- Logo -->
                    <div class="logo"><a href="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . ''; ?>"><span
                                style="font-size: 2rem; color:blue;">SMA I ANNUR</span></a></div>
                    <!-- masterhead Right Section -->
                    <div class="topright_sec">
                        <!-- top navigation -->
                        <div class="topnavigation">
                            <ul>
                                <li class="first">&nbsp;</li>
                                <li><a href="#">Telp. (021)12345678 </a></li>
                                <li><a href="#">Email: email@maannurkotabekasi.ponpes.id</a>
                                </li>
                                <li><a class="nobg" href="#">Jl.KH.Muchtar Thabrani
                                        no.51</a></li>
                                <li class="last">&nbsp;</li>
                            </ul>
                        </div>
                        <div class="clear"></div>
                        <!-- top search -->
                        <div class="top_search">
                            <div class="advance_search"><a href="#"></a></div>
                            <form action="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'berita/search'; ?>" method="post">
                                <ul>
                                    <li><input name="textcari" type="text"
                                            placeholder="Pencarian" /></li>
                                    <li><button class="search" type="submit">Search</button></li>
                                </ul>
                            </form>

                        </div>
                        <div class="clear"> </div>
                    </div>
                    <div class="clear"></div>
                    <!-- Navigation -->
                    <div class="navigation">
                        <div id="smoothmenu1" class="ddsmoothmenu">
                            <ul>
                                <li class="first"><a
                                        class="{{ $active == 'home' ? 'selected' : '' }}"
                                        href="<?php echo url('/'); ?>">Home</a></li>
                                <li><a href="#"
                                        class="{{ $active == 'profil' ? 'selected' : '' }}">Profil</a>
                                    <!-- Sub Menu level 1 -->
                                    <ul>
                                        <li><a href="<?php echo url('kata_sambutan'); ?>">Kata Sambutan</a></li>
                                        <li><a href="<?php echo url('visi_misi'); ?>">Visi Misi</a></li>

                                    </ul>
                                </li>
                                <li><a href="<?php echo url('guru'); ?>"
                                        class="{{ $active == 'guru' ? 'selected' : '' }}">Guru</a>
                                </li>
                                <li><a href="#"
                                        class="{{ $active == 'siswa' ? 'selected' : '' }}">Kesiswaan</a>
                                    <ul>
                                        <li><a href="<?php echo url('siswa'); ?>">Data Siswa</a></li>
                                        <li><a href="<?php echo url('prestasi_siswa'); ?>">Prestasi Siswa</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?php echo url('berita'); ?>"
                                        class="{{ $active == 'berita' ? 'selected' : '' }}">Berita</a>
                                </li>
                                <li><a href="<?php echo url('pengumuman'); ?>"
                                        class="{{ $active == 'pengumuman' ? 'selected' : '' }}">Pengumuman</a>
                                </li>
                                <li><a href="<?php echo url('agenda'); ?>"
                                        class="{{ $active == 'agenda' ? 'selected' : '' }}">Agenda</a>
                                </li>
                                <li><a href="<?php echo url('galeri'); ?>"
                                        class="{{ $active == 'galeri' ? 'selected' : '' }}">Gallery</a>
                                </li>
                                <li><a href="<?php echo url('download'); ?>"
                                        class="{{ $active == 'download' ? 'selected' : '' }}">Download</a>
                                </li>
                                s
                                <li><a href="<?php echo url('kontak'); ?>"
                                        class="last {{ $active == 'kontak' ? 'selected' : '' }}">Hubungi
                                        Kami</a>
                                </li>

                            </ul>
                        </div>
                        <!-- navigation ends -->
                        <div class="clear"></div>
                    </div>
                </div>
                @yield('content')
                <div class="clear"></div>
                <!-- Footer Section -->
                <div id="bottom_seciton">
                    <div id="footer">
                        <!--Find your way -->
                        <div class="find_your_way">
                            <h5>Menu</h5>
                            <ul>
                                <li><a href="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . ''; ?>">Home</a></li>
                                <li><a href="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'kata_sambutan'; ?>">Kata Sambutan</a></li>
                                <li><a href="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'visi_misi'; ?>">Visi Misi</a></li>
                                <li><a href="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'guru'; ?>">Guru</a></li>
                                <li><a href="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'siswa'; ?>">Siswa</a></li>
                            </ul>
                        </div>
                        <!-- Help and Support -->
                        <div class="help_support">
                            <h5>Bantuan &amp;Support</h5>
                            <ul>
                                <li><a href="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'pengumuman'; ?>">Pengumuman</a></li>
                                <li><a href="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'agenda'; ?>">Agenda Kegiatan</a></li>
                                <li><a href="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'galeri'; ?>">Gallery Photo</a></li>
                                <li><a href="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'download'; ?>">Download</a></li>
                                <li><a href="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'kontak'; ?>">Hubungi Kami</a></li>
                            </ul>
                        </div>
                        <!-- Quick Links -->
                        <div class="quick_links">
                            <h5>Jalur Pintas</h5>
                            <ul>
                                <li><a href="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . ''; ?>">Home</a></li>
                                <li><a href="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'berita'; ?>">Berita/Artikel</a></li>
                                <li><a href="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'download'; ?>">Download</a></li>
                                <li><a href="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'kontak'; ?>">Kontak</a></li>
                            </ul>
                        </div>
                        <!-- Addmission -->
                        <div class="Addmissoin">
                            <h5>Akademik</h5>
                            <ul>
                                <li><a href="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'kata_sambutan'; ?>">Kata Sambutan</a></li>
                                <li><a href="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'visi_misi'; ?>">Visi Misi</a></li>
                                <li><a href="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'guru'; ?>">Data Guru</a></li>
                                <li><a href="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'siswa'; ?>">Data Siswa</a></li>
                                <li><a href="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'agenda'; ?>">Agenda Kegiatan</a></li>
                            </ul>
                        </div>
                        <!-- Contact Us -->
                        <div class="contact_us">
                            <h5>Hubungi Kami</h5>
                            <ul>
                                <li class="telephone_no">021) 88971941</li>
                                <li class="mailing_address">
                                    Jl. KH.Muchtar Thabrani no.51 kota bekasi
                                </li>
                                <li class="email_address"><a href="#">maannur1@gmail.com</<
                                            /a>
                                </li>
                            </ul>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <!-- Bototm seciton -->
                <div id="bottom_Section">
                    <!-- page bottm -->
                    <div id="pagebottom">
                        <!-- copyright -->
                        <div class="copyright">&copy; 2020 <a
                                href="http://maannurkotabekasi.ponpes.id/">MADRASAH
                                ALIYAH ANNUR</a> All Rights Reserved</div>
                        <a href="#" class="top">Top</a>
                        <!-- Social Networks -->
                        <div class="socail_networks">
                            <ul>
                                <li class="servcies">Ikuti kami di</li>
                                <li><a href="https://www.facebook.com/madrasahaliyah.annur.54"><img
                                            src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/images/facebook_icon.gif'; ?>" alt="" /> </a></li>
                                <li><a href="https://www.instagram.com/mau_annur/"><img
                                            src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/images/instagram_1.gif'; ?>" alt="" /> </a></li>
                                <li><a
                                        href="https://www.youtube.com/channel/UC583XisxI0vKFGMr66jRWGA"><img
                                            src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/images/youtube.gif'; ?>" alt="" /> </a></li>
                            </ul>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>
