<div class="card bg-danger my-auto mb-3 text-center text-white"
    style="max-width: 100%; max-height: 100%">
    <div class="card-header">Pemberitahuan</div>
    <div class="card-body">
        <h5 class="card-title">Anda Belum Membayar Biaya Pendaftaran</h5>
        <p class="card-text">Silahkan Melakukan Penulasan Biaya Pendaftaran</p>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#pembayaranModal">Bayar
            Sekarang</button>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="pembayaranModal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="pembayaranModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pembayaranModalLabel">Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @foreach ($metodePembayaran as $mp)
                    <div class="card" style="width: 20rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $mp->nama_bank }}</h5>
                            <p class="card-text">Transfer Ke Rekening Berikut.</p>
                            <p class="card-text">{{ $mp->nomor_rekening }} A/N
                                {{ $mp->nama_pemilik }}</p>
                            <p class="card-text">Jumlah Transfer :
                                RP.{{ \App\Helpers\Utils::currency($biayaDaftarBaru['nominal']) }}
                            </p>
                        </div>
                    </div>
                    <hr>
                @endforeach
                <form action="/api/pembayaran/bayarPendaftaran" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $profile['profile']['detail']['email'] }}"
                        name="Email">
                    <input type="hidden" value="{{ $biayaDaftarBaru['pembayaran_id'] }}"
                        name="PembayaranID">
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
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
