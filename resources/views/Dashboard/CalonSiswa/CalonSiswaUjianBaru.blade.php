@extends('Template.TemplateDocument')
@section('content')
    @include('Dashboard.CalonSiswa.Components.NavbarComponent', [
        'statusKelulusan' => $datas['statusKelulusan'],
        'active' => 'dashboard',
    ])
    <div class="container">
        <form action="/api/calon_siswa/ujian/{{ $datas['ujianID'] }}" method="POST">
            @csrf
            @php
                $no = 1;
            @endphp
            @foreach ($datas['soal'] as $soal)
                <div class="soal-{{ $no }}">
                    <div class="input-group p-3">
                        <span class="input-group-text">Soal: {{ $no }}</span>
                        <textarea class="form-control" aria-label="With textarea" name="Soal[{{ $no }}]">{{ $soal['soal'] }}</textarea>
                    </div>

                </div>
                <div class="jawaban-{{ $no }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="jawab-a">
                                <div class="form-check mb-3 p-3">
                                    <input class="form-check-input jawaban-radio mx-2" type="radio"
                                        value="{{ json_encode(['a' => $soal['jawaban_a']]) }}"
                                        id="flexCheckDefault" name="Jawaban[{{ $no }}]">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $soal['jawaban_a'] }}
                                    </label>
                                </div>
                            </div>
                            <div class="jawab-b">
                                <div class="form-check mb-3 p-3">
                                    <input class="form-check-input jawaban-radio mx-2" type="radio"
                                        value="{{ json_encode(['b' => $soal['jawaban_b']]) }}"
                                        id="flexCheckDefault" name="Jawaban[{{ $no }}]">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $soal['jawaban_b'] }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="jawab-c">
                                <div class="form-check mb-3 p-3">
                                    <input class="form-check-input jawaban-radio mx-2" type="radio"
                                        value="{{ json_encode(['a' => $soal['jawaban_c']]) }}"
                                        id="flexCheckDefault" name="Jawaban[{{ $no }}]">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $soal['jawaban_c'] }}
                                    </label>
                                </div>
                            </div>
                            <div class="jawab-d">
                                <div class="form-check mb-3 p-3">
                                    <input class="form-check-input jawaban-radio mx-2" type="radio"
                                        value="{{ json_encode(['d' => $soal['jawaban_d']]) }}"
                                        id="flexCheckDefault" name="Jawaban[{{ $no }}]">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $soal['jawaban_d'] }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                @php
                    $no++;
                @endphp
            @endforeach
            <div class="input-group mb-3 p-3">
                <button type="submit" class="btn btn-primary">Selesai</button>

            </div>
        </form>

    </div>
@endsection
