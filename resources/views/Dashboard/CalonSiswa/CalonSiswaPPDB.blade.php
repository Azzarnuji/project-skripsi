@extends('Template.TemplateDocument')
@section('content')
    @include('Dashboard.CalonSiswa.Components.NavbarComponent', [
        'statusKelulusan' => $datas['statusKelulusan'],
        'active' => 'ppdb',
    ])
    <div class="container">
        @if (
            $datas['statusPPDB'] == \App\Data\StatusPPDB::SUDAH_MELAKUKAN_PENDAFTARAN ||
                $datas['statusPPDB'] == \App\Data\StatusPPDB::PPDB_DITERIMA)
            <div class="card bg-success my-5 mb-3 text-center text-white"
                style="max-width: 100%; max-height: 100%">
                <div class="card-header">Pemberitahuan</div>
                <div class="card-body">
                    @if ($datas['statusPPDB'] == \App\Data\StatusPPDB::PPDB_DITERIMA)
                        <h5 class="card-title">Anda Diterima Disekolah Kami</h5>
                        <p class="card-text">Selamat Anda Diterima Disekolah Kami</p>
                    @else
                        <h5 class="card-title">Anda Sudah Melakukan Pengisian Data PPDB</h5>
                        <p class="card-text">Silahkan Menunggu Sampai Pihak Sekolah Memberikan Kelas
                            Kepada
                            Anda</p>
                    @endif
                    @if ($datas['statusPPDB'] == \App\Data\StatusPPDB::PPDB_DITERIMA)
                        <a href="/login" class="btn btn-primary">Login Sebagai Siswa</a>
                    @endif
                </div>
            </div>
        @else
            <form action="/api/calon_siswa/ppdb" method="post" enctype="multipart/form-data">
                @csrf
                <div class="data-diri mt-3">
                    <h3>Data Diri</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="email">Email</span>
                                <input type="text" class="form-control" placeholder="Email"
                                    aria-label="Name" aria-describedby="email" name="Email"
                                    value="{{ $profile['profile']['detail']['email'] }}" readonly>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="asalSekolah">Asal Sekolah</span>
                                <input type="text" class="form-control" placeholder="Asal Sekolah"
                                    aria-label="Asal Sekolah" aria-describedby="asalSekolah"
                                    name="AsalSekolah" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="nisn">NISN</span>
                                <input type="text" class="form-control" placeholder="NISN"
                                    aria-label="NISN" aria-describedby="nisn" name="NISN" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="namaLengkap">Nama Lengkap</span>
                                <input type="text" class="form-control" placeholder="Nama Lengkap"
                                    aria-label="Nama Lengkap" aria-describedby="namaLengkap"
                                    name="NamaLengkap"
                                    value="{{ $profile['profile']['detail']['name'] }}" readonly>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="nis">NIS</span>
                                <input type="text" class="form-control" placeholder="NIS"
                                    aria-label="NIS" aria-describedby="nis" name="NIS" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="tempatTanggalLahir">Tempat Tanggal
                                    Lahir</span>
                                <input type="text" class="form-control"
                                    placeholder="Contoh: Bekasi, 19-10-1996"
                                    aria-label="Tempat Tanggal Lahir"
                                    aria-describedby="tempatTanggalLahir" name="TempatTanggalLahir"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Foto Diri Anda</label>
                                <input class="form-control" type="file" id="formFile"
                                    name="FotoDiri">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="data-ayah mt-3">
                    <h3>Data Ayah</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="namaAyah">Nama Ayah</span>
                                <input type="text" class="form-control" placeholder="Nama Ayah"
                                    aria-label="Nama Ayah" aria-describedby="namaAyah" name="NamaAyah"
                                    required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="alamatAyah">Alamat Ayah</span>
                                <input type="text" class="form-control" placeholder="Alamat Ayah"
                                    aria-label="Alamat Ayah" aria-describedby="alamatAyah"
                                    name="AlamatAyah" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="pekerjaanAyah">Pekerjaan
                                    Ayah</span>
                                <input type="text" class="form-control"
                                    placeholder="Pekerjaan Ayah" aria-label="Pekerjaan Ayah"
                                    aria-describedby="pekerjaanAyah" name="PekerjaanAyah" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="nomorTeleponAyah">Nomor Telepon
                                    Ayah</span>
                                <input type="text" class="form-control"
                                    placeholder="Nomor Telepon Ayah" aria-label="Nomor Telepon Ayah"
                                    aria-describedby="nomorTeleponAyah" name="NomorTeleponAyah"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="data-ibu mt-3">
                    <h3>Data Ibu</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="namaIbu">Nama Ibu</span>
                                <input type="text" class="form-control" placeholder="Nama Ibu"
                                    aria-label="Nama Ibu" aria-describedby="namaIbu" name="NamaIbu"
                                    required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="alamatIbu">Alamat Ibu</span>
                                <input type="text" class="form-control" placeholder="Alamat Ibu"
                                    aria-label="Alamat Ibu" aria-describedby="alamatIbu"
                                    name="AlamatIbu" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="pekerjaanIbu">Pekerjaan Ibu</span>
                                <input type="text" class="form-control"
                                    placeholder="Pekerjaan Ibu" aria-label="Pekerjaan Ibu"
                                    aria-describedby="pekerjaanIbu" name="PekerjaanIbu" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="nomorTeleponIbu">Nomor Telepon
                                    Ibu</span>
                                <input type="text" class="form-control"
                                    placeholder="Nomor Telepon Ibu" aria-label="Nomor Telepon Ibu"
                                    aria-describedby="nomorTeleponIbu" name="NomorTeleponIbu"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Simpan</button>

                </div>
            </form>
        @endif
    </div>
@endSection
