<!DOCTYPE html>
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

        <script type="text/javascript">
            function checkIframe(iframe) {
                var elem = document.activeElement;
                if ((elem && elem.tagName == 'IFRAME') && iframe.src == "http://localhost:8000/login") {
                    iframe.height = '1000px'
                    // iframe.src = "http://localhost:8000/registrasi"

                }
            }
        </script>
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
                                <li class="first"><a class="selected" href="<?php echo url('/'); ?>">Home</a></li>
                                <li><a href="#">Profil</a>
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
                    <!-- News Updates -->

                    <div class="clear"></div>
                    <!-- Col1 -->
                    <div class="col1">
                        <!-- Banner -->
                        <div id="banner">
                            <div id="slider2">
                                <?php
                                      foreach ((array) json_decode($brt, true) as $br) {
                                        $berita_id=$br['tulisan_id'];
                                        $berita_judul=$br['tulisan_judul'];
                                        $berita_isi=$br['tulisan_isi'];
                                        $berita_kategori=$br['tulisan_kategori_nama'];
                                        $berita_gambar=$br['tulisan_gambar'];
                                        $berita_author=$br['tulisan_author'];

                                  ?>
                                <div class="contentdiv">
                                    <a href="#"><img src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'assets/images/' . $berita_gambar; ?>" alt="" /></a>
                                    <div class="banner_des">
                                        <h4><?php echo $berita_judul; ?> </h4>
                                        <?php echo \App\Helpers\Utils::limit_words($berita_isi, 15) . '...'; ?>
                                    </div>
                                </div>
                                <?php } ?>


                            </div>
                            <div id="paginate-slider2" class="pagination">
                            </div>
                            <script type="text/javascript" src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/js/slider.js'; ?>"></script>

                        </div>

                        <!-- Content Heading -->
                        <div class="content_heading">
                            <div class="heading">
                                <h2>Selamat datang di WEBSITE SMA I ANNUR </h2>
                            </div>

                        </div>
                        <p class="text">
                            Website MA ANNUR adalah website yang dibangun untuk sekolah MA ANNUR dan
                            sederajat untuk menunjang transparasi informasi dan promosi sekolah.
                        <p>Kami Menyambut baik terbitnya Website MA-ANNUR yang baru , dengan harapan
                            dipublikasinya website ini sekolah berharap : Peningkatan layanan
                            pendidikan kepada siswa, orangtua, dan masyarakat pada umumnya semakin
                            meningkat. Sebaliknya orangtua dapat mengakses informasi tentang
                            kegiatan akademik dan non akademik putra - puterinya di sekolah ini.
                            Dengan fasilitas ini Siswa dapat mengakses berbagai informasi
                            pembelajaran dan informasi akademik.</p>
                        </p>
                        <div class="clear"></div>
                        <!-- Content Block -->
                        <div class="contentblock">
                            <!-- Tabs -->
                            <div class="tabwrapper">
                                <div class="tabs_links">
                                    <ul>
                                        <li><a href="#tab1">Berita</a></li>
                                        <li><a href="#tab3">Agenda</a></li>

                                    </ul>
                                </div>
                                <div class="tab_content" id="tab1" style="display:none">
                                    <ul>

                                        <?php
                                                      foreach ((array)json_decode($berita,true) as $n) {
                                                        $berita_id=$n['tulisan_id'];
                                                        $berita_judul=$n['tulisan_judul'];
                                                        $berita_isi=$n['tulisan_isi'];
                                                        $berita_tgl=$n['tanggal'];
                                                        $berita_kategori=$n['tulisan_kategori_nama'];
                                                        $berita_gambar=$n['tulisan_gambar'];
                                                        $berita_author=$n['tulisan_author'];

                                                  ?>
                                        <li>
                                            <div class="thumb">
                                                <a href="<?php echo url('berita/berita_detail/' . $berita_id); ?>"><img width="53" height="53"
                                                        src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'assets/images/' . $berita_gambar; ?>" alt=" " /></a>
                                            </div>
                                            <div class="descripton">
                                                <h6><a href="<?php echo url('berita/berita_detail/' . $berita_id); ?>"><?php echo $berita_judul; ?></a>
                                                </h6>
                                                <em>(Tanggal <?php echo $berita_tgl; ?> | by
                                                    <?php echo $berita_author; ?>)</em>
                                                <?php echo \App\Helpers\Utils::limit_words($berita_isi, 12) . '...'; ?>

                                            </div>
                                        </li>
                                        <?php } ?>

                                    </ul>
                                    <div class="clear"></div>
                                </div>

                                <div class="tab_content" id="tab3" style="display:none">
                                    <ul>
                                        <?php
                                                      $no=0;
                                                      foreach ((array)json_decode($agenda,true) as $g) :
                                                         $no++;
                                                         $agenda_id=$g['agenda_id'];
                                                         $agenda_nama=$g['agenda_nama'];
                                                         $agenda_deskripsi=$g['agenda_deskripsi'];
                                                         $agenda_mulai=$g['agenda_mulai'];
                                                         $agenda_selesai=$g['agenda_selesai'];
                                                         $agenda_tempat=$g['agenda_tempat'];
                                                         $agenda_waktu=$g['agenda_waktu'];
                                                         $agenda_keterangan=$g['agenda_keterangan'];
                                                         $agenda_author=$g['agenda_author'];
                                                         $tanggal=$g['tanggal'];

                                                    ?>
                                        <li>
                                            <div class="thumb">
                                                <a href="<?php echo url('agenda'); ?>"><img width="60" height="60"
                                                        src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/images/agenda.png'; ?>" alt=" " /></a>
                                            </div>
                                            <div class="descripton">
                                                <h6><a href="<?php echo url('agenda'); ?>"><?php echo $agenda_nama; ?></a>
                                                </h6>
                                                <em>(Posted on <?php echo $tanggal; ?>)</em>
                                                <p><?php echo \App\Helpers\Utils::limit_words($agenda_deskripsi, 10) . '...'; ?></p>

                                            </div>
                                        </li>
                                        <?php endforeach;?>
                                        <li>

                                    </ul>
                                    <div class="clear"></div>
                                </div>



                            </div>
                            <!-- Search Course -->

                            <div class="search_course">
                                <h4>Download</h4>
                                Silahkan download file terbaru berikut:
                                <div class="box">
                                    <div class="apply_now">
                                        <a class="aply_now" href="#">Download</a>

                                    </div>
                                    <!-- Degree Type -->
                                    <div class="degree_type"><br />
                                        <ul>
                                            <?php
                                                    $no=0;
                                                    foreach ((array)json_decode($download,true) as $d) :
                                                            $no++;
                                                            $id=$d['file_id'];
                                                            $judul=$d['file_judul'];
                                                            $deskripsi=$d['file_deskripsi'];
                                                            $oleh=$d['file_oleh'];
                                                            $tanggal=$d['tanggal'];
                                                            $download=$d['file_download'];
                                                            $file=$d['file_data'];
                                                  ?>

                                            <li> <span><a href="<?php echo url('/download-file/' . $id); ?>"><?php echo $judul; ?></a></span>
                                                <a class="btn right" href="<?php echo url('/download-file/' . $id); ?>">Download</a>
                                            </li>
                                            <?php endforeach;?>


                                        </ul>
                                    </div>

                                    <div class="clear"></div>

                                    <!-- apply now -->
                                    <div class="apply_now">
                                        <a class="aply_now" href="#"></a>
                                        <a class="find_out_how" href="<?php echo url('download'); ?>">Lihat
                                            Semua</a>
                                    </div>
                                </div>

                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                        <!-- col1 ends -->
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
                        <!-- Our College Gallery -->
                        <div class="college_gallery">
                            <div
                                style="background-color:#fffdd9;height:35px;font-size:16px;border-bottom:1px solid #ccc;">
                                <h4 style="padding-top:5px;padding-left:9px;">Gallery Photo</h4>
                            </div>
                            <ul>
                                <?php
                                              foreach ((array)json_decode($galeri,true) as $g) {
                                                   $galeri_id=$g['galeri_id'];
                                                   $galeri_judul=$g['galeri_judul'];
                                                   $galeri_tanggal=$g['tanggal'];
                                                   $galeri_author=$g['galeri_author'];
                                                   $galeri_gambar=$g['galeri_gambar'];
                                                   $galeri_album_id=$g['galeri_album_id'];
                                                   $galeri_album_nama=$g['album_nama'];

                                          ?>
                                <li>
                                    <div class="thumb"><a href="<?php echo url('galeri'); ?>"><img width="40"
                                                height="40" src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'assets/images/' . $galeri_gambar; ?>" alt="" /></a>
                                    </div>
                                    <div class="description">
                                        <h6><a href="<?php echo url('galeri'); ?>"><?php echo $galeri_judul; ?></a>
                                        </h6>
                                        <a class="gray" href="#"><em><?php echo 'Tanggal ' . $galeri_tanggal; ?></em></a>
                                    </div>
                                </li>
                                <?php } ?>

                            </ul>
                        </div>
                        <div class="clear"></div>
                        <!--col2 ends -->
                    </div>
                    <div class="clear"></div>
                    <!-- Slder -->
                    <div class="image_scroll">
                        <a class="leftarrow" href="#"><img src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/images/left_arrow.gif'; ?>" alt="" /></a>
                        <div class="slider1">
                            <ul>
                                <li><a href=""><img src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/images/slider01.png'; ?>" alt="" /></a></li>
                                <li><a href=""><img src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/images/slider02.png'; ?>" alt="" /></a></li>
                                <li><a <li><a href="http://ardmaannur.ddns.net/portal/login/ma"><img
                                                src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/images/slider033.png'; ?>" alt="" /></a>
                                </li>
                                <li><a href=""><img src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/images/slider03.png'; ?>" alt="" /></a></li>
                                <li><a href=""><img src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/images/slider04.png'; ?>" alt="" /></a></li>
                                <li><a href=""><img src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/images/slider05.png'; ?>" alt="" /></a></li>
                            </ul>
                        </div>
                        <a class="rightarrow" href="#"><img src="<?php echo \App\Helpers\Utils::base_url_web_sekolah() . 'template/images/right_arrow.gif'; ?>" alt="" /></a>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>

        @include('Home.Footer')
    </body>

</html>
