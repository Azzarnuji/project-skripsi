@extends('Template.TemplateDocument')
@section('content')
    @include('Dashboard.Admin.Components.NavbarComponent', ['active' => 'ujian'])
    <div class="my-3">
        <div class="row" style="max-width: 100%">
            <div class="col-md-4">
                <div class="container">
                    <div class="card">
                        <div class="card-header fw-bold">
                            Tambah Ujian
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" onsubmit="return false">
                                @csrf
                                <div class="mb-3">
                                    <label for="namaUjian" class="form-label">Nama
                                        Ujian</label>
                                    <input type="text" class="form-control" id="namaUjian"
                                        placeholder="Masukan Nama" name="NamaUjian" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jumlahSoal" class="form-label">Jumlah Soal</label>
                                    <input type="number" class="form-control" id="jumlahSoal"
                                        placeholder="Masukan Jumlah Soal" name="JumlahSoal" required
                                        value="">
                                </div>
                                <div class="mb-3">
                                    <label for="jumlahSoal" class="form-label">Bobot Nilai</label>
                                    <input type="number" class="form-control" id="bobotNilai"
                                        placeholder="Bobot Nilai" name="BobotNilai" required
                                        value="">
                                </div>
                                <div class="mb-3">
                                    <label for="jumlahSoal" class="form-label">Total Nilai
                                        Ujian</label>
                                    <input type="number" class="form-control" id="totalNilai"
                                        placeholder="Total Nilai" name="totalNilai" required
                                        value="" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="jumlahSoal" class="form-label">Nilai Minimal Untuk Lulus
                                        Ujian</label>
                                    <input type="number" class="form-control" id="nilaiMinimal"
                                        placeholder="Nilai Minimal Untuk Lulus" name="NilaiMinimal"
                                        required value="">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Ujian Untuk

                                    </label>
                                    <select class="form-select form-select-sm"
                                        aria-label=".form-select-sm example" name="UjianUntuk"
                                        id="ujianUntuk">
                                        <option selected>Pilih Untuk</option>
                                        <option value="daftar_baru">Daftar Baru</option>
                                        <option value="x">X</option>
                                        <option value="xi">XI</option>
                                        <option value="xii">XII</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary" id="btnGenerateSoal">
                                    Buat Soal
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-8">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Daftar Ujian</h5>
                            <p class="fw-light text-muted">Informasi Ujian
                            </p>
                            <hr>
                            <div class="table-responsive">

                                <table class="table">
                                    <thead>
                                        <tr class="bg-primary text-white">
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Ujian</th>
                                            <th scope="col">Ujian Untuk</th>
                                            <th scope="col">Jumlah Soal</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;

                                        @endphp
                                        @foreach ($data_ujian as $data)
                                            <tr>
                                                <th class="fw-normal" scope="row">{{ $no++ }}
                                                </th>
                                                <th class="fw-normal">
                                                    {{ \App\Helpers\Utils::removeSpecialChar($data->nama_ujian) }}
                                                </th>
                                                <th class="fw-normal text-capitalize">
                                                    {{ \App\Helpers\Utils::removeSpecialChar($data->ujian_untuk) }}
                                                </th>
                                                <th class="fw-normal">
                                                    {{ \App\Helpers\Utils::removeSpecialChar($data->jumlah_soal) }}
                                                </th>
                                                <th>
                                                    <button type="button"
                                                        class="btn btn-primary btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detailSoal"
                                                        data-bs-ujianid="{{ $data->ujian_id }}">Detail</button>
                                                    <a href="#" class="btn btn-danger btn-sm"
                                                        onclick="askBeforeExecution('Yakin Hapus Ujian? Semua data ujian akan dihapus, dan data siswa yang telah ikut ujian juga akan terhapus', ()=>{
                                                            window.location.href = '/api/admin/hapusUjian/{{ $data->ujian_id }}'
                                                        })">Hapus</a>
                                                </th>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Soal-->
    <div class="modal fade" id="tambahSoal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="labelModal">...</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" id="bodyModal">
                    <form action="/api/admin/ujian" method="POST" id="formSoal">
                        @csrf


                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="detailSoal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="labelModalDetail">...</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" id="bodyModalDetail">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endSection
