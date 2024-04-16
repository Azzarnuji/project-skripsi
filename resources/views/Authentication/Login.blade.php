@extends('Template.TemplateDocument')
@section('page-script')
    <script src="{{ url('/assets/js/Helpers/HelpersApp.js') }}" type="module"></script>
@endsection
@section('content')
    <div class="container">
        <div class="vh-100 d-flex justify-content-center align-items-center">

            <div class="card mb-3 shadow-lg">
                <div class="row g-0 py-5">
                    <div class="col-lg-12 d-flex align-items-center">
                        <img src="{{ url('assets/images/login.svg') }}" class="img-fluid rounded-start"
                            alt="...">
                    </div>
                    <div class="col-lg-12">
                        <form action="#" method="POST" onsubmit="ProcessLogin()">
                            <div class="card-body">
                                <h5 class="card-title text-center">Login Page
                                    <span>

                                        <div class="spinner-border spinner-border-sm" role="status"
                                            id="loading" style="visibility: hidden;">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </span>
                                </h5>

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1"
                                        class="form-label">Email</label>
                                    <input type="email" class="form-control" id="FormEmail"
                                        placeholder="Your Email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1"
                                        class="form-label">Password</label>
                                    <input type="password" class="form-control" id="FormPassword"
                                        placeholder="Your Password" required>
                                </div>
                                <div class="d-flex justify-content-center">

                                    <button type="submit" class="btn btn-primary me-3"
                                        onclick="ProcessLogin(this)">Login</button>
                                    <a href="{{ url('registrasi') }}"
                                        class="btn btn-danger">Registrasi</a>

                                </div>
                            </div>
                            {{-- <span class="mx-3">
                                Lupa Password ? <a href="{{ url('forgot-password') }}"
                                    class="">Klik
                                    Disini</a>

                            </span>
                            <div class="">

                                <span class="mx-3">
                                    Anda Siswa Lama ? <a href="{{ url('siswa/siswaLama') }}"
                                        class="">Daftar
                                        Disini</a>

                                </span>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
