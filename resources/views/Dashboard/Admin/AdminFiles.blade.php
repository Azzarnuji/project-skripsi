@extends('Template.TemplateDocument')
@section('addons-script-css')
    <script type="module">
        import '../assets/js/Admin/Files.js'
    </script>
    {{-- <script src="https://unpkg.com/pdfobject"></script> --}}
@endsection
@section('content')
    @include('Dashboard.Admin.Components.NavbarComponent', ['active' => 'files'])
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 mb-3">
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modalFile">
                    Tambah File
                </button>
            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table id="tableFiles" class="mt-2 table pt-2">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th scope="col">No</th>
                                <th scope="col">File Judul</th>
                                <th scope="col">File Deskripsi</th>
                                <th scope="col">File Tanggal</th>
                                <th scope="col">File Oleh</th>
                                <th scope="col">File Data</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($data['files'] as $item)
                                <tr>
                                    <th class="fw-normal">{{ $no++ }}</th>
                                    <th class="fw-normal text-capitalize">{{ $item->file_judul }}</th>
                                    <th class="fw-normal text-capitalize">{{ $item->file_deskripsi }}</th>
                                    <th class="fw-normal text-capitalize">{{ $item->tanggal }}</th>
                                    <th class="fw-normal text-capitalize">{{ $item->file_oleh }}</th>
                                    <th class="fw-normal text-capitalize">{{ $item->file_data }}</th>

                                    <th>
                                        <div class="d-flex justify-content-center">
                                            <div class="row mx-2 gap-2">
                                                <div class="col-12">
                                                    <a href="#"
                                                        onclick="askBeforeExecution('Anda Yakin Ingin Hapus File ?',()=>{window.location.href = '/api/admin/hapusFile/{{ $item->file_id }}'})"
                                                        class="btn btn-danger">Hapus</a>
                                                </div>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                        data-bs-target="#modalViewFile"
                                                        data-bs-url-file="{{ \App\Helpers\Utils::base_url_web_sekolah() . 'assets/files/' . $item->file_data }}">Lihat
                                                        file</button>

                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalViewFile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lihat File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="viewFile">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalFile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/api/admin/tambahFile" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="judulFile" class="form-label">Judul File</label>
                            <input type="text" class="form-control" id="judulFile" placeholder="Judul File"
                                name="judulFile" required>
                        </div>
                        <div class="mb-3">
                            <label for="fileTanggal" class="form-label">File Tanggal</label>
                            <input type="date" class="form-control" id="fileTanggal" placeholder="File Tanggal"
                                name="fileTanggal" required>
                        </div>
                        <div class="mb-3">
                            <label for="fileOleh" class="form-label">File Oleh</label>
                            <input type="text" class="form-control" id="fileOleh" placeholder="File Oleh"
                                name="fileOleh" required>
                        </div>
                        <div class="mb-3">
                            <label for="fileData" class="form-label">File</label>
                            <input class="form-control" type="file" id="fileData" name="fileData" required
                                accept="application/pdf, application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                        </div>

                        <div class="mb-3">
                            <label for="fileDeskripsi" class="form-label">File Deskripsi</label>
                            <textarea class="form-control" id="fileDeskripsi" rows="3" name="fileDeskripsi"></textarea>
                        </div>
                        <input type="text" hidden name="emailAuthor"
                            value="{{ $profile['profile']['detail']['email'] }}">
                        <input type="text" hidden name="nameAuthor"
                            value="{{ $profile['profile']['detail']['name'] }}">
                        <button class="btn btn-primary" type="submit" id="btnCTASimpan">
                            Simpan
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
