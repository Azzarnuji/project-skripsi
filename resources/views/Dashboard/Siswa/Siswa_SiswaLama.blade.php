@extends('Template.TemplateDocument')
@section('content')
    @include('Dashboard.Siswa.Components.NavbarComponent', ['active' => 'siswa-lama'])
    <div class="container">
        <div class="vh-100 d-flex justify-content-center align-items-center">

            <div class="card mb-3 shadow-lg">
                <div class="row g-0 py-5">
                    <div class="col-lg-5 d-flex align-items-center">
                        <img src="{{ url('assets/images/login.svg') }}" class="img-fluid rounded-start"
                            alt="...">
                    </div>
                    <div class="col-lg-7">
                        <form action="#" method="POST" id="formPendaftaranSiswaLama"
                            onsubmit="return false">
                            <div class="card-body">
                                <h5 class="card-title text-center">Pendaftaran Siswa Lama
                                    <span>

                                        <div class="spinner-border spinner-border-sm" role="status"
                                            id="loading" style="visibility: hidden;">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </span>
                                </h5>
                                <div id="pendaftaranSiswaLama">

                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">NIS
                                        </label>
                                        <input type="number" class="form-control" id="FormNIS"
                                            placeholder="Masukkan NIS Anda" required>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-3"
                                            onclick="ProcessSiswaLama(this)">Cari Data</button>

                                    </div>

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
