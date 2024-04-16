@extends('Template.TemplateDocument')
@section('content')
    @include('Dashboard.Admin.Components.NavbarComponent', ['active' => 'kelas'])
    <div class="my-3">
        <div class="row" style="max-width: 100%">
            <div class="col-md-4">
                <div class="container">
                    <div class="card">
                        <div class="card-header fw-bold">
                            Tambah Kelas
                        </div>
                        <div class="card-body">
                            <form action="/api/admin/kelas" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1"
                                        class="form-label">Kelas</label>
                                    <select class="form-select form-select-sm"
                                        aria-label=".form-select-sm example" name="Kelas">
                                        <option value="x">X</option>
                                        <option value="xi">XI</option>
                                        <option value="xii">XII</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1"
                                        class="form-label">Sub-Kelas</label>
                                    <input type="text" class="form-control"
                                        id="exampleFormControlInput1" placeholder="Masukan Sub-Kelas"
                                        name="SubKelas">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Wali
                                        Kelas</label>
                                    <select class="form-select form-select-sm"
                                        aria-label=".form-select-sm example" name="WaliKelas">
                                        @foreach ($datas['guru'] as $wali)
                                            <option value="{{ $wali->nama_guru }}">
                                                {{ $wali->nama_guru }}
                                            </option>
                                        @endforeach

                                    </select>
                                    {{-- <input type="text" class="form-control"
                                        id="exampleFormControlInput1" placeholder="Masukan Wali Kelas"
                                        name="WaliKelas" required> --}}
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
                            <h5>Daftar Kelas</h5>
                            <p class="fw-light text-muted">Informasi Kelas
                            </p>
                            <hr>
                            <div class="table-responsive">

                                <table class="table">
                                    <thead>
                                        <tr class="bg-primary text-white">
                                            <th scope="col">No</th>
                                            <th scope="col">ID Kelas</th>
                                            <th scope="col">Kelas</th>
                                            <th scope="col">Sub-Kelas</th>
                                            <th scope="col">Wali Kelas</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datas['getAllKelas'] as $data)
                                            <tr>
                                                <th scope="row">{{ $no++ }}</th>
                                                <td>{{ $data->id_kelas }}</td>
                                                <td class="text-uppercase">{{ $data->kelas }}</td>
                                                <td>{{ $data->sub_kelas }}</td>
                                                <td>{{ $data->wali_kelas }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editKelasModal"
                                                        data-bs-kelas="{{ $data->kelas }}"
                                                        data-bs-idkelas={{ $data->id_kelas }}
                                                        data-bs-subkelas={{ $data->sub_kelas }}>Edit</button>

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
    <div class="modal fade" id="editKelasModal" tabindex="1" aria-labelledby="editKelasModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editKelasModalLabel">Edit Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/api/admin/editKelas" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Kelas</label>
                            <input type="text" class="form-control" placeholder="Masukan IDKelas"
                                name="IDKelas" id="idKelas" readonly hidden>
                            <input type="text" class="form-control text-uppercase"
                                placeholder="Masukan Kelas" name="Kelas" id="editKelas" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Sub-Kelas</label>
                            <input type="text" class="form-control" placeholder="Masukan Sub-Kelas"
                                name="SubKelas" id="editSubKelas" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Wali
                                Kelas</label>
                            <select class="form-select form-select-sm"
                                aria-label=".form-select-sm example" name="WaliKelas">
                                @foreach ($datas['guru'] as $wali)
                                    <option value="{{ $wali->nama_guru }}">
                                        {{ $wali->nama_guru }}
                                    </option>
                                @endforeach

                            </select>
                            {{-- <input type="text" class="form-control"
                                id="exampleFormControlInput1" placeholder="Masukan Wali Kelas"
                                name="WaliKelas" required> --}}
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endSection
