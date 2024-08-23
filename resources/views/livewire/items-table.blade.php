<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="bg-white border rounded-4 px-4 py-4">
                <div class="row">
                    <div class="col-6">
                        <h5>Total Barang : {{ $totalBarang }} Barang (Rp
                            {{ number_format($totalAsset, 2, ',', '.') }})</h5>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <a href="/export-report" class="link-underline link-underline-opacity-0">
                            <div class="d-grid d-md-flex">
                                <button type="button"
                                    class="btn btn-sm btn-outline-dark fw-medium rounded-3 p-2 mb-2 mb-md-0 ms-0 ms-md-2">
                                    <span>Export Laporan</span>
                                </button>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row d-flex justify-content-center mt-4 mb-1">
                    <div class="col-sm-3 border rounded-3 text-center mx-3 py-3">Total Barang
                        <strong>Kondisi Baik</strong> :
                        <strong>{{ $totalBaik }}</strong>
                    </div>
                    <div class="col-sm-3 border rounded-3 text-center mx-3 py-3">Total Barang
                        <strong>Kondisi Rusak Ringan</strong> :
                        <strong>{{ $totalRusakRingan }}</strong>
                    </div>
                    <div class="col-sm-3 border rounded-3 text-center mx-3 py-3">Total Barang
                        <strong>Kondisi Rusak Berat</strong> :
                        <strong>{{ $totalRusakBerat }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="bg-white border rounded-4">

                {{-- Alert QR Info --}}
                <div class="mx-3 mt-4 mb-3">
                    @if (Queue::size() > 0)
                        <div class="alert alert-primary fade show" role="alert">
                            <i class="fa-solid fa-spinner fa-spin-pulse me-2"></i><strong>Mohon tunggu!</strong>
                            Kode QR sedang diproses, silahkan refresh halaman ini secara berkala.
                        </div>
                    @endif
                </div>

                {{-- Alert Error --}}
                <div class="mx-3 mt-4 mb-3">
                    @include('partials.alert-error')
                </div>

                <div class="row align-items-center mx-3 mt-4 mb-3">
                    <div class="col-md-3 mb-2 mb-md-0">
                        <div class="input-group input-group-sm">
                            <input wire:model.debounce.500ms="search"
                                class="form-control focus-ring focus-ring-light border rounded-3 p-2" type="text"
                                placeholder="Cari barang...">
                        </div>
                    </div>
                    <div class="col-md-1 mb-2 mb-md-0">
                        <select wire:model.lazy="perPage"
                            class="form-select form-select-sm focus-ring focus-ring-light border rounded-3 p-2">
                            <option value="25" class="">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="250">250</option>
                            <option value="500">500</option>
                        </select>
                    </div>
                    <div class="dropdown-center d-grid col-md-1 mb-2 mb-md-0 me-md-5 me-lg-5 me-xl-4">
                        <button class="btn btn-sm btn-light border dropdown-toggle rounded-3 p-2" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false"
                            @if (empty($selectedRows)) disabled @endif>
                            Aksi Massal
                        </button>
                        <ul class="dropdown-menu">
                            <li><a wire:click.prevent="confirmDeleteSelectedRows" class="dropdown-item"
                                    href="#">Hapus</a></li>
                        </ul>
                    </div>
                    <div class="d-grid d-md-flex justify-content-md-end col-md">
                        @if ($items->count() > 0 && Queue::size() === 0)
                            <a href="/export-qr" class="link-underline link-underline-opacity-0">
                                <div class="d-grid d-md-flex">
                                    <button type="button"
                                        class="btn btn-sm btn-outline-dark fw-medium rounded-3 p-2 mb-2 mb-md-0 ms-0 ms-md-2">
                                        <span>Export QR</span>
                                    </button>
                                </div>
                            </a>
                        @else
                            <div class="d-grid d-md-flex">
                                <button type="button" disabled
                                    class="btn btn-sm btn-outline-dark fw-medium rounded-3 p-2 mb-2 mb-md-0 ms-0 ms-md-2">
                                    <span>Export QR</span>
                                </button>
                            </div>
                        @endif
                        <button wire:click.prevent="confirmImport" type="button"
                            class="btn btn-sm btn-outline-dark fw-medium rounded-3 p-2 mb-2 mb-md-0 ms-0 ms-md-2">
                            <span>Import</span>
                        </button>
                        <button wire:click.prevent="confirmItemCreate" type="button"
                            class="btn btn-sm btn-success rounded-3 p-2 mb-2 mb-md-0 ms-0 ms-md-2">
                            <span>Tambah Barang</span>
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="bg-body-tertiary">
                            <tr>
                                <th scope="col" class="text-center ps-4">
                                    <div class="form-check">
                                        <input wire:model="selectPageRows"
                                            class="form-check-input focus-ring focus-ring-light" type="checkbox"
                                            value="" id="" style="cursor: pointer">
                                    </div>
                                </th>
                                <th scope="col" class="text-center">NO</th>
                                <th scope="col" class="text-center">
                                    <span
                                        @if ($items->count() > 0) wire:click="orderBy('kode')" style="cursor: pointer" @endif>KODE
                                        @if ($orderBy === 'kode' && $orderDirection === 'asc' && $items->count() > 0)
                                            <i class="fa-solid fa-arrow-down-1-9 fa-lg"></i>
                                        @elseif ($orderBy === 'kode' && $orderDirection === 'desc' && $items->count() > 0)
                                            <i class="fa-solid fa-arrow-down-9-1 fa-lg"></i>
                                        @endif
                                    </span>
                                </th>
                                <th scope="col" class="text-center">
                                    <span
                                        @if ($items->count() > 0) wire:click="orderBy('nama')" style="cursor: pointer" @endif>NAMA
                                        @if ($orderBy === 'nama' && $orderDirection === 'asc' && $items->count() > 0)
                                            <i class="fa-solid fa-arrow-down-a-z fa-lg"></i>
                                        @elseif ($orderBy === 'nama' && $orderDirection === 'desc' && $items->count() > 0)
                                            <i class="fa-solid fa-arrow-down-z-a fa-lg"></i>
                                        @endif
                                    </span>
                                </th>
                                <th scope="col" class="text-center">
                                    <span
                                        @if ($items->count() > 0) wire:click="orderBy('nomorRegister')" style="cursor: pointer" @endif>NOMOR
                                        REGISTER
                                        @if ($orderBy === 'nomorRegister' && $orderDirection === 'asc' && $items->count() > 0)
                                            <i class="fa-solid fa-arrow-down-1-9 fa-lg"></i>
                                        @elseif ($orderBy === 'nomorRegister' && $orderDirection === 'desc' && $items->count() > 0)
                                            <i class="fa-solid fa-arrow-down-9-1 fa-lg"></i>
                                        @endif
                                    </span>
                                </th>
                                <th scope="col" class="text-center">
                                    <span
                                        @if ($items->count() > 0) wire:click="orderBy('kategori')" style="cursor: pointer" @endif>KATEGORI
                                        @if ($orderBy === 'kategori' && $orderDirection === 'asc' && $items->count() > 0)
                                            <i class="fa-solid fa-arrow-down-a-z fa-lg"></i>
                                        @elseif ($orderBy === 'kategori' && $orderDirection === 'desc' && $items->count() > 0)
                                            <i class="fa-solid fa-arrow-down-z-a fa-lg"></i>
                                        @endif
                                    </span>
                                </th>
                                <th scope="col" class="text-center">
                                    <span
                                        @if ($items->count() > 0) wire:click="orderBy('tahunBeli')" style="cursor: pointer" @endif>TAHUN
                                        PEMBELIAN
                                        @if ($orderBy === 'tahunBeli' && $orderDirection === 'asc' && $items->count() > 0)
                                            <i class="fa-solid fa-arrow-down-1-9 fa-lg"></i>
                                        @elseif ($orderBy === 'tahunBeli' && $orderDirection === 'desc' && $items->count() > 0)
                                            <i class="fa-solid fa-arrow-down-9-1 fa-lg"></i>
                                        @endif
                                    </span>
                                </th>
                                <th scope="col" class="text-center">
                                    <span
                                        @if ($items->count() > 0) wire:click="orderBy('kondisi')" style="cursor: pointer" @endif>KONDISI
                                        @if ($orderBy === 'kondisi' && $orderDirection === 'asc' && $items->count() > 0)
                                            <i class="fa-solid fa-arrow-down-a-z fa-lg"></i>
                                        @elseif ($orderBy === 'kondisi' && $orderDirection === 'desc' && $items->count() > 0)
                                            <i class="fa-solid fa-arrow-down-z-a fa-lg"></i>
                                        @endif
                                    </span>
                                </th>
                                <th scope="col" class="text-center">
                                    <span
                                        @if ($items->count() > 0) wire:click="orderBy('harga')" style="cursor: pointer" @endif>HARGA
                                        @if ($orderBy === 'harga' && $orderDirection === 'asc' && $items->count() > 0)
                                            <i class="fa-solid fa-arrow-down-1-9 fa-lg"></i>
                                        @elseif ($orderBy === 'harga' && $orderDirection === 'desc' && $items->count() > 0)
                                            <i class="fa-solid fa-arrow-down-9-1 fa-lg"></i>
                                        @endif
                                    </span>
                                </th>
                                <th scope="col" class="text-center">AKSI</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($items as $index => $item)
                                <tr class="align-middle">
                                    <td class="text-center ps-4">
                                        <div class="form-check">
                                            <input wire:model="selectedRows"
                                                class="form-check-input focus-ring focus-ring-light" type="checkbox"
                                                value="{{ $item->id }}" id="{{ $item->id }}"
                                                style="cursor: pointer">
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $items->firstItem() + $index }}
                                    </td>
                                    <td wire:click.prevent="readItem({{ $item }})" class="text-center"
                                        data-bs-toggle="tooltip" data-bs-title="Detail" style="cursor: pointer">
                                        {{ $item->kode }}
                                    </td>
                                    <td wire:click.prevent="readItem({{ $item }})" data-bs-toggle="tooltip"
                                        data-bs-title="Detail" style="cursor: pointer">
                                        {{ $item->nama }}
                                    </td>
                                    <td class="text-center">{{ $item->nomorRegister }}</td>
                                    <td class="text-center">{{ $item->kategori }}</td>
                                    <td class="text-center">{{ $item->tahunBeli }}</td>
                                    <td class="text-center">{{ $item->kondisi }}</td>
                                    <td class="text-end pe-3">Rp
                                        {{ number_format($item->harga, 2, ',', '.') }}</td>
                                    <td class="text-center">
                                        <a href="{{ url("items/$item->id") }}" target="_blank"
                                            class="text-decoration-none" data-bs-toggle="tooltip"
                                            data-bs-title="Lihat">
                                            <button type="button"
                                                class="btn btn-sm btn-outline-secondary rounded-3 py-1 px-2 my-1">
                                                <i class="fa-solid fa-up-right-from-square"></i>
                                            </button>
                                        </a>
                                        <button wire:click.prevent="confirmItemUpdate({{ $item }})"
                                            data-bs-toggle="tooltip" data-bs-title="Ubah" type="button"
                                            class="btn btn-sm btn-outline-primary rounded-3 py-1 px-2 my-1 ms-1">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button wire:click.prevent="confirmItemDelete({{ $item->id }})"
                                            data-bs-toggle="tooltip" data-bs-title="Hapus" type="button"
                                            class="btn btn-sm btn-outline-danger rounded-3 py-1 px-2 my-1 ms-1">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-5">Data barang tidak ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Paginate --}}
                {{ $items->links() }}
            </div>
        </div>
    </div>

    {{-- Create Update Modal --}}
    @include('items.create-update-modal')

    {{-- Read Offcanvas --}}
    @include('items.read-offcanvas')

    {{-- Delete Modal --}}
    @include('items.delete-modal')

    {{-- Import Modal --}}
    @include('items.import-modal')

    {{-- Alert Success --}}
    @include('partials.alert-success')

</div>
