@extends('Template.TemplateDocument')
@section('addons-script-css')
    <script type="module">
        import '../assets/js/Admin/Berita.js'
    </script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.snow.css" rel="stylesheet">
@endsection
@section('content')
    @include('Dashboard.Admin.Components.NavbarComponent', ['active' => 'berita'])
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 mb-3">
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modalBerita">
                    Tambah Berita
                </button>
            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table id="tableBerita" class="mt-2 table pt-2">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th scope="col">No</th>
                                <th scope="col">Judul Berita</th>
                                <th scope="col">Isi Berita</th>
                                <th scope="col">Tanggal Berita</th>
                                <th scope="col">Kategori Berita</th>
                                <th scope="col">Author Berita</th>
                                <th scope="col">Tampil Di Home ?</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($data['berita'] as $item)
                                <tr>
                                    <th class="fw-normal">{{ $no++ }}</th>
                                    <th class="fw-normal text-capitalize">{{ $item->tulisan_judul }}</th>
                                    <th class="fw-normal text-capitalize" id="beritaIsi{{ $no }}">
                                        {{ \App\Helpers\Utils::sanitizeLimitString($item->tulisan_isi) }}
                                        <a href="#"
                                            onclick="readMore('beritaIsi{{ $no }}','{{ strip_tags($item->tulisan_isi) }}')"><small>...Read
                                                more</small></a>
                                    </th>
                                    <th class="fw-normal text-capitalize">{{ $item->tulisan_tanggal }}</th>
                                    <th class="fw-normal text-capitalize">{{ $item->tulisan_kategori_nama }}</th>
                                    <th class="fw-normal text-capitalize">{{ $item->tulisan_author }}</th>
                                    <th class="fw-normal text-capitalize">
                                        {{ $item->tulisan_img_slider == 1 ? 'Ya' : 'Tidak' }}</th>
                                    <th>
                                        <a href="#"
                                            onclick="askBeforeExecution('Anda Yakin Ingin Hapus Berita ?',()=>{window.location.href = '/api/admin/hapusBerita/{{ $item->tulisan_id }}'})"
                                            class="btn btn-danger">Hapus</a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalBerita" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Berita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/api/admin/tambahBerita" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <label for="tampilHome" class="form-label">Tampilkan Di Home ?</label>
                                <input class="form-check-input" type="checkbox" id="tampilHome" name="tampilHome">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="judulBerita" class="form-label">Judul berita</label>
                            <input type="text" class="form-control" id="judulBerita" placeholder="Judul Berita"
                                name="judulBerita">
                        </div>

                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select example" name="pilihKategori">
                                <option selected>Pilih Kategori</option>
                                @foreach ($data['kategori'] as $item)
                                    <option value="{{ $item->kategori_id }}">{{ $item->kategori_nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggalDibuat" class="form-label">Tanggal Dibuat</label>
                            <input type="date" class="form-control" id="tanggalDibuat" placeholder="Tanggal Dibuat"
                                name="tanggalDibuat">
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Gambar Berita</label>
                            <input class="form-control" type="file" id="formFile" name="gambarBerita">
                        </div>
                        <input type="text" hidden name="quill-html" id="quill-html">
                        <input type="text" hidden name="emailAuthor"
                            value="{{ $profile['profile']['detail']['email'] }}">
                        <input type="text" hidden name="nameAuthor" value="{{ $profile['profile']['detail']['name'] }}">
                        <div id="editor" class="mb-3">

                        </div>
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
