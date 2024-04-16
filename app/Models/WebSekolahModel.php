<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WebSekolahModel extends Model
{
    use HasFactory;
    protected $connection = 'web-sekolah';
    public static function get_all_galeri(){
        return DB::connection('web-sekolah')->table('tbl_galeri')
            ->select('tbl_galeri.*', DB::raw("DATE_FORMAT(galeri_tanggal, '%d/%m/%Y') AS tanggal"), 'album_nama')
            ->join('tbl_album', 'tbl_galeri.galeri_album_id', '=', 'tbl_album.album_id')
            ->orderBy('tbl_galeri.galeri_id', 'DESC')
            ->get();
    }
    public static function simpan_galeri($judul, $album, $user_id, $user_nama, $gambar)
    {
        DB::beginTransaction();

        try {
            DB::connection('web-sekolah')->table('tbl_galeri')->insert([
                'galeri_judul' => $judul,
                'galeri_album_id' => $album,
                'galeri_pengguna_id' => $user_id,
                'galeri_author' => $user_nama,
                'galeri_gambar' => $gambar,
            ]);

            DB::connection('web-sekolah')->table('tbl_album')->where('album_id', $album)->increment('album_count');

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public static function update_galeri($galeri_id, $judul, $album, $user_id, $user_nama, $gambar)
    {
        return DB::connection('web-sekolah')->table('tbl_galeri')
            ->where('galeri_id', $galeri_id)
            ->update([
                'galeri_judul' => $judul,
                'galeri_album_id' => $album,
                'galeri_pengguna_id' => $user_id,
                'galeri_author' => $user_nama,
                'galeri_gambar' => $gambar,
            ]);
    }

    public static function update_galeri_tanpa_img($galeri_id, $judul, $album, $user_id, $user_nama)
    {
        return DB::connection('web-sekolah')->table('tbl_galeri')
            ->where('galeri_id', $galeri_id)
            ->update([
                'galeri_judul' => $judul,
                'galeri_album_id' => $album,
                'galeri_pengguna_id' => $user_id,
                'galeri_author' => $user_nama,
            ]);
    }

    public static function hapus_galeri($kode, $album)
    {
        DB::beginTransaction();

        try {
            DB::connection('web-sekolah')->table('tbl_galeri')->where('galeri_id', $kode)->delete();
            DB::connection('web-sekolah')->table('tbl_album')->where('album_id', $album)->decrement('album_count');

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public static function get_galeri_home()
    {
        return DB::connection('web-sekolah')->table('tbl_galeri')
            ->select('tbl_galeri.*', DB::raw("DATE_FORMAT(galeri_tanggal, '%d/%m/%Y') AS tanggal"), 'album_nama')
            ->join('tbl_album', 'tbl_galeri.galeri_album_id', '=', 'tbl_album.album_id')
            ->orderBy('tbl_galeri.galeri_id', 'DESC')
            ->limit(4)
            ->get();
    }

    public static function get_galeri_by_album_id($idalbum)
    {
        return DB::connection('web-sekolah')->table('tbl_galeri')
            ->select('tbl_galeri.*', DB::raw("DATE_FORMAT(galeri_tanggal, '%d/%m/%Y') AS tanggal"), 'album_nama')
            ->join('tbl_album', 'tbl_galeri.galeri_album_id', '=', 'tbl_album.album_id')
            ->where('galeri_album_id', $idalbum)
            ->orderBy('tbl_galeri.galeri_id', 'DESC')
            ->get();
    }

    public static function get_all_tulisan()
    {
        return DB::connection('web-sekolah')->table('tbl_tulisan')
            ->select('tbl_tulisan.*', DB::raw("DATE_FORMAT(tulisan_tanggal, '%d/%m/%Y') AS tanggal"))
            ->orderBy('tulisan_id', 'DESC')
            ->get();
    }

    public static function simpan_tulisan($judul, $isi, $kategori_id, $kategori_nama, $imgslider, $user_id, $user_nama, $gambar)
    {
        return DB::connection('web-sekolah')->table('tbl_tulisan')->insertGetId([
            'tulisan_judul' => $judul,
            'tulisan_isi' => $isi,
            'tulisan_kategori_id' => $kategori_id,
            'tulisan_kategori_nama' => $kategori_nama,
            'tulisan_img_slider' => $imgslider,
            'tulisan_pengguna_id' => $user_id,
            'tulisan_author' => $user_nama,
            'tulisan_gambar' => $gambar,
        ]);
    }

    public static function get_tulisan_by_kode($kode)
    {
        return DB::connection('web-sekolah')->table('tbl_tulisan')
            ->select('tbl_tulisan.*', DB::raw("DATE_FORMAT(tulisan_tanggal, '%d/%m/%Y') AS tanggal"))
            ->where('tulisan_id', $kode)
            ->first();
    }

    public static function update_tulisan($tulisan_id, $judul, $isi, $kategori_id, $kategori_nama, $imgslider, $user_id, $user_nama, $gambar)
    {
        return DB::connection('web-sekolah')->table('tbl_tulisan')
            ->where('tulisan_id', $tulisan_id)
            ->update([
                'tulisan_judul' => $judul,
                'tulisan_isi' => $isi,
                'tulisan_kategori_id' => $kategori_id,
                'tulisan_kategori_nama' => $kategori_nama,
                'tulisan_img_slider' => $imgslider,
                'tulisan_pengguna_id' => $user_id,
                'tulisan_author' => $user_nama,
                'tulisan_gambar' => $gambar,
            ]);
    }

    public static function update_tulisan_tanpa_img($tulisan_id, $judul, $isi, $kategori_id, $kategori_nama, $imgslider, $user_id, $user_nama)
    {
        return DB::connection('web-sekolah')->table('tbl_tulisan')
            ->where('tulisan_id', $tulisan_id)
            ->update([
                'tulisan_judul' => $judul,
                'tulisan_isi' => $isi,
                'tulisan_kategori_id' => $kategori_id,
                'tulisan_kategori_nama' => $kategori_nama,
                'tulisan_img_slider' => $imgslider,
                'tulisan_pengguna_id' => $user_id,
                'tulisan_author' => $user_nama,
            ]);
    }

    public static function hapus_tulisan($kode)
    {
        return DB::connection('web-sekolah')->table('tbl_tulisan')->where('tulisan_id', $kode)->delete();
    }


    public static function get_berita_slider()
    {
        return DB::connection('web-sekolah')->table('tbl_tulisan')
            ->select('tbl_tulisan.*', DB::raw("DATE_FORMAT(tulisan_tanggal, '%d/%m/%Y') AS tanggal"))
            ->where('tulisan_img_slider', '1')
            ->orderBy('tulisan_id', 'DESC')
            ->get();
    }

    public static function get_berita_home()
    {
        return DB::connection('web-sekolah')->table('tbl_tulisan')
            ->select('tbl_tulisan.*', DB::raw("DATE_FORMAT(tulisan_tanggal, '%d/%m/%Y') AS tanggal"))
            ->orderBy('tulisan_id', 'DESC')
            ->limit(3)
            ->get();
    }

    public static function berita_perpage($offset, $limit)
    {
        return DB::connection('web-sekolah')->table('tbl_tulisan')
            ->select('tbl_tulisan.*', DB::raw("DATE_FORMAT(tulisan_tanggal, '%d/%m/%Y') AS tanggal"))
            ->orderBy('tulisan_id', 'DESC')
            ->skip($offset)
            ->take($limit)
            ->get();
    }

    public static function berita()
    {
        return DB::connection('web-sekolah')->table('tbl_tulisan')
            ->select('tbl_tulisan.*', DB::raw("DATE_FORMAT(tulisan_tanggal, '%d/%m/%Y') AS tanggal"))
            ->orderBy('tulisan_id', 'DESC');
    }


    public static function get_berita_by_kode($kode)
    {
        return DB::connection('web-sekolah')->table('tbl_tulisan')
            ->select('tbl_tulisan.*', DB::raw("DATE_FORMAT(tulisan_tanggal, '%d/%m/%Y') AS tanggal"))
            ->where('tulisan_id', $kode)
            ->first();
    }

    public static function cari_berita($keyword)
    {
        return DB::connection('web-sekolah')->table('tbl_tulisan')
            ->select('tbl_tulisan.*', DB::raw("DATE_FORMAT(tulisan_tanggal, '%d/%m/%Y') AS tanggal"))
            ->where('tulisan_judul', 'LIKE', "%$keyword%")
            ->get();
    }

    public static function get_all_pengumuman()
    {
        return DB::connection('web-sekolah')->table('tbl_pengumuman')
            ->select('pengumuman_id', 'pengumuman_judul', 'pengumuman_deskripsi', DB::raw("DATE_FORMAT(pengumuman_tanggal, '%d/%m/%Y') AS tanggal"), 'pengumuman_author')
            ->orderBy('pengumuman_id', 'DESC')
            ->get();
    }

    public static function simpan_pengumuman($judul, $deskripsi)
    {
        $author = session('nama');
        return DB::connection('web-sekolah')->table('tbl_pengumuman')
            ->insert([
                'pengumuman_judul'      => $judul,
                'pengumuman_deskripsi'  => $deskripsi,
                'pengumuman_author'     => $author,
            ]);
    }

    public static function update_pengumuman($kode, $judul, $deskripsi)
    {
        $author = session('nama');
        return DB::connection('web-sekolah')->table('tbl_pengumuman')
            ->where('pengumuman_id', $kode)
            ->update([
                'pengumuman_judul'      => $judul,
                'pengumuman_deskripsi'  => $deskripsi,
                'pengumuman_author'     => $author,
            ]);
    }

    public static function hapus_pengumuman($kode)
    {
        return DB::connection('web-sekolah')->table('tbl_pengumuman')
            ->where('pengumuman_id', $kode)
            ->delete();
    }

    public static function get_pengumuman_home()
    {
        return DB::connection('web-sekolah')->table('tbl_pengumuman')
            ->select('pengumuman_id', 'pengumuman_judul', 'pengumuman_deskripsi', DB::raw("DATE_FORMAT(pengumuman_tanggal, '%d/%m/%Y') AS tanggal"), 'pengumuman_author')
            ->orderBy('pengumuman_id', 'DESC')
            ->limit(3)
            ->get();
    }

    public static function pengumuman()
    {
        return DB::connection('web-sekolah')->table('tbl_pengumuman')
            ->select('pengumuman_id', 'pengumuman_judul', 'pengumuman_deskripsi', DB::raw("DATE_FORMAT(pengumuman_tanggal, '%d/%m/%Y') AS tanggal"), 'pengumuman_author')
            ->orderBy('pengumuman_id', 'DESC');
    }

    public static function pengumuman_perpage($offset, $limit)
    {
        return DB::connection('web-sekolah')->table('tbl_pengumuman')
            ->select('pengumuman_id', 'pengumuman_judul', 'pengumuman_deskripsi', DB::raw("DATE_FORMAT(pengumuman_tanggal, '%d/%m/%Y') AS tanggal"), 'pengumuman_author')
            ->orderBy('pengumuman_id', 'DESC')
            ->skip($offset)
            ->take($limit)
            ->get();
    }

    public static function get_all_agenda()
    {
        return DB::connection('web-sekolah')->table('tbl_agenda')
            ->select('tbl_agenda.*', DB::raw("DATE_FORMAT(agenda_tanggal, '%d/%m/%Y') AS tanggal"))
            ->orderBy('agenda_id', 'DESC')
            ->get();
    }

    public static function simpan_agenda($nama_agenda, $deskripsi, $mulai, $selesai, $tempat, $waktu, $keterangan)
    {
        $author = session('nama');
        return DB::connection('web-sekolah')->table('tbl_agenda')
            ->insert([
                'agenda_nama'       => $nama_agenda,
                'agenda_deskripsi'  => $deskripsi,
                'agenda_mulai'      => $mulai,
                'agenda_selesai'    => $selesai,
                'agenda_tempat'     => $tempat,
                'agenda_waktu'      => $waktu,
                'agenda_keterangan' => $keterangan,
                'agenda_author'     => $author,
            ]);
    }

    public static function update_agenda($kode, $nama_agenda, $deskripsi, $mulai, $selesai, $tempat, $waktu, $keterangan)
    {
        $author = session('nama');
        return DB::connection('web-sekolah')->table('tbl_agenda')
            ->where('agenda_id', $kode)
            ->update([
                'agenda_nama'       => $nama_agenda,
                'agenda_deskripsi'  => $deskripsi,
                'agenda_mulai'      => $mulai,
                'agenda_selesai'    => $selesai,
                'agenda_tempat'     => $tempat,
                'agenda_waktu'      => $waktu,
                'agenda_keterangan' => $keterangan,
                'agenda_author'     => $author,
            ]);
    }

    public static function hapus_agenda($kode)
    {
        return DB::connection('web-sekolah')->table('tbl_agenda')
            ->where('agenda_id', $kode)
            ->delete();
    }

    // Front-end

    public static function get_agenda_home()
    {
        return DB::connection('web-sekolah')->table('tbl_agenda')
            ->select('tbl_agenda.*', DB::raw("DATE_FORMAT(agenda_tanggal, '%d/%m/%Y') AS tanggal"))
            ->orderBy('agenda_id', 'DESC')
            ->limit(3)
            ->get();
    }

    public static function agenda()
    {
        return DB::connection('web-sekolah')->table('tbl_agenda')
            ->select('tbl_agenda.*', DB::raw("DATE_FORMAT(agenda_tanggal, '%d/%m/%Y') AS tanggal"))
            ->orderBy('agenda_id', 'DESC');
    }

    public static function agenda_perpage($offset, $limit)
    {
        return DB::connection('web-sekolah')->table('tbl_agenda')
            ->select('tbl_agenda.*', DB::raw("DATE_FORMAT(agenda_tanggal, '%d/%m/%Y') AS tanggal"))
            ->orderBy('agenda_id', 'DESC')
            ->skip($offset)
            ->take($limit)
            ->get();
    }

    public static function get_all_files()
    {
        return DB::connection('web-sekolah')->table('tbl_files')
            ->select('file_id', 'file_judul', 'file_deskripsi', DB::raw("DATE_FORMAT(file_tanggal, '%d/%m/%Y') AS tanggal"), 'file_oleh', 'file_download', 'file_data')
            ->orderBy('file_id', 'DESC')
            ->get();
    }

    public static function simpan_file($judul, $deskripsi, $oleh, $file)
    {
        return DB::connection('web-sekolah')->table('tbl_files')
            ->insert([
                'file_judul'      => $judul,
                'file_deskripsi'  => $deskripsi,
                'file_oleh'       => $oleh,
                'file_data'       => $file,
            ]);
    }

    public static function update_file($kode, $judul, $deskripsi, $oleh, $file)
    {
        return DB::connection('web-sekolah')->table('tbl_files')
            ->where('file_id', $kode)
            ->update([
                'file_judul'      => $judul,
                'file_deskripsi'  => $deskripsi,
                'file_oleh'       => $oleh,
                'file_data'       => $file,
            ]);
    }

    public static function update_file_tanpa_file($kode, $judul, $deskripsi, $oleh)
    {
        return DB::connection('web-sekolah')->table('tbl_files')
            ->where('file_id', $kode)
            ->update([
                'file_judul'      => $judul,
                'file_deskripsi'  => $deskripsi,
                'file_oleh'       => $oleh,
            ]);
    }

    public static function hapus_file($kode)
    {
        return DB::connection('web-sekolah')->table('tbl_files')
            ->where('file_id', $kode)
            ->delete();
    }

    public static function get_file_byid($id)
    {
        return DB::connection('web-sekolah')->table('tbl_files')
            ->select('file_id', 'file_judul', 'file_deskripsi', DB::raw("DATE_FORMAT(file_tanggal, '%d/%m/%Y') AS tanggal"), 'file_oleh', 'file_download', 'file_data')
            ->where('file_id', $id)
            ->first();
    }

    // Front-end

    public static function get_files_home()
    {
        return DB::connection('web-sekolah')->table('tbl_files')
            ->select('file_id', 'file_judul', 'file_deskripsi', DB::raw("DATE_FORMAT(file_tanggal, '%d/%m/%Y') AS tanggal"), 'file_oleh', 'file_download', 'file_data')
            ->orderBy('file_id', 'DESC')
            ->limit(7)
            ->get();
    }

    public static function get_all_guru()
    {
        return DB::connection('web-sekolah')->table('tbl_guru')->get();
    }

    public static function simpan_guru($nip, $nama, $jenkel, $tmp_lahir, $tgl_lahir, $mapel, $photo)
    {
        return DB::connection('web-sekolah')->table('tbl_guru')
            ->insert([
                'guru_nip'        => $nip,
                'guru_nama'       => $nama,
                'guru_jenkel'     => $jenkel,
                'guru_tmp_lahir'  => $tmp_lahir,
                'guru_tgl_lahir'  => $tgl_lahir,
                'guru_mapel'      => $mapel,
                'guru_photo'      => $photo,
            ]);
    }

    public static function simpan_guru_tanpa_img($nip, $nama, $jenkel, $tmp_lahir, $tgl_lahir, $mapel)
    {
        return DB::connection('web-sekolah')->table('tbl_guru')
            ->insert([
                'guru_nip'        => $nip,
                'guru_nama'       => $nama,
                'guru_jenkel'     => $jenkel,
                'guru_tmp_lahir'  => $tmp_lahir,
                'guru_tgl_lahir'  => $tgl_lahir,
                'guru_mapel'      => $mapel,
            ]);
    }

    public static function update_guru($kode, $nip, $nama, $jenkel, $tmp_lahir, $tgl_lahir, $mapel, $photo)
    {
        return DB::connection('web-sekolah')->table('tbl_guru')
            ->where('guru_id', $kode)
            ->update([
                'guru_nip'        => $nip,
                'guru_nama'       => $nama,
                'guru_jenkel'     => $jenkel,
                'guru_tmp_lahir'  => $tmp_lahir,
                'guru_tgl_lahir'  => $tgl_lahir,
                'guru_mapel'      => $mapel,
                'guru_photo'      => $photo,
            ]);
    }

    public static function update_guru_tanpa_img($kode, $nip, $nama, $jenkel, $tmp_lahir, $tgl_lahir, $mapel)
    {
        return DB::connection('web-sekolah')->table('tbl_guru')
            ->where('guru_id', $kode)
            ->update([
                'guru_nip'        => $nip,
                'guru_nama'       => $nama,
                'guru_jenkel'     => $jenkel,
                'guru_tmp_lahir'  => $tmp_lahir,
                'guru_tgl_lahir'  => $tgl_lahir,
                'guru_mapel'      => $mapel,
            ]);
    }

    public static function hapus_guru($kode)
    {
        return DB::connection('web-sekolah')->table('tbl_guru')
            ->where('guru_id', $kode)
            ->delete();
    }

    // Front-end

    public static function guru()
    {
        return DB::connection('web-sekolah')->table('tbl_guru');
    }

    public static function guru_perpage($offset, $limit)
    {
        return DB::connection('web-sekolah')->table('tbl_guru')
            ->skip($offset)
            ->take($limit)
            ->get();
    }

    public static function get_all_siswa()
    {
        return DB::connection('web-sekolah')
            ->table('tbl_siswa')
            ->join('tbl_kelas', 'siswa_kelas_id', '=', 'kelas_id')
            ->select('tbl_siswa.*', 'kelas_nama')
            ->get();
    }

    public static function simpan_siswa($nis, $nama, $jenkel, $kelas, $photo)
    {
        return DB::connection('web-sekolah')
            ->table('tbl_siswa')
            ->insert([
                'siswa_nis'         => $nis,
                'siswa_nama'        => $nama,
                'siswa_jenkel'      => $jenkel,
                'siswa_kelas_id'    => $kelas,
                'siswa_photo'       => $photo,
            ]);
    }

    public static function simpan_siswa_tanpa_img($nis, $nama, $jenkel, $kelas)
    {
        return DB::connection('web-sekolah')
            ->table('tbl_siswa')
            ->insert([
                'siswa_nis'         => $nis,
                'siswa_nama'        => $nama,
                'siswa_jenkel'      => $jenkel,
                'siswa_kelas_id'    => $kelas,
            ]);
    }

    public static function update_siswa($kode, $nis, $nama, $jenkel, $kelas, $photo)
    {
        return DB::connection('web-sekolah')
            ->table('tbl_siswa')
            ->where('siswa_id', $kode)
            ->update([
                'siswa_nis'         => $nis,
                'siswa_nama'        => $nama,
                'siswa_jenkel'      => $jenkel,
                'siswa_kelas_id'    => $kelas,
                'siswa_photo'       => $photo,
            ]);
    }

    public static function update_siswa_tanpa_img($kode, $nis, $nama, $jenkel, $kelas)
    {
        return DB::connection('web-sekolah')
            ->table('tbl_siswa')
            ->where('siswa_id', $kode)
            ->update([
                'siswa_nis'         => $nis,
                'siswa_nama'        => $nama,
                'siswa_jenkel'      => $jenkel,
                'siswa_kelas_id'    => $kelas,
            ]);
    }

    public static function hapus_siswa($kode)
    {
        return DB::connection('web-sekolah')
            ->table('tbl_siswa')
            ->where('siswa_id', $kode)
            ->delete();
    }

    public static function siswa()
    {
        return DB::connection('web-sekolah')
            ->table('tbl_siswa')
            ->join('tbl_kelas', 'siswa_kelas_id', '=', 'kelas_id')
            ->select('tbl_siswa.*', 'kelas_nama');
    }

    public static function siswa_perpage($offset, $limit)
    {
        return DB::connection('web-sekolah')
            ->table('tbl_siswa')
            ->join('tbl_kelas', 'siswa_kelas_id', '=', 'kelas_id')
            ->select('tbl_siswa.*', 'kelas_nama')
            ->skip($offset)
            ->take($limit)
            ->get();
    }

    public static function get_all_album() {
        $result = DB::connection('web-sekolah')
            ->table('tbl_album')
            ->select('tbl_album.*', DB::raw("DATE_FORMAT(album_tanggal, '%d/%m/%Y') AS tanggal"))
            ->orderBy('album_id', 'DESC')
            ->get();

        return $result;
    }

    public static function simpan_album($album, $user_id, $user_nama, $gambar) {
        $result = DB::connection('web-sekolah')
            ->table('tbl_album')
            ->insert([
                'album_nama' => $album,
                'album_pengguna_id' => $user_id,
                'album_author' => $user_nama,
                'album_cover' => $gambar,
            ]);

        return $result;
    }

    // public static function get_tulisan_by_kode($kode) {
    //     $result = DB::connection('web-sekolah')
    //         ->table('tbl_tulisan')
    //         ->select('tbl_tulisan.*', DB::raw("DATE_FORMAT(tulisan_tanggal, '%d/%m/%Y') AS tanggal"))
    //         ->where('tulisan_id', $kode)
    //         ->first();

    //     return $result;
    // }

    public static function update_album($album_id, $album_nama, $user_id, $user_nama, $gambar) {
        $result = DB::connection('web-sekolah')
            ->table('tbl_album')
            ->where('album_id', $album_id)
            ->update([
                'album_nama' => $album_nama,
                'album_pengguna_id' => $user_id,
                'album_author' => $user_nama,
                'album_cover' => $gambar,
            ]);

        return $result;
    }

    public static function update_album_tanpa_img($album_id, $album_nama, $user_id, $user_nama) {
        $result = DB::connection('web-sekolah')
            ->table('tbl_album')
            ->where('album_id', $album_id)
            ->update([
                'album_nama' => $album_nama,
                'album_pengguna_id' => $user_id,
                'album_author' => $user_nama,
            ]);

        return $result;
    }

    public static function hapus_album($kode) {
        $result = DB::connection('web-sekolah')
            ->table('tbl_album')
            ->where('album_id', $kode)
            ->delete();

        return $result;
    }

}
