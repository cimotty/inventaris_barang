<div wire:ignore.self class="modal fade" id="form" data-bs-backdrop="static" tabindex="-1" aria-labelledby="form"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="" wire:submit.prevent="{{ $showUpdateModal ? 'updateItem' : 'createItem' }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        @if ($showUpdateModal)
                            <span>Ubah Data Barang</span>
                        @else
                            <span>Tambah Data Barang</span>
                        @endif
                    </h1>
                    <button type="button" class="btn-close focus-ring focus-ring-light" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-sm">
                            <label for="foto" class="form-label ms-1">Foto</label>
                            @if ($showUpdateModal)
                                @if ($foto && in_array(strtolower($foto->getClientOriginalExtension()), ['jpg', 'jpeg', 'png', 'gif']))
                                    <img src="{{ $foto->temporaryUrl() }}" class="rounded mx-auto d-block mb-3"
                                        style="width: 150px; height: 150px; object-fit: cover;" alt="">
                                @else
                                    <img src="{{ $state['photo_url'] ?? '' }}" class="rounded mx-auto d-block mb-3"
                                        style="width: 150px; height: 150px; object-fit: cover;" alt="">
                                @endif
                            @else
                                @if ($foto && in_array(strtolower($foto->getClientOriginalExtension()), ['jpg', 'jpeg', 'png', 'gif']))
                                    <img src="{{ $foto->temporaryUrl() }}" class="rounded mx-auto d-block mb-3"
                                        style="width: 150px; height: 150px; object-fit: cover;" alt="">
                                @endif
                            @endif
                            <div class="input-group input-group-sm">
                                <input wire:model="foto" name="foto" type="file"
                                    class="form-control focus-ring focus-ring-light border rounded-2 @error('foto') is-invalid @enderror"
                                    id="foto{{ $iteration }}">
                                @error('foto')
                                    <div class="invalid-feedback ms-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-text ms-1" id="basic-addon4">
                                <span class="text-danger">*</span>
                                Maksimal ukuran foto : 2 MB
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-4">
                            <label for="kode" class="form-label ms-1">Kode</label>
                            <div class="input-group input-group-sm">
                                <input wire:model.lazy="kode" name="kode" type="text"
                                    class="form-control focus-ring focus-ring-light border rounded-2 @error('kode')) is-invalid @enderror"
                                    id="kode" placeholder="Kode">
                                @error('kode')
                                    <div class="invalid-feedback ms-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 mb-4">
                            <label for="nama" class="form-label ms-1">Nama</label>
                            <div class="input-group input-group-sm">
                                <input wire:model.lazy="nama" name="nama" type="text"
                                    class="form-control focus-ring focus-ring-light border rounded-2 @error('nama') is-invalid @enderror"
                                    id="nama" placeholder="Nama">
                                @error('nama')
                                    <div class="invalid-feedback ms-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-4">
                            <label for="nomorRegister" class="form-label ms-1">Nomor Register</label>
                            <div class="input-group input-group-sm">
                                <input wire:model.lazy="nomorRegister" name="nomorRegister" type="text"
                                    class="form-control focus-ring focus-ring-light border rounded-2 @error('nomorRegister') is-invalid @enderror"
                                    id="nomorRegister" placeholder="Nomor Register">
                                @error('nomorRegister')
                                    <div class="invalid-feedback ms-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 mb-4">
                            <label for="merek" class="form-label ms-1">Merek</label>
                            <div class="input-group input-group-sm">
                                <input wire:model.lazy="merek" name="merek" type="text"
                                    class="form-control focus-ring focus-ring-light border rounded-2 @error('merek') is-invalid @enderror"
                                    id="merek" placeholder="Merek">
                                @error('merek')
                                    <div class="invalid-feedback ms-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-4">
                            <label for="tipe" class="form-label ms-1">Tipe</label>
                            <div class="input-group input-group-sm">
                                <input wire:model.lazy="tipe" name="tipe" type="text"
                                    class="form-control focus-ring focus-ring-light border rounded-2 @error('tipe') is-invalid @enderror"
                                    id="tipe" placeholder="Tipe">
                                @error('tipe')
                                    <div class="invalid-feedback ms-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 mb-4">
                            <label for="tahunBeli" class="form-label ms-1">Tahun Pembelian</label>
                            <div class="input-group input-group-sm">
                                <input wire:model.lazy="tahunBeli" id="tahunBeli" name="tahunBeli" type="number"
                                    class="form-control focus-ring focus-ring-light border rounded-2 @error('tahunBeli') is-invalid @enderror"
                                    id="tahunBeli" placeholder="Tahun Pembelian">
                                @error('tahunBeli')
                                    <div class="invalid-feedback ms-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-4">
                            <label for="kondisi" class="form-label ms-1">Kondisi</label>
                            <div class="input-group input-group-sm">
                                <select wire:model.lazy="kondisi" name="kondisi"
                                    class="form-select focus-ring focus-ring-light border rounded-2 @error('kondisi') is-invalid @enderror">
                                    <option value="">Pilih</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak Ringan">Rusak Ringan</option>
                                    <option value="Rusak Berat">Rusak Berat</option>
                                </select>
                                @error('kondisi')
                                    <div class="invalid-feedback ms-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 mb-4">
                            <label for="harga" class="form-label ms-1">Harga</label>
                            <div class="input-group input-group-sm">
                                <input wire:model.lazy="harga" name="harga" type="number"
                                    class="form-control focus-ring focus-ring-light border rounded-2 @error('harga') is-invalid @enderror"
                                    id="harga" placeholder="Harga">
                                @error('harga')
                                    <div class="invalid-feedback ms-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-4">
                            <label for="keterangan" class="form-label ms-1">Keterangan</label>
                            <div class="input-group input-group-sm">
                                <input wire:model.lazy="keterangan" name="keterangan" type="text"
                                    class="form-control focus-ring focus-ring-light border rounded-2 @error('keterangan') is-invalid @enderror"
                                    id="keterangan" placeholder="Keterangan">
                                @error('keterangan')
                                    <div class="invalid-feedback ms-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 mb-4">
                            <label for="kategori" class="form-label ms-1">Kategori</label>
                            <div class="input-group input-group-sm">
                                <select wire:model.lazy="kategori" name="kategori"
                                    class="form-select focus-ring focus-ring-light border rounded-2 @error('kategori') is-invalid @enderror">
                                    <option value="">Pilih</option>
                                    <option value="Elektronik">Eletkronik</option>
                                    <option value="Furniture">Furniture</option>
                                    <option value="Kendaraan">Kendaraan</option>
                                </select>
                                @error('kategori')
                                    <div class="invalid-feedback ms-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div @if ($kategori != 'Kendaraan') hidden @endif>
                        <div class="row">
                            <div class="col-sm-6 mb-4">
                                <label for="warna" class="form-label ms-1">Warna</label>
                                <div class="input-group input-group-sm">
                                    <input wire:model.lazy="warna" name="warna" type="text"
                                        class="form-control focus-ring focus-ring-light border rounded-2 @error('warna') is-invalid @enderror"
                                        id="warna" placeholder="Warna">
                                    @error('warna')
                                        <div class="invalid-feedback ms-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6 mb-4">
                                <label for="nomorRangka" class="form-label ms-1">Nomor Rangka</label>
                                <div class="input-group input-group-sm">
                                    <input wire:model.lazy="nomorRangka" name="nomorRangka" type="text"
                                        class="form-control focus-ring focus-ring-light border rounded-2 @error('nomorRangka') is-invalid @enderror"
                                        id="nomorRangka" placeholder="Nomor Rangka">
                                    @error('nomorRangka')
                                        <div class="invalid-feedback ms-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-4">
                                <label for="nomorMesin" class="form-label ms-1">Nomor Mesin</label>
                                <div class="input-group input-group-sm">
                                    <input wire:model.lazy="nomorMesin" name="nomorMesin" type="text"
                                        class="form-control focus-ring focus-ring-light border rounded-2 @error('nomorMesin') is-invalid @enderror"
                                        id="nomorMesin" placeholder="Nomor Mesin">
                                    @error('nomorMesin')
                                        <div class="invalid-feedback ms-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6 mb-4">
                                <label for="nomorPolisi" class="form-label ms-1">Nomor Polisi</label>
                                <div class="input-group input-group-sm">
                                    <input wire:model.lazy="nomorPolisi" name="nomorPolisi" type="text"
                                        class="form-control focus-ring focus-ring-light border rounded-2 @error('nomorPolisi') is-invalid @enderror"
                                        id="nomorPolisi" placeholder="Nomor Polisi">
                                    @error('nomorPolisi')
                                        <div class="invalid-feedback ms-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-4">
                                <label for="nomorBpkb" class="form-label ms-1">Nomor BPKB</label>
                                <div class="input-group input-group-sm">
                                    <input wire:model.lazy="nomorBpkb" name="nomorBpkb" type="text"
                                        class="form-control focus-ring focus-ring-light border rounded-2 @error('nomorBpkb') is-invalid @enderror"
                                        id="nomorBpkb" placeholder="Nomor BPKB">
                                    @error('nomorBpkb')
                                        <div class="invalid-feedback ms-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-4">
                            <label for="riwayatServis" class="form-label ms-1">Riwayat Servis</label>
                            <div class="input-group input-group-sm">
                                <input wire:model.lazy="riwayatServis" name="riwayatServis" type="text"
                                    class="form-control focus-ring focus-ring-light border rounded-2 @error('riwayatServis') is-invalid @enderror"
                                    id="riwayatServis" placeholder="Riwayat Servis">
                                @error('riwayatServis')
                                    <div class="invalid-feedback ms-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 mb-4">
                            <label for="fotoPemegang" class="form-label ms-1">Foto Pemegang</label>
                            <div class="input-group input-group-sm">
                                <input wire:model="fotoPemegang" name="fotoPemegang" type="file"
                                    class="form-control focus-ring focus-ring-light border rounded-2 @error('fotoPemegang') is-invalid @enderror"
                                    id="foto{{ $iteration }}">
                                @error('fotoPemegang')
                                    <div class="invalid-feedback ms-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-text ms-1" id="basic-addon4">
                                <span class="text-danger">*</span>
                                Maksimal ukuran foto : 2 MB
                            </div>
                        </div>
                    </div>
                    <div class="d-grid d-md-flex justify-content-md-end mb-2 mt-2">
                        <button type="submit" class="btn btn-success">
                            @if ($showUpdateModal)
                                <span>Simpan perubahan</span>
                            @else
                                <span>Simpan</span>
                            @endif
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
