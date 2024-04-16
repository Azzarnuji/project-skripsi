@extends('Template.TemplateDocument')
@section('content')
    @include('Dashboard.CalonSiswa.Components.NavbarComponent', [
        'statusKelulusan' => $datas['statusKelulusan'],
        'active' => 'dashboard',
    ])

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
            <div class="col-sm-8">

                @if (!isset($statusPembayaran))
                    @include('Dashboard.CalonSiswa.CalonSiswaBelumBayar', [
                        'metodePembayaran' => $datas['listMetodePembayaran'],
                        'biayaDaftarBaru' => $datas['biayaDaftarBaru'],
                    ])
                @else
                    <div class="row d-flex flex-column gy-5">
                        <div class="col-md-12">
                            <div class="billing">
                                <h5>Status Pembayaran</h5>
                                <table class="table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Tipe Pembayaran</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datas['statusPembayaran'] as $data)
                                            <tr>
                                                <th scope="row">{{ $no++ }}</th>
                                                <td>{{ $data['PembayaranTable']['nama_pembayaran'] }}
                                                </td>
                                                <td>RP.{{ \App\Helpers\Utils::currency($data['PembayaranTable']['nominal']) }}
                                                </td>
                                                <td>
                                                    {!! \App\Helpers\Utils::generateButtonStatus($data['status']) !!}
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="alert alert-warning" role="alert">
                                    Jika Pembayaran Ditolak, Silahkan Hubungi Pihak Sekolah
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="ujian">
                                <span>

                                    <h5>Jadwal Ujian</h5>
                                </span>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Pelajaran/Tipe</th>
                                            <th scope="col">Jumlah Soal</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datas['listUjian'] as $data)
                                            <tr>
                                                <th scope="row">{{ $no++ }}</th>
                                                <td>{{ $data['BankUjian']['nama_ujian'] }}</td>
                                                <td>{{ $data['BankUjian']['jumlah_soal'] }}</td>
                                                <td>
                                                    @if ($data['status_ujian'] == 'pending')
                                                        <a href="/calon_siswa/ujian/{{ $data['ujian_id'] }}"
                                                            class="btn btn-sm btn-primary">Mulai</a>
                                                    @else
                                                        <a href="/calon_siswa/hasilUjian/{{ $data['ujian_id'] }}"
                                                            class="btn btn-sm btn-success">Lihat
                                                            Hasil</a>
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if ($datas['statusKelulusan'] == \App\Data\StatusKelulusan::TIDAK_LULUS)
                            <div class="col-md-12">
                                <div class="alert alert-danger" role="alert">
                                    Maaf Anda Tidak Lulus Ujian, Silahkan Hubungi Pihak Sekolah
                                </div>
                            </div>
                        @elseif ($datas['statusKelulusan'] == \App\Data\StatusKelulusan::LULUS_UJIAN)
                            <div class="col-md-12">
                                <div class="alert alert-primary" role="alert">
                                    Selamat Anda Lulus Ujian, Silahkan Pilih Menu PPDB Untuk Melengkapi
                                    Data Anda
                                </div>
                            </div>
                        @endif
                    </div>
                @endif


            </div>
        </div>

    </div>
@endsection
