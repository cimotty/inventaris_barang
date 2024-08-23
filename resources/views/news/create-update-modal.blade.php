<div wire:ignore.self class="modal fade" id="form" data-bs-backdrop="static" tabindex="-1" aria-labelledby="form"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="" wire:submit.prevent="{{ $showUpdateModal ? 'updatePost' : 'createPost' }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        @if ($showUpdateModal)
                            <span>Ubah Berita</span>
                        @else
                            <span>Tambah Berita</span>
                        @endif
                    </h1>
                    <button type="button" class="btn-close focus-ring focus-ring-light" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6 mb-4">
                            <label for="pdf" class="form-label ms-1">PDF</label>
                            <div class="input-group input-group-sm">
                                <input wire:model="pdf" name="pdf" type="file"
                                    class="form-control focus-ring focus-ring-light border rounded-2 @error('pdf') is-invalid @enderror"
                                    id="pdf{{ $iteration }}" value="{{ $pdf }}">
                                @error('pdf')
                                    <div class="invalid-feedback ms-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-text ms-1" id="basic-addon4">
                                <span class="text-danger">*</span>
                                Maksimal ukuran file : 10 MB
                            </div>
                        </div>
                        <div class="col-sm-6 mb-4">
                            <label for="namaPdf" class="form-label ms-1">Nama PDF</label>
                            <div class="input-group input-group-sm">
                                <input wire:model.lazy="namaPdf" name="namaPdf" type="text"
                                    class="form-control focus-ring focus-ring-light border rounded-2 @error('namaPdf')) is-invalid @enderror"
                                    id="namaPdf" placeholder="Nama PDF">
                                @error('namaPdf')
                                    <div class="invalid-feedback ms-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-4">
                            <label for="judul" class="form-label ms-1">Judul</label>
                            <div class="input-group input-group-sm">
                                <input wire:model.lazy="judul" name="judul" type="text"
                                    class="form-control focus-ring focus-ring-light border rounded-2 @error('judul')) is-invalid @enderror"
                                    id="judul" placeholder="Judul">
                                @error('judul')
                                    <div class="invalid-feedback ms-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
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
