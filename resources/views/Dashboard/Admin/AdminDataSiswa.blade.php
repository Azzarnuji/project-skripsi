@extends('Template.TemplateDocument')
@section('content')
    @include('Dashboard.Admin.Components.NavbarComponent', ['active' => 'data-siswa'])
    <div class="my-3">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <h3>Menu</h3>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseOne">
                                    Lihat Data Siswa
                                    <span class="spinner-border spinner-border-sm visually-hidden mx-2"
                                        id="pilihKelasLoader" role="status" aria-hidden="true"></span>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-headingTwo">
                                <div class="accordion-body">
                                    <div class="form-group mb-3">
                                        <label for="pilihKelas" class="form-label">Pilih Kelas</label>
                                        <select class="form-select" aria-label="Default select example" id="pilihKelas">
                                            <option value="" selected>Pilih Kelas</option>
                                            <option value="x">X</option>
                                            <option value="xi">XI</option>
                                            <option value="xii">XII</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="pilihSubKelas" class="form-label">Pilih
                                            Sub-Kelas</label>
                                        <div id="containerSubKelas">


                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="pilihSubKelas" class="form-label">ID Kelas</label>
                                        <input type="text" class="form-control" id="IDKelas">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseTwo">
                                    Tambah List Data Siswa
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-headingThree">
                                <div class="accordion-body">
                                    <a href="{{ url('download-file-format') }}" class="btn btn-primary">Download Import
                                        Format</a>
                                    <hr>
                                    <form action="/api/admin/tambahListSiswa" method="POST" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">File Data
                                                Siswa</label>
                                            <input class="form-control" type="file" name="fileImport" id="formFile"
                                                accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                        </div>
                                        <p class="fw-lighter text-danger">File harus sesuai dengan
                                            format import.</p>
                                        <hr>
                                        <button class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <h3>Daftar List Siswa <span id="detailNameKelas"></span></h3>
                    <div class="table-responsive">
                        <table class="mt-2 table pt-2" id="tableListSiswaParent">
                            <thead>
                                <tr class="bg-primary text-white">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">NIS</th>
                                    <th scope="col">NISN</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Sub-Kelas</th>
                                    <th scope="col">Wali Kelas</th>
                                </tr>
                            </thead>

                            <tbody id="containerListSiswa">
                                {{-- <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>1234</td>
                                    <td>1234</td>
                                    <td>X</td>
                                    <td>X-A</td>
                                    <td>Wali Kelas</td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
