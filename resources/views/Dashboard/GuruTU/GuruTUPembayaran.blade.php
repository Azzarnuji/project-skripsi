@extends('Template.TemplateDocument')
@section('content')
    @include('Dashboard.GuruTU.Components.NavbarComponent', ['active' => 'pembayaran'])
    <div class="my-3">
        <div class="row" style="max-width: 100%">
            <div class="col-md-6">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">

                                <div class="col-md-6">

                                    <h5><span id="statusPembayaran"
                                            class="text-capitalize">Pending</span> Pembayaran</h5>
                                    <div class="spinner-border spinner-border-sm visually-hidden"
                                        role="status" id="loaderFilter">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select" aria-label="Filter By" id="filterBy">
                                        <option value="" selected>Filter By</option>
                                        <option value="pending">Pending</option>
                                        <option value="lunas">Lunas</option>
                                        <option value="tolak">Ditolak</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <hr>
                            <div class="table-responsive" id="parentPPDBTable">
                                <table class="table p-2" id="PPDBTable">
                                    <thead>
                                        <tr class="bg-warning">
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Nama Pembayaran</th>
                                            <th scope="col">No Telepon</th>
                                            <th scope="col">Jumlah Bayar</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datas['listPendingPembayaran'] as $data)
                                            <tr>
                                                <th scope="row">{{ $no++ }}</th>
                                                <td>{{ $data['UsersTable']['detail']['name'] }}</td>
                                                <td>{{ $data['UsersTable']['detail']['email'] }}</td>
                                                <td>{{ $data['PembayaranTable']['nama_pembayaran'] }}
                                                </td>
                                                <td>{{ $data['UsersTable']['detail']['phone'] }}</td>
                                                <td>RP.{{ \App\Helpers\Utils::currency($data['PembayaranTable']['nominal']) }}
                                                </td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-primary btn-sm"
                                                        data-bs-iduser="{{ $data['UsersTable']['email'] }}"
                                                        data-bs-idPembayaran="{{ $data['PembayaranTable']['pembayaran_id'] }}"
                                                        onclick="BtnDetailPayment(this)">Detail</button>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="card bg-warning mb-3 text-white"
                                        style="max-width: 18rem;">

                                        <div class="card-body">
                                            <h5 class="card-title text-center">Masuk Uang Pending</h5>
                                            <p class="card-text fs-5 text-center">
                                                Rp.{{ \App\Helpers\Utils::currency($datas['uangPending']) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-success mb-3 text-white"
                                        style="max-width: 18rem;">

                                        <div class="card-body">
                                            <h5 class="card-title text-center">Pemasukan Uang Lunas</h5>
                                            <p class="card-text fs-5 text-center">
                                                Rp.{{ \App\Helpers\Utils::currency($datas['uangLunas']) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-danger mb-3 text-white"
                                        style="max-width: 18rem;">

                                        <div class="card-body">
                                            <h5 class="card-title text-center">Masuk Uang Ditolak</h5>
                                            <p class="card-text fs-5 text-center">
                                                RP.{{ \App\Helpers\Utils::currency($datas['uangTolak']) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="container">
                    <div id="loader">
                        <button class="btn btn-danger visually-hidden" type="button" id="btnLoader">
                            <span class="spinner-border spinner-border-sm" role="status"
                                aria-hidden="true"></span>
                            Loading...
                        </button>
                    </div>
                    <div id="DetailPayment">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="fullscreen-container">
        <span id="exit-fullscreen" onclick="exitFullScreen()">X</span>
        <img src="your-image-url.jpg" alt="Fullscreen Image" id="fullscreen-image">
    </div>
@endsection
