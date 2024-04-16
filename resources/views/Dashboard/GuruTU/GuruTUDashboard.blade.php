@extends('Template.TemplateDocument')
@section('content')
    @include('Dashboard.GuruTU.Components.NavbarComponent', ['active' => 'dashboard'])
    <div class="my-3">
        <div class="row" style="max-width: 100%">
            <div class="col-md-4">
                <div class="card d-flex justify-content-center align-items-center" style="border: 0px;">
                    <div class="card-body text-center">

                        <img src="https://th.bing.com/th/id/R.3acddd96809373e254a8e6a0b5939754?rik=CfHBzmOotm%2fhog&riu=http%3a%2f%2fwww.pngall.com%2fwp-content%2fuploads%2f5%2fUser-Profile-PNG-Free-Download.png&ehk=Y4PdD7AE%2fHJpnZsPko97b8LANnHWtZJ1GIfmuNyuY2M%3d&risl=&pid=ImgRaw&r=0"
                            class="img-fluid mb-5" style="width: 140px" srcset="">

                        <div class="input-group w-100 mb-3">
                            <span class="input-group-text" id="basic-addon1" style="border: 0px">Nama
                            </span>
                            <input type="text" class="form-control form-control-plaintext p-2" placeholder="Username"
                                aria-label="Username" readonly value=":{{ $profile['nama_guru'] }}"
                                aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group w-100 mb-3">
                            <span class="input-group-text" id="basic-addon1" style="border: 0px">Status
                            </span>
                            <input type="text" class="form-control form-control-plaintext text-uppercase p-2"
                                placeholder="Username" aria-label="Username" readonly
                                value=":{{ \App\Helpers\Utils::removeSpecialChar($profile['status_guru']) }}"
                                aria-describedby="basic-addon1">
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Pending Pembayaran</h5>
                            <p class="fw-light text-muted">Show Only 5 Data, Informasi Selengkapnya
                                Pilih Menu Pembayaran
                            </p>
                            <hr>
                            <div class="table-responsive">

                                <table class="table">
                                    <thead>
                                        <tr class="bg-warning">
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">No Telepon</th>
                                            <th scope="col">Jumlah Bayar</th>

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
                                                <td>{{ $data['UsersTable']['detail']['phone'] }}</td>
                                                <td>RP.{{ \App\Helpers\Utils::currency($data['PembayaranTable']['nominal']) }}
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>



                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Informasi Pembayaran</h5>
                            <hr>
                        </div>
                        <div class="col-sm-4">
                            <div class="card bg-warning mb-3 text-white" style="max-width: 18rem;">

                                <div class="card-body">
                                    <h5 class="card-title text-center">Pending Pembayaran</h5>
                                    <p class="card-text fs-1 text-center">
                                        {{ $datas['pendingPembayaranCount'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card bg-success mb-3 text-white" style="max-width: 18rem;">

                                <div class="card-body">
                                    <h5 class="card-title text-center">Lunas Pembayaran</h5>
                                    <p class="card-text fs-1 text-center">
                                        {{ $datas['lunasPembayaranCount'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
