<!DOCTYPE html>
<html lang="id">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Guru</title>
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
                                <li><a href="#">Email: maanur1@gmail.com</a></li>
                                <li><a class="nobg" href="#">jl.KH.Muchtar Thabrani
                                        No.51</a></li>
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
                                <li class="first"><a href="<?php echo url(''); ?>">Home</a></li>
                                <li><a href="#">Profil</a>
                                    <!-- Sub Menu level 1 -->
                                    <ul>
                                        <li><a href="<?php echo url('kata_sambutan'); ?>">Kata Sambutan</a></li>
                                        <li><a href="<?php echo url('visi_misi'); ?>">Visi Misi</a></li>

                                    </ul>
                                </li>
                                <li><a class="selected" href="<?php echo url('guru'); ?>">Guru</a> </li>

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

                    <div class="clear"></div>
                    <!-- Col1 -->
                    <div class="col1">
                        <!-- Banner -->
                        <div id="banner1">
                            <a href="#"><img src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/images/newsbanner2.gif'; ?>" alt="" /></a>
                            <div class="heading">
                                <h1>GURU MA ANNUR KOTA BEKASI</h1>
                            </div>
                        </div>

                        <!-- Content Heading -->
                        <div id="content2">
                            <h2 class="pad8">Data Guru</h2>
                            <!-- Blog Listing -->
                            <ul class="listing">
                                <?php
                                  $no=0;
                                  foreach ((array)json_decode($data_guru,true) as $i) :
                                     $no++;
                                     $nama = $i['nama_guru'];
                                     $email = $i['email'];
                                     $kelas = $i['mengajar_kelas'];

                                  ?>
                                <li>
                                    <div class="thumb">
                                        <?php if(empty($photo)):?>
                                        <img width="100" height="100" src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'assets/images/user_blank.png'; ?>" alt="" />
                                        <?php else:?>
                                        <img width="100" height="100" src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'assets/images/' . $photo; ?>" alt="" />
                                        <?php endif;?>
                                    </div>
                                    <div class="description">
                                        <table style="font-size:12px;">
                                            <tr>
                                                <td>Nama Guru</td>
                                                <td>:</td>
                                                <td><?php echo $nama; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Email Guru</td>
                                                <td>:</td>
                                                <td><?php echo $email; ?></td>
                                            </tr>

                                            <tr>
                                                <td>Mengajar Dikelas</td>
                                                <td>:</td>
                                                <td class="text-uppercase"><?php echo \App\Helpers\Utils::arrayToString(json_decode($kelas)); ?></td>
                                            </tr>
                                        </table>
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
                        <!-- Blog guru dan Siswa Baru -->
                        <div class="rtab">
                            <div class="tab_navigation">
                                <ul>
                                    <li class="active"><a href="#rtab1">Siswa Baru</a></li>
                                    <li><a href="#rtab2">Guru Baru</a> </li>
                                </ul>
                            </div>
                            <div class="rtab_content" id="rtab1" style="display:none;">
                                <ul>
                                    <?php
                                            foreach ((array)json_decode($data_siswa,true) as $i) :
                                                $siswa_nis=$i['siswa_nis'];
                                                $siswa_nama=$i['siswa_nama'];
                                                $siswa_photo=$i['siswa_photo'];
                                          ?>
                                    <li>
                                        <?php if(empty($siswa_photo)):?>
                                        <div class="thumb"><a href="#"><img width="40" height="40"
                                                    src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'assets/images/user_blank.png'; ?>" alt="" /></a></div>
                                        <?php else:?>
                                        <div class="thumb"><a href="#"><img width="40" height="40"
                                                    src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'assets/images/' . $siswa_photo; ?>" alt="" /></a></div>
                                        <?php endif;?>
                                        <div class="description">
                                            <h6><a href="#"><?php echo $siswa_nama; ?></a></h6>
                                            <p><a href="#" class="gray"><?php echo $siswa_nis; ?></a></p>
                                        </div>
                                    </li>
                                    <?php endforeach;?>

                                </ul>
                                <div class="clear"></div>
                            </div>

                            <div class="rtab_content" id="rtab2" style="display:none;">
                                <ul>
                                    <?php
                                            foreach ((array)json_decode($data_guru,true) as $i) :
                                                $nama = $i['nama_guru'];
                                                $email = $i['email'];
                                                $kelas = $i['mengajar_kelas'];
                                          ?>
                                    <li>
                                        <?php if(empty($siswa_photo)):?>
                                        <div class="thumb"><a href="#"><img width="40" height="40"
                                                    src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'assets/images/user_blank.png'; ?>" alt="" /></a></div>
                                        <?php else:?>
                                        <div class="thumb"><a href="#"><img width="40" height="40"
                                                    src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'assets/images/' . $photo; ?>" alt="" /></a></div>
                                        <?php endif;?>
                                        <div class="description">
                                            <h6><a href="#"><?php echo $nama; ?></a></h6>
                                            <p><a href="#" class="gray"><?php echo $email; ?></a></p>
                                        </div>
                                    </li>
                                    <?php endforeach;?>

                                </ul>
                                <div class="clear"></div>
                            </div>

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
                                    <div class="thumb"><a href="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'berita/berita_detail/' . $berita_id; ?>"><img width="32"
                                                height="32" src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'assets/images/' . $berita_gambar; ?>" alt="" /></a>
                                    </div>
                                    <div class="description">
                                        <h6 style="margin-left: 5px;"><a
                                                href="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'berita/berita_detail/' . $berita_id; ?>"><?php echo $berita_judul; ?></a>
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
