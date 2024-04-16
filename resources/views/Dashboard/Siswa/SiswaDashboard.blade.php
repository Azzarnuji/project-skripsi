@extends('Template.TemplateDocument')
@section('content')
    @include('Dashboard.Siswa.Components.NavbarComponent', ['active' => 'dashboard'])
    <div class="my-3">
        <div class="row" style="max-width: 100%">
            {{-- @dd($profile) --}}
            <div class="col-md-4">
                <div class="card d-flex justify-content-center align-items-center" style="border: 0px;">
                    <div class="card-body text-center">

                        <img src="/assets/foto-siswa/{{ $profile['image'] }}" class="img-fluid mb-5"
                            style="width: 140px" srcset="">

                        <div class="input-group w-100 mb-3">
                            <span class="input-group-text" id="basic-addon1" style="border: 0px">Nama
                            </span>
                            <input type="text" class="form-control form-control-plaintext p-2"
                                placeholder="Username" aria-label="Username" readonly
                                value=":{{ $profile['name'] }}" aria-describedby="basic-addon1">
                        </div>


                        <div class="input-group w-100 mb-3">
                            <span class="input-group-text" id="basic-addon1" style="border: 0px">Alamat
                            </span>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $profile['address'] }}</textarea>
                        </div>
                        <div class="input-group w-100 mb-3">
                            <span class="input-group-text" id="basic-addon1" style="border: 0px">Telepon
                            </span>
                            <input type="text" class="form-control form-control-plaintext p-2"
                                placeholder="Username" aria-label="Username" readonly
                                value=":{{ $profile['phone'] }}" aria-describedby="basic-addon1">
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="container">
                    <div class="card text-center">
                        <div class="card-header bg-warning">
                            Informasi
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <p class="card-text">Dibawah Ini Adalah Informasi Kelas Anda</p>
                                <div class="col-md-4">
                                    <h6 class="text-capitalize">Kelas :
                                        {{ $profile['Kelas']['DetailKelas']['kelas'] }}
                                    </h6>
                                </div>
                                <div class="col-md-4">
                                    <h6>Sub Kelas :
                                        {{ $profile['Kelas']['DetailKelas']['sub_kelas'] }}
                                    </h6>
                                </div>
                                <div class="col-md-4">
                                    <h6>Wali Kelas :
                                        {{ $profile['Kelas']['DetailKelas']['wali_kelas'] }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endSection
