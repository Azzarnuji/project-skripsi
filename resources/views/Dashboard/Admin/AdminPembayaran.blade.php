@extends('Template.TemplateDocument')
@section('content')
    @include('Dashboard.Admin.Components.NavbarComponent', ['active' => 'pembayaran'])
    <div class="my-3">
        <div class="row" style="max-width: 100%">
            <div class="col-md-4">
                <div class="container mb-2">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                            <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#panelTambahMetodePembayaran"
                                aria-expanded="false" aria-controls="panelTambahMetodePembayaran">
                                <span class="fw-bold">Tambah Metode Pembayaran</span>
                            </button>
                        </h2>
                        <div id="panelTambahMetodePembayaran" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingTwo">
                            <div class="accordion-body">
                                <div class="card">

                                    <div class="card-body">
                                        <form action="/api/admin/tambahMetodePembayaran" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1"
                                                    class="form-label">Nama
                                                    Bank</label>
                                                <input type="text" class="form-control"
                                                    id="exampleFormControlInput1"
                                                    placeholder="Masukan Nama Pembayaran"
                                                    name="NamaBank" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1"
                                                    class="form-label">No
                                                    Rekening</label>
                                                <input type="number" class="form-control"
                                                    id="exampleFormControlInput1" placeholder="Nominal"
                                                    name="NoRekening" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1"
                                                    class="form-label">Nama
                                                    Pemilik</label>
                                                <input type="text" class="form-control"
                                                    id="exampleFormControlInput1"
                                                    placeholder="Nama Pemilik" name="NamaPemilik"
                                                    required>
                                            </div>

                                            <button type="submit"
                                                class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="container">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                            <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#panelTambahBiayaPembayaran"
                                aria-expanded="false" aria-controls="panelTambahBiayaPembayaran">
                                <span class="fw-bold">Tambah Biaya Pembayaran</span>
                            </button>
                        </h2>
                        <div id="panelTambahBiayaPembayaran" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingTwo">
                            <div class="accordion-body">
                                <div class="card">

                                    <div class="card-body">
                                        <form action="/api/admin/pembayaran" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1"
                                                    class="form-label">Nama
                                                    Pembayaran</label>
                                                <input type="text" class="form-control"
                                                    id="exampleFormControlInput1"
                                                    placeholder="Masukan Nama Pembayaran"
                                                    name="NamaPembayaran" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1"
                                                    class="form-label">Nominal</label>
                                                <input type="number" class="form-control"
                                                    id="exampleFormControlInput1" placeholder="Nominal"
                                                    name="Nominal" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1"
                                                    class="form-label">Untuk Kelas

                                                </label>
                                                <select class="form-select form-select-sm"
                                                    aria-label=".form-select-sm example"
                                                    name="UntukKelas" required>
                                                    <option selected>Pilih Untuk Kelas</option>
                                                    <option value="daftar_baru">Daftar Baru</option>
                                                    <option value="x">X</option>
                                                    <option value="xii">XI</option>
                                                    <option value="xiii">XII</option>
                                                </select>
                                            </div>

                                            <button type="submit"
                                                class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="col-md-8">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>List Metode Pembayaran</h5>
                            <p class="fw-light text-muted">Informasi Metode Pembayaran
                            </p>
                            <hr>
                            <div class="table-responsive">

                                <table class="table">
                                    <thead>
                                        <tr class="bg-primary text-white">
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Bank</th>
                                            <th scope="col">Nama Pemilik Bank</th>
                                            <th scope="col">No Rekening</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datas['metodePembayaran'] as $data)
                                            <tr>
                                                <th scope="row">{{ $no++ }}</th>
                                                <td>{{ $data->nama_bank }}</td>
                                                <td>{{ $data->nama_pemilik }}</td>
                                                <td>{{ $data->nomor_rekening }}</td>
                                                <td><a href="#" class="btn btn-danger btn-sm"
                                                        onclick="askBeforeExecution('Yakin Ingin Hapus Metode Pembayaran',()=>{window.location.href='/api/admin/hapusMetodePembayaran/{{ $data->id }}'})">Hapus</a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="col-sm-12">
                            <h5>List Biaya Pembayaran</h5>
                            <p class="fw-light text-muted">Informasi Biaya Pembayaran
                            </p>
                            <hr>
                            <div class="table-responsive">

                                <table class="table">
                                    <thead>
                                        <tr class="bg-primary text-white">
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Pembayaran</th>
                                            <th scope="col">Biaya</th>
                                            <th scope="col">Untuk Kelas</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datas['listPembayaran'] as $data)
                                            <tr>
                                                <th scope="row">{{ $no++ }}</th>
                                                <td>{{ $data->nama_pembayaran }}</td>
                                                <td>RP.{{ \App\Helpers\Utils::currency($data->nominal) }}
                                                </td>
                                                <td class="text-uppercase">
                                                    {{ \App\Helpers\Utils::removeSpecialChar($data->untuk_kelas) }}
                                                </td>
                                                <td>
                                                    @if ($data->deleted_at == null)
                                                        <a href="#"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="askBeforeExecution('Semua data biaya pembayaran akan dihapus, dan detail data siswa yang telah melakukan pembayaran juga akan terhapus ',()=>{window.location.href='/api/admin/hapusPembayaran/{{ $data->pembayaran_id }}'})">Hapus</a>
                                                    @else
                                                        <a href="#"
                                                            class="btn btn-sm btn-success"
                                                            onclick="askBeforeExecution('Yakin Ingin Mengaktifkan Biaya Pembayaran ?',()=>{window.location.href='/api/admin/activePembayaran/{{ $data->pembayaran_id }}'})">Aktifkan</a>
                                                    @endif
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
