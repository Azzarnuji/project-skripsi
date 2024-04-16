@extends('Template.TemplateDocument')

@section('content')
    @include('Dashboard.Admin.Components.NavbarComponent', ['active' => 'guru'])
    <div class="my-3">
        <div class="row" style="max-width: 100%">
            <div class="col-md-4">
                <div class="container">
                    <div class="card">
                        <div class="card-header fw-bold">
                            Tambah Guru
                        </div>
                        <div class="card-body">
                            <form action="/api/admin/guru" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="namaGuru" class="form-label">Nama
                                        Guru</label>
                                    <input type="text" class="form-control" id="namaGuru"
                                        placeholder="Masukan Nama" name="NamaGuru" required>
                                </div>
                                <div class="mb-3">
                                    <label for="emailGuru" class="form-label">Email
                                        Guru</label>
                                    <input type="text" class="form-control" id="emailGuru"
                                        placeholder="Masukan Email (Auto)" name="EmailGuru" required
                                        value="">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Status
                                        Guru</label>
                                    <select class="form-select form-select-sm"
                                        aria-label=".form-select-sm example" name="StatusGuru" required>
                                        <option value="">Pilih Status Guru</option>
                                        <option value="guru">Guru</option>
                                        <option value="guru_tu">Guru TU</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Mengajar
                                        Kelas
                                        <p class="fw-light text-muted mb-0">Tekan CTRL Untuk Memilih
                                            Lebih Dari 1</p>
                                    </label>
                                    <select class="form-select form-select-sm"
                                        aria-label=".form-select-sm example" name="Mengajar[]" multiple
                                        required>
                                        <option value="x">X</option>
                                        <option value="xi">XI</option>
                                        <option value="xii">XII</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-8">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Daftar Guru</h5>
                            <p class="fw-light text-muted">Informasi Guru
                            </p>
                            <hr>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr class="bg-primary text-white">
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Guru</th>
                                            <th scope="col">Email Guru</th>
                                            <th scope="col">Status Guru</th>
                                            <th scope="col">Mengajar Dikelas</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;

                                        @endphp
                                        @foreach ($datas as $data)
                                            <tr>
                                                <th scope="row">{{ $no++ }}</th>
                                                <td class="text-capitalize">{{ $data->nama_guru }}</td>
                                                <td>{{ $data->email }}</td>
                                                <td class="text-uppercase">
                                                    {{ \App\Helpers\Utils::removeSpecialChar($data->status_guru) }}
                                                </td>
                                                <td class="text-uppercase">
                                                    {{ \App\Helpers\Utils::arrayToString(json_decode($data->mengajar_kelas)) }}
                                                </td>

                                                <td>
                                                    <a href="#" class="btn btn-sm btn-danger"
                                                        onclick="askBeforeExecution('Ingin Menghapus Data Guru',()=>{
                                                            window.location.href = '/api/admin/hapusGuru/{{ $data->email }}'
                                                        })">Hapus</a>
                                                </td>
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
@endSection
