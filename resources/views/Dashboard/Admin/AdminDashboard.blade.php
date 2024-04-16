@extends('Template.TemplateDocument')
@section('content')
    @include('Dashboard.Admin.Components.NavbarComponent', ['active' => 'dashboard'])
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
                            <input type="text" class="form-control form-control-plaintext p-2"
                                placeholder="Username" aria-label="Username" readonly
                                value=":{{ $profile['profile']['detail']['name'] }}"
                                aria-describedby="basic-addon1">
                        </div>


                        <div class="input-group w-100 mb-3">
                            <span class="input-group-text" id="basic-addon1" style="border: 0px">Alamat
                            </span>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $profile['profile']['detail']['address'] }}</textarea>
                        </div>
                        <div class="input-group w-100 mb-3">
                            <span class="input-group-text" id="basic-addon1" style="border: 0px">Telepon
                            </span>
                            <input type="text" class="form-control form-control-plaintext p-2"
                                placeholder="Username" aria-label="Username" readonly
                                value=":{{ $profile['profile']['detail']['phone'] }}"
                                aria-describedby="basic-addon1">
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="container">


                    <div class="row">
                        <div class="col-sm-12">

                            <h5>Summary Data</h5>
                            <hr>
                        </div>
                        <div class="col-sm-4">
                            <div class="card bg-success mb-3 text-white" style="max-width: 18rem;">

                                <div class="card-body">
                                    <h5 class="card-title text-center">Jumlah Calon Siswa</h5>
                                    <p class="card-text fs-1 text-center">
                                        {{ $datas['jumlahCalonSiswa'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card bg-success mb-3 text-white" style="max-width: 18rem;">

                                <div class="card-body">
                                    <h5 class="card-title text-center">Jumlah Guru</h5>
                                    <p class="card-text fs-1 text-center">{{ $datas['jumlahGuru'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card bg-success mb-3 text-white" style="max-width: 18rem;">

                                <div class="card-body">
                                    <h5 class="card-title text-center">Jumlah Siswa Aktif</h5>
                                    <p class="card-text fs-1 text-center">
                                        {{ $datas['jumlahSiswaAktif'] }}</p>
                                </div>
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
                                        {{ $datas['pendingPembayaran'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card bg-success mb-3 text-white" style="max-width: 18rem;">

                                <div class="card-body">
                                    <h5 class="card-title text-center">Lunas Pembayaran</h5>
                                    <p class="card-text fs-1 text-center">
                                        {{ $datas['lunasPembayaran'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
