<!DOCTYPE html>
<html lang="id">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Kata Sambutan</title>
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
    </head>

    <body>
        <div id="bg">
            <!-- Wapper Sec -->
            <div id="wrapper_sec">
                <!-- masterhead -->
                <div id="masterhead">
                    <!-- Logo -->
                    <div class="logo"><a href="<?php echo url('/'); ?>"><span style="font-size: 2rem; color:blue;">SMA I
                                ANNUR</span></a></div>
                    <!-- masterhead Right Section -->
                    <div class="topright_sec">
                        <!-- top navigation -->
                        <div class="topnavigation">
                            <ul>
                                <li class="first">&nbsp;</li>
                                <li><a href="#">Telp. (021) 88971941 </a></li>
                                <li><a href="#">Email: maannur1@gmail.com</a></li>
                                <li><a class="nobg" href="#">Jl.KH. Muchtar Thabrani No.51
                                        kota bekasi</a></li>
                                <li class="last">&nbsp;</li>
                            </ul>
                        </div>
                        <div class="clear"></div>
                        <!-- top search -->
                        <div class="top_search">
                            <div class="advance_search"><a href="#"></a></div>
                            <form action="<?php echo url('berita/search'); ?>" method="post">
                                <ul>
                                    <li><input name="textcari" type="text" placeholder="Pencarian" /></li>
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
                                <li class="first"><a href="<?php echo url('/'); ?>">Home</a></li>
                                <li><a class="selected" href="#">Profil</a>
                                    <!-- Sub Menu level 1 -->
                                    <ul>
                                        <li><a href="<?php echo url('kata_sambutan'); ?>">Kata Sambutan</a></li>
                                        <li><a href="<?php echo url('visi_misi'); ?>">Visi Misi</a></li>

                                    </ul>
                                </li>
                                <li><a href="<?php echo url('guru'); ?>">Guru</a> </li>
                                <li><a href="<?php echo url('berita'); ?>">Berita</a> </li>
                                <li><a href="<?php echo url('agenda'); ?>">Agenda</a></li>
                                <li><a href="<?php echo url('galeri'); ?>">Gallery</a> </li>
                                <li><a href="<?php echo url('download'); ?>">Download</a> </li>

                                <li><a href="<?php echo url('kontak'); ?>" class="last">Hubungi Kami</a>
                                </li>

                            </ul>
                        </div>
                        <!-- navigation ends -->
                        <div class="clear"></div>
                    </div>
                </div>
                <!-- Content Seciton -->
                <div id="content_section">


                    <div class="static_content pad2">


                        <div class="staticblock2">
                            <a href="#"><img src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/images/staticimge2.gif'; ?>" alt="" /></a>
                            <h4>VISI</h4><br />
                            <p>Unggul dalam intelektual, berkarakter islami,berkopetensi dalam
                                persaingan global </p><br />
                            <h4>MISI</h4><br />
                            <p>1. Membentuk siswa yang cerdas dan berwawasan luas serta berakhlak
                                mulia</p>
                            <p>2. Meningkatkan kopetensi belajra siswa yang mampu bersaing di dunia
                                global</p>
                            <p>3. Meningkatkan budaya disiplin, bersih, dan tertib </p>

                        </div>
                    </div>


                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <!-- Footer Section -->
        @include('Home.Footer')
    </body>

</html>
