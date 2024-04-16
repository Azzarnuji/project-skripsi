<!DOCTYPE html>
<html lang="id">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Berita / Artikel</title>
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
                                <li><a href="#">Telp. (021) 88971941</a></li>
                                <li><a href="#">Email: maannur1@gmail.com</a></li>
                                <li><a class="nobg" href="#">Jl.KH.Muchtar Thabrani No.51
                                        Kota bekasi</a></li>
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
                                <li><a href="#">Profil</a>
                                    <!-- Sub Menu level 1 -->
                                    <ul>
                                        <li><a href="<?php echo url('kata_sambutan'); ?>">Kata Sambutan</a></li>
                                        <li><a href="<?php echo url('visi_misi'); ?>">Visi Misi</a></li>

                                    </ul>
                                </li>
                                <li><a href="<?php echo url('guru'); ?>">Guru</a> </li>

                                <li><a class="selected" href="<?php echo url('berita'); ?>">Berita</a> </li>
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
                    <!-- News Updates -->

                    <div class="clear"></div>
                    <!-- Col1 -->
                    <div class="col1">
                        <!-- Banner -->
                        <div id="banner1">
                            <a href="#"><img src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/images/newsbanner11.gif'; ?>" alt="" /></a>
                            <div class="heading">
                                <h1>Berita / Artikel</h1>
                            </div>
                        </div>

                        <!-- Content Heading -->
                        <div id="content2">
                            <h2 class="pad8">Berita / Artikel</h2>
                            <!-- Blog Listing -->
                            <ul class="listing">
                                <?php
                                  $no=0;
                                  foreach ($data as $i) :
                                     $no++;
                                     $tulisan_id=$i->tulisan_id;
                                     $tulisan_judul=$i->tulisan_judul;
                                     $tulisan_isi=$i->tulisan_isi;
                                     $tulisan_tanggal=$i->tanggal;
                                     $tulisan_author=$i->tulisan_author;
                                     $tulisan_gambar=$i->tulisan_gambar;
                                     $tulisan_views=$i->tulisan_views;
                                     $kategori_id=$i->tulisan_kategori_id;
                                     $kategori_nama=$i->tulisan_kategori_nama;

                                  ?>
                                <li>
                                    <div class="thumb"><a href="<?php echo url('berita/berita_detail/' . $tulisan_id); ?>"><img width="126"
                                                height="106" src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'assets/images/' . $tulisan_gambar; ?>" alt="" /></a>
                                    </div>
                                    <div class="description">
                                        <h6><a href="<?php echo url('berita/berita_detail/' . $tulisan_id); ?>" class="colr"><?php echo $tulisan_judul; ?></a></h6>
                                        <?php echo \App\Helpers\Utils::limit_words($tulisan_isi, 30) . '...'; ?>
                                        <div class="clear"></div>
                                        <div class="info">
                                            <span class="postedby">Di Post Oleh:
                                                <?php echo $tulisan_author; ?></span>
                                            <span class="lastupdte">
                                                Tanggal:<i><?php echo $tulisan_tanggal; ?></i></span>
                                            <span class="comments">Dibaca:
                                                <strong><?php echo $tulisan_views; ?></strong> Kali</span>
                                            <a class="moreinfo" href="<?php echo url('berita/berita_detail/' . $tulisan_id); ?>">Baca
                                                Selengkapnya</a>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </li>
                                <?php endforeach;?>

                            </ul>
                            <div class="clear"></div>
                            <!-- pagination Listing -->
                            <div class="pginaiton pad9">
                                <ul>
                                    <li><?php echo $data->links(); ?></li>

                                </ul>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <!-- Col2 -->
                    <div class="col2">
                        <div class="ads22" style="width: auto; height: auto">
                            <li><iframe src="{{ env('APP_URL') }}/login" frameborder="0" height="600px"
                                    onload="checkIframe(this)"></iframe></li>
                        </div>
                        <span style="margin-right: 3px; margin-left: 3px; font-size:1rem;">
                            Lupa Password ? <a style="color: blue;" href="{{ url('forgot-password') }}"
                                class="">Klik
                                Disini</a>

                        </span>
                        <div style="margin-bottom: 20px">

                            <span style="margin-right: 3px; margin-left: 3px; font-size:1rem;">
                                Anda Siswa Lama ? <a style="color: blue;" href="{{ url('siswa/siswaLama') }}"
                                    class="">Daftar
                                    Disini</a>

                            </span>
                        </div>


                        <!-- Recent Blog Top Rating -->

                        <div class="course_right">
                            <div class="crheading">
                                <h5 style="margin-left: 20px;">Post Populer</h5>
                            </div>
                            <ul>
                                <?php
                                          foreach ((array)json_decode($tulisan_populer,true) as $n) :
                                          $berita_id=$n['tulisan_id'];
                                          $berita_judul=$n['tulisan_judul'];
                                          $berita_isi=$n['tulisan_isi'];
                                          $berita_tgl=$n['tanggal'];
                                          $berita_kategori=$n['tulisan_kategori_nama'];
                                          $berita_gambar=$n['tulisan_gambar'];
                                          $berita_author=$n['tulisan_author'];

                                        ?>
                                <li>
                                    <div class="thumb"><a href="<?php echo url('berita/berita_detail/' . $berita_id); ?>"><img width="32"
                                                height="32" src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'assets/images/' . $berita_gambar; ?>" alt="" /></a>
                                    </div>
                                    <div class="description">
                                        <h6 style="margin-left: 5px;"><a
                                                href="<?php echo url('berita/berita_detail/' . $berita_id); ?>"><?php echo $berita_judul; ?></a>
                                        </h6>
                                        <a class="gray1" href="#"
                                            style="margin-left: 5px;"><?php echo $berita_tgl; ?> </a>
                                    </div>
                                </li>
                                <?php endforeach;?>

                            </ul>
                        </div>
                        <!-- Post New  Blog  -->
                        <div class="course_right">
                            <div class="crheading">
                                <h5 style="margin-left: 20px;">Post Terbaru</h5>
                            </div>
                            <ul>
                                <?php
                                          foreach ((array)json_decode($tulisan,true) as $n) :
                                          $berita_id=$n['tulisan_id'];
                                          $berita_judul=$n['tulisan_judul'];
                                          $berita_isi=$n['tulisan_isi'];
                                          $berita_tgl=$n['tanggal'];
                                          $berita_kategori=$n['tulisan_kategori_nama'];
                                          $berita_gambar=$n['tulisan_gambar'];
                                          $berita_author=$n['tulisan_author'];

                                        ?>
                                <li>
                                    <div class="thumb"><a href="<?php echo url('berita/berita_detail/' . $berita_id); ?>"><img width="32"
                                                height="32" src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'assets/images/' . $berita_gambar; ?>" alt="" /></a>
                                    </div>
                                    <div class="description">
                                        <h6 style="margin-left: 5px;"><a
                                                href="<?php echo url('berita/berita_detail/' . $berita_id); ?>"><?php echo $berita_judul; ?></a>
                                        </h6>
                                        <a class="gray1" href="#"
                                            style="margin-left: 5px;"><?php echo $berita_tgl; ?> </a>
                                    </div>
                                </li>
                                <?php endforeach;?>

                            </ul>
                        </div>
                        <div class="clear"></div>
                        <!--col2 ends -->
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
