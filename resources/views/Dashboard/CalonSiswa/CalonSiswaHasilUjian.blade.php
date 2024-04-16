@extends('Template.TemplateDocument')
@section('content')
    @include('Dashboard.CalonSiswa.Components.NavbarComponent', [
        'statusKelulusan' => $datas['statusKelulusan'],
        'active' => 'dashboard',
    ])
    <div class="container my-3">
        <div class="card text-center">
            <div
                class="card-header {{ $datas['dataUjian']['status_kelulusan'] == \App\Data\StatusKelulusan::LULUS_UJIAN ? 'bg-success' : 'bg-danger' }} text-white">
                Hasil Ujian
            </div>
            <div class="card-body">
                <h5 class="card-title">Ujian : {{ $datas['dataUjian']['BankUjian']['nama_ujian'] }}</h5>
                <p class="card-text">
                    {!! $datas['dataUjian']['status_kelulusan'] == \App\Data\StatusKelulusan::LULUS_UJIAN
                        ? 'Selamat Anda <h3 class="text-success fw-bold">Lulus Ujian</h3> Pada Tanggal'
                        : 'Maaf Anda <h3 class="text-danger fw-bold">Tidak Lulus Ujian</h3> Pada Tanggal' !!}:
                    {{ \Carbon\Carbon::parse($datas['dataUjian']['updated_at'])->toDateString() }}</p>
                <div class="row mb-3 mt-5">
                    <div class="col-md-4">
                        <h4>Nilai : {{ $datas['dataUjian']['nilai_ujian'] }}</h4>
                    </div>
                    <div class="col-md-4">
                        <h4>Jumlah Soal : {{ $datas['dataUjian']['BankUjian']['jumlah_soal'] }}</h4>
                    </div>
                    <div class="col-md-4">
                        <h4>Jawaban Benar : {{ $datas['dataUjian']['jawaban_benar'] }}</h4>
                    </div>
                </div>
                @if ($datas['dataUjian']['status_kelulusan'] == \App\Data\StatusKelulusan::LULUS_UJIAN)
                    <p class="card-text">Silahkan Melengkapi Data PPDB Anda Dengan Link Di Bawah Ini</p>
                    <a href="/calon_siswa/ppdb" class="btn btn-primary">Lengkapi Data</a>
                @endif
            </div>
        </div>
    </div>
@overwrite
