<div class="offcanvas offcanvas-start offcanvas-scrollable" tabindex="-1" id="readOffcanvas"
    aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Detail Barang</h5>
        <button type="button" class="btn-close focus-ring focus-ring-light" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="d-flex justify-content-center mt-2 mb-4">
            <div class="card rounded-4">
                <img src="{{ $photo_url }}" class="img-fluid rounded-4 mx-3 mt-3" alt="" id="offcanvasImg">
                <div class="card-body">
                    <h6 class="card-title text-center">Foto Barang</h5>
                </div>
            </div>
        </div>
        <div class="mx-3">
            <div class="row justify-content-between mb-3">
                <div class="col-5 border pt-3 rounded-3">
                    <dl>
                        <dt class="mb-2">Kode</dt>
                        <dd>{{ $kode }}</dd>
                    </dl>
                </div>
                <div class="col-6 border pt-3 rounded-3">
                    <dl>
                        <dt class="mb-2">Nama</dt>
                        <dd>{{ $nama }}</dd>
                    </dl>
                </div>
            </div>
            <div class="row justify-content-between mb-3">
                <div class="col-5 border pt-3 rounded-3">
                    <dl>
                        <dt class="mb-2">Nomor Register</dt>
                        <dd>{{ $nomorRegister }}</dd>
                    </dl>
                </div>
                <div class="col-6 border pt-3 rounded-3">
                    <dl>
                        <dt class="mb-2">Merek</dt>
                        <dd>{{ $merek }}</dd>
                    </dl>
                </div>
            </div>
            <div class="row justify-content-between mb-3">
                <div class="col-5 border pt-3 rounded-3">
                    <dl>
                        <dt class="mb-2">Tipe</dt>
                        <dd>{{ $tipe }}</dd>
                    </dl>
                </div>
                <div class="col-6 border pt-3 rounded-3">
                    <dl>
                        <dt class="mb-2">Tahun Pembelian</dt>
                        <dd>{{ $tahunBeli }}</dd>
                    </dl>
                </div>
            </div>
            <div class="row justify-content-between mb-3">
                <div class="col-5 border pt-3 rounded-3">
                    <dl>
                        <dt class="mb-2">Kondisi</dt>
                        <dd>{{ $kondisi }}</dd>
                    </dl>
                </div>
                <div class="col-6 border pt-3 rounded-3">
                    <dl>
                        <dt class="mb-2">Harga</dt>
                        <dd>Rp {{ number_format($hargaDetail, 2, ',', '.') }}</dd>
                    </dl>
                </div>
            </div>
            <div class="row justify-content-between mb-3">
                <div class="col-5 border pt-3 rounded-3">
                    <dl>
                        <dt class="mb-2">Keterangan</dt>
                        <dd>{{ $keterangan }}</dd>
                    </dl>
                </div>
                <div class="col-6 border pt-3 rounded-3">
                    <dl>
                        <dt class="mb-2">Kategori</dt>
                        <dd>{{ $kategori }}</dd>
                    </dl>
                </div>
            </div>
            <div @if ($kategori != 'Kendaraan') hidden @endif>
                <div class="row justify-content-between mb-3">
                    <div class="col-5 border pt-3 rounded-3">
                        <dl>
                            <dt class="mb-2">Warna</dt>
                            <dd>{{ $warna }}</dd>
                        </dl>
                    </div>
                    <div class="col-6 border pt-3 rounded-3">
                        <dl>
                            <dt class="mb-2">Nomor Rangka</dt>
                            <dd>{{ $nomorRangka }}</dd>
                        </dl>
                    </div>
                </div>
                <div class="row justify-content-between mb-3">
                    <div class="col-5 border pt-3 rounded-3">
                        <dl>
                            <dt class="mb-2">Nomor Mesin</dt>
                            <dd>{{ $nomorMesin }}</dd>
                        </dl>
                    </div>
                    <div class="col-6 border pt-3 rounded-3">
                        <dl>
                            <dt class="mb-2">Nomor Polisi</dt>
                            <dd>{{ $nomorPolisi }}</dd>
                        </dl>
                    </div>
                </div>
                <div class="row justify-content-between mb-3">
                    <div class="col-5 border pt-3 rounded-3">
                        <dl>
                            <dt class="mb-2">Nomor BPKB</dt>
                            <dd>{{ $nomorBpkb }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between mb-3">
                <div class="col-5 border pt-3 rounded-3">
                    <dl>
                        <dt class="mb-2">Riwayat Servis</dt>
                        <dd>{{ $riwayatServis }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-2 mb-4">
            <div class="card rounded-4">
                <img src="{{ $photoPemegang_url }}" class="img-fluid rounded-4 mx-3 mt-3" alt=""
                    id="offcanvasImg">
                <div class="card-body">
                    <h6 class="card-title text-center">Foto Pemegang</h5>
                </div>
            </div>
        </div>
    </div>
</div>
