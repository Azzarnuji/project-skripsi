@extends('Template.TemplateDocument')
@section('addons-script-css')
    <script type="module">
        import '../assets/js/Admin/Agenda.js'
    </script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.snow.css" rel="stylesheet">
@endsection
@section('content')
    @include('Dashboard.Admin.Components.NavbarComponent', ['active' => 'agenda'])
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 mb-3">
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modalAgenda">
                    Tambah Agenda
                </button>
            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table id="tableAgenda" class="mt-2 table pt-2">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th scope="col">No</th>
                                <th scope="col">Judul Agenda</th>
                                <th scope="col">Isi Agenda</th>
                                <th scope="col">Agenda Mulai</th>
                                <th scope="col">Agenda Selesai</th>
                                <th scope="col">Agenda Tempat</th>
                                <th scope="col">Agenda Waktu</th>
                                <th scope="col">Agenda Keterangan</th>
                                <th scope="col">Author Agenda</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($data['agenda'] as $item)
                                <tr>
                                    <th class="fw-normal">{{ $no++ }}</th>
                                    <th class="fw-normal text-capitalize">{{ $item->agenda_nama }}</th>
                                    <th class="fw-normal text-capitalize" id="agendaDesc{{ $no }}">
                                        {{ \App\Helpers\Utils::sanitizeLimitString($item->agenda_deskripsi) }}
                                        <a href="#"
                                            onclick="readMore('agendaDesc{{ $no }}','{{ strip_tags($item->agenda_deskripsi) }}')"><small>...Read
                                                more</small></a>
                                    </th>
                                    <th class="fw-normal text-capitalize">{{ $item->agenda_mulai }}</th>
                                    <th class="fw-normal text-capitalize">{{ $item->agenda_selesai }}</th>
                                    <th class="fw-normal text-capitalize">{{ $item->agenda_tempat }}</th>
                                    <th class="fw-normal text-capitalize">{{ $item->agenda_waktu }}</th>
                                    <th class="fw-normal text-capitalize" id="agendaKet{{ $no }}">
                                        {{ \App\Helpers\Utils::sanitizeLimitString($item->agenda_keterangan) }}
                                        <a href="#"
                                            onclick="readMore('agendaKet{{ $no }}','{{ strip_tags($item->agenda_keterangan) }}')"><small>...Read
                                                more</small></a>
                                    </th>
                                    <th class="fw-normal text-capitalize">{{ $item->agenda_author }}</th>
                                    <th>
                                        <a href="#"
                                            onclick="askBeforeExecution('Anda Yakin Ingin Hapus Agenda ?',()=>{window.location.href = '/api/admin/hapusAgenda/{{ $item->agenda_id }}'})"
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
    <div class="modal fade" id="modalAgenda" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Agenda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/api/admin/tambahAgenda" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="judulAgenda" class="form-label">Judul Agenda</label>
                            <input type="text" class="form-control" id="judulAgenda" placeholder="Judul Agenda"
                                name="judulAgenda">
                        </div>
                        <div class="mb-3">

                        </div>
                        <div class="mb-3">
                            <label for="agendaMulai" class="form-label">Agenda Mulai</label>
                            <input type="date" class="form-control" id="agendaMulai" placeholder="Agenda Mulai"
                                name="agendaMulai">
                        </div>
                        <div class="mb-3">
                            <label for="agendaSelesai" class="form-label">Agenda Selesai</label>
                            <input type="date" class="form-control" id="agendaSelesai" placeholder="Agenda Selesai"
                                name="agendaSelesai">
                        </div>
                        <div class="mb-3">
                            <label for="agendaTempat" class="form-label">Agenda Tempat</label>
                            <input type="text" class="form-control" id="agendaTempat" placeholder="Agenda Tempat"
                                name="agendaTempat">
                        </div>
                        <div class="mb-3">
                            <label for="agendaWaktu" class="form-label">Agenda Waktu</label>
                            <input type="text" class="form-control" id="agendaWaktu" name="agendaWaktu"
                                placeholder="09.00 - 10.00 WIB">
                        </div>
                        <input type="text" hidden name="quill-html-isiAgenda" id="quill-html-isiAgenda">
                        <input type="text" hidden name="quill-html-agendaKeterangan" id="quill-html-agendaKeterangan">
                        <input type="text" hidden name="emailAuthor"
                            value="{{ $profile['profile']['detail']['email'] }}">
                        <input type="text" hidden name="nameAuthor"
                            value="{{ $profile['profile']['detail']['name'] }}">

                        <div class="mb-3">
                            <label for="isiAgenda" class="form-label">Isi Agenda</label>
                            <div id="isiAgenda" class="mb-3">

                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="agendaKeterangan" class="form-label">Agenda Keterangan</label>
                            <div id="agendaKeterangan" class="mb-3">

                            </div>
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
