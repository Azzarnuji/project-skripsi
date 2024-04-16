@extends('Template.TemplateDocument')
@section('content')
    @include('Dashboard.GuruTU.Components.NavbarComponent', ['active' => 'ppdb'])
    <div class="my-3">
        <div class="row" style="max-width: 100%">
            <div class="col-md-12">
                <div class="container">
                    <h5>Daftar List PPDB</h5>

                    <hr>
                    <div class="table-responsive" id="parentPPDBTable">
                        <table class="table p-2" id="PPDBTable">
                            <thead>
                                <tr class="bg-warning">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">No Telepon</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($datas['listPPDB'] as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data['DetailUser']['name'] }}</td>
                                        <td>{{ $data['DetailUser']['email'] }}</td>
                                        <td>{{ $data['DetailUser']['phone'] }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm"
                                                data-bs-email="{{ $data['DetailUser']['email'] }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalPPDBDetail">Detail</button>
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
    <div class="modal fade" id="modalPPDBDetail" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail PPDB Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" id="DetailPPDBData">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <div id="fullscreen-container">
        <span id="exit-fullscreen" onclick="exitFullScreen()">X</span>
        <img src="your-image-url.jpg" alt="Fullscreen Image" id="fullscreen-image">
    </div>
@endsection
