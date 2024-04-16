@extends('Template.TemplateDocument')
@section('content')
    <div class="container">
        <div class="vh-100 d-flex justify-content-center align-items-center">

            <div class="card mb-3 shadow-lg">
                <div class="row g-0">
                    <div class="col-md-4 d-flex align-items-center">
                        <img src="{{ url('assets/images/login.svg') }}" class="img-fluid rounded-start"
                            alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title text-center">Registration Page</h5>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="FormName"
                                    placeholder="Your Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Jenis
                                    Kelamin</label>
                                <select class="form-select" aria-label="Default select example"
                                    id="FormGender">
                                    <option value="" selected>Pilih Jenis Kelamin</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Agama</label>
                                <select class="form-select" aria-label="Default select example"
                                    id="FormReligion">
                                    <option value="" selected>Pilih Agama</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Konghucu">Konghucu</option>
                                    <option value="Hindu">Hindu</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nomor
                                    Telepon</label>
                                <input type="number" class="form-control" id="FormPhone"
                                    placeholder="Your Phone" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1"
                                    class="form-label">Alamat</label>
                                <textarea class="form-control" id="FormAddress" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Email</label>
                                <input type="email" class="form-control" id="FormEmail"
                                    placeholder="Your Email" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1"
                                    class="form-label">Password</label>
                                <input type="password" class="form-control" id="FormPassword"
                                    placeholder="Your Password" required>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary"
                                    onclick="ProcessRegister()">Registrasi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
