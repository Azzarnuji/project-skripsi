@extends('Template.TemplateDocument')
@section('addons-script-css')
    <script type="module">
        import '../assets/js/Admin/Gallery.js'
    </script>
    <link href="https://cdn.jsdelivr.net/npm/nanogallery2@3/dist/css/nanogallery2.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/nanogallery2@3/dist/jquery.nanogallery2.min.js">
    </script>
@endsection
@section('content')
    @include('Dashboard.Admin.Components.NavbarComponent', ['active' => 'gallery'])
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
                                    Buat Album Baru
                                    <span class="spinner-border spinner-border-sm visually-hidden mx-2"
                                        id="pilihKelasLoader" role="status" aria-hidden="true"></span>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-headingTwo">
                                <div class="accordion-body">
                                    <div class="mb-3">
                                        <label for="namaAlbum" class="form-label">Nama Album</label>
                                        <input type="text" class="form-control" id="namaAlbum" placeholder="Nama Album"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="albumCover" class="form-label">Album Cover</label>
                                        <input type="file" class="form-control" id="albumCover" placeholder="Album Cover"
                                            accept="image/*">
                                    </div>
                                    <input type="text" hidden name="emailAuthor" id="emailAuthor"
                                        value="{{ $profile['profile']['detail']['email'] }}">
                                    <input type="text" hidden name="nameAuthor" id="nameAuthor"
                                        value="{{ $profile['profile']['detail']['name'] }}">
                                    <button class="btn btn-primary" id="btnCTABuatAlbum">Buat</button>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseTwo">
                                    Tambah Foto Baru
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-headingThree">
                                <div class="accordion-body">
                                    <form action="/api/admin/tambahFotoBaru" method="POST" enctype="multipart/form-data">
                                        <input type="text" hidden name="emailAuthor" id="emailAuthor"
                                            value="{{ $profile['profile']['detail']['email'] }}">
                                        <input type="text" hidden name="nameAuthor" id="nameAuthor"
                                            value="{{ $profile['profile']['detail']['name'] }}">
                                        <div class="mb-3">
                                            <label for="judulGaleri" class="form-label">Judul Galeri</label>
                                            <input class="form-control" type="text" name="judulGaleri" id="judulGaleri">
                                        </div>
                                        <div class="mb-3">
                                            <label for="pilihAlbum" class="form-label">Pilih Album</label>
                                            <select class="form-select" aria-label="Default select example" id="pilihAlbum"
                                                name="album" required>
                                                <option selected value="">Pilih Album</option>
                                                @foreach ($data['album'] as $item)
                                                    <option value="{{ $item->album_id }}">{{ $item->album_nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="fotoBaru" class="form-label">Foto</label>
                                            <input class="form-control" type="file" name="fotoBaru[]" id="fotoBaru"
                                                accept="image/*" multiple required min="1">
                                        </div>
                                        <p class="fw-lighter text-danger">File harus bertipe image</p>
                                        <hr>
                                        <button class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <h3>Daftar Album <span id="detailNameKelas"></span></h3>
                    <div class="table-responsive">
                        <table class="mt-2 table pt-2" id="tableAlbum">
                            <thead>
                                <tr class="bg-primary text-white">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Album</th>
                                    <th scope="col">Album Tanggal</th>
                                    <th scope="col">Author Album</th>
                                    <th scope="col">Jumlah Foto</th>
                                    <th scope="col">Cover Album</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody id="tbodyAlbum">
                                <?php $no = 1; ?>
                                @foreach ($data['album'] as $item)
                                    <tr>
                                        <th scope="row">{{ $no++ }}</th>
                                        <td class="text-capitalize">{{ $item->album_nama }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td class="text-capitalize">{{ $item->album_author }}</td>
                                        <td>{{ $item->album_count }}</td>
                                        <td><img src="/assets/web-sekolah/assets/images/{{ $item->album_cover }}"
                                                alt="" width="100px" height="100px"></td>
                                        <td>
                                            <div class="row gap-2">
                                                <div class="col-12">
                                                    <a href="#" class="btn btn-sm btn-danger"
                                                        onclick="askBeforeExecution('Ingin Menghapus Data Album',()=>{
                                                            window.location.href = '/api/admin/hapusAlbum/{{ $item->album_id }}'
                                                        })">Hapus</a>
                                                </div>
                                                <div class="col-12">
                                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#modalAlbum"
                                                        data-bs-albumid="{{ $item->album_id }}">
                                                        Lihat Album
                                                    </button>
                                                </div>
                                            </div>
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

    <div class="modal fade" id="modalAlbum" tabindex="-1" aria-labelledby="modalAlbumLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAlbumLabel">New message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="gallery">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
@endsection
