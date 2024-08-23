<div class="offcanvas offcanvas-start offcanvas-scrollable" tabindex="-1" id="readOffcanvas"
    aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Detail Berita</h5>
        <button type="button" class="btn-close focus-ring focus-ring-light" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="mx-3">
            <div class="row justify-content-between mb-3">
                <div class="col">
                    <p class="mb-2"><strong>Tanggal :</strong> {{ $created_at }}</p>
                </div>
            </div>
            <div class="row justify-content-between mb-3">
                <div class="col border pt-3 rounded-3">
                    <dl>
                        <dt class="mb-2">PDF</dt>
                        @if ($pdf != null)
                            <dd><a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                    href="{{ Storage::disk('news')->url($pdf) }}"
                                    target="_blank">{{ $namaPdf }}</a>
                            </dd>
                        @else
                            <dd>Tidak Ada</dd>
                        @endif
                    </dl>
                </div>
            </div>
            <div class="row justify-content-between mb-3">
                <div class="col border pt-3 rounded-3">
                    <dl>
                        <dt class="mb-2">Judul</dt>
                        <dd>{{ $judul }}</dd>
                    </dl>
                </div>
            </div>
            <div class="row justify-content-between mb-3">
                <div class="col border pt-3 rounded-3">
                    <dl>
                        <dt class="mb-2">Keterangan</dt>
                        <dd>{{ $keterangan }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
