@extends('Template.TemplateDocument')
@section('content')
    @include('Dashboard.Siswa.Components.NavbarComponent', ['active' => 'pembayaran'])
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
                <div class="row">

                    <div class="col-md-12">

                        <div class="container">
                            <div class="table-responsive">
                                <h5>Daftar Pembayaran</h5>
                                <table class="table" id="daftarPembayaranSiswa">
                                    <thead class="bg-warning">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pembayaran</th>
                                            <th>Nominal Harus Dibayar</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datas['listWajibBayar'] as $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $data['PembayaranTable']->nama_pembayaran }}</td>
                                                <td>
                                                    RP.{{ App\Helpers\Utils::currency($data['PembayaranTable']->nominal) }}
                                                </td>
                                                <td class="text-capitalize">
                                                    {{ App\Helpers\Utils::removeSpecialChar($data->status) }}
                                                </td>
                                                <td>
                                                    @if ($data->status == 'belum_bayar')
                                                        <button class="btn btn-primary" type="button"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#bayarModal"
                                                            data-bs-email="{{ $data->email }}"
                                                            data-bs-idpembayaran="{{ $data->payment_id }}"
                                                            data-bs-nominal="{{ $data['PembayaranTable']->nominal }}">Bayar</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="container">

                    <hr class="my-5">
                </div>
                <div class="row">

                    <div class="col-md-12">

                        <div class="container">
                            <div class="table-responsive">
                                <h5>History Pembayaran</h5>
                                <table class="table" id="historyPembayaranSiswa">
                                    <thead class="bg-success">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pembayaran</th>
                                            <th>Nominal Harus Dibayar</th>
                                            <th>Status</th>
                                            <th>Ditagih Pada</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datas['historyPembayaran'] as $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $data['PembayaranTable']->nama_pembayaran }}
                                                </td>
                                                <td>
                                                    RP.{{ App\Helpers\Utils::currency($data['PembayaranTable']->nominal) }}
                                                </td>
                                                <td
                                                    class="text-capitalize {{ $data->status == 'pending' ? 'text-danger fw-bold' : '' }}">
                                                    {{ App\Helpers\Utils::removeSpecialChar($data->status) }}
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($data->created_at)->timezone('Asia/Jakarta') }}
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
        </div>

    </div>
    <div class="modal fade" id="bayarModal" tabindex="-1" aria-labelledby="bayarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bayarModalLabel">Bayar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @foreach ($datas['metodePembayaran'] as $mp)
                        <div class="card" style="width: 20rem;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $mp->nama_bank }}</h5>
                                <p class="card-text">Transfer Ke Rekening Berikut.</p>
                                <p class="card-text">{{ $mp->nomor_rekening }} A/N
                                    {{ $mp->nama_pemilik }}</p>
                                <p class="card-text"><span class="text-danger fw-bold">Jumlah Harus
                                        Dibayar: <span id="nominalText"></span></span>
                                </p>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    <form action="/api/siswa/bayar" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">ID Pembayaran:</label>
                            <input type="text" class="form-control" id="idPembayaran"
                                name="IDPembayaran" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="text" class="form-control" id="email" name="Email"
                                readonly>
                        </div>

                        <div class="mb-3">
                            <label for="rekeningAsal" class="form-label">Rekening
                                Asal</label>
                            <input type="number" class="form-control" id="rekeningAsal"
                                placeholder="Rekening Asal" name="RekeningAsal" required>
                        </div>
                        <div class="mb-3">
                            <label for="namaPemilikRekeningAsal" class="form-label">Nama Pemilik
                                Rekening</label>
                            <input type="text" class="form-control" id="namaPemilikRekeningAsal"
                                placeholder="Nama Pemilik Rekening" name="NamaPemilikRekeningAsal"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Bukti Pembayaran</label>
                            <input class="form-control" type="file" id="BuktiPembayaran"
                                name="BuktiPembayaran" required>
                            <p class="text-danger fw-light">
                                jpg / jpeg / png
                            </p>
                        </div>
                        <button type="submit" class="btn btn-primary">Bayar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endSection
