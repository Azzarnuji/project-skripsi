@extends('Template.TemplateDocument')
@section('content')
    <div class="container">
        <div class="vh-100 d-flex justify-content-center align-items-center">
            <div class="card mb-3 shadow-lg">
                <div class="row g-0 py-5">
                    <div class="col-lg-5 d-flex align-items-center">
                        <img src="{{ url('assets/images/login.svg') }}" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-lg-7">
                        <div class="card-body">
                            <h5 class="card-title text-center">Lupa Password
                                <span>

                                    <div class="spinner-border spinner-border-sm" role="status" id="loading"
                                        style="visibility: hidden;">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </span>
                            </h5>
                            <div id="forgotPasswordParent">
                                {{-- <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Masukkan Password Baru Anda
                                    </label>
                                    <input type="number" class="form-control" id="FormNewPassword"
                                        placeholder="Masukkan Password Baru Anda" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Confirm Password Baru Anda
                                    </label>
                                    <input type="number" class="form-control" id="FormConfirmPassword"
                                        placeholder="Konfirmasi Password Baru Anda" required>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-3"
                                        onclick="SaveNewPassword(this)">Simpan</button>

                                </div> --}}
                                {{-- <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Kode OTP
                                    </label>
                                    <input type="number" class="form-control" id="FormOTP" placeholder="Masukkan OTP"
                                        required>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-3"
                                        onclick="VerifyOTP(this)">Kirim</button>

                                </div> --}}
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Email
                                    </label>
                                    <input type="email" class="form-control" id="FormEmailForgot"
                                        placeholder="Masukkan Email Anda" required>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-3"
                                        onclick="ForgotPassword(this)">Dapatkan OTP</button>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
