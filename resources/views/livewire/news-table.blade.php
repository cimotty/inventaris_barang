<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-12">
            <div class="bg-white border rounded-4">

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
                        <button wire:click.prevent="confirmPostCreate" type="button"
                            class="btn btn-sm btn-success rounded-3 p-2 mb-2 mb-md-0 ms-0 ms-md-2">
                            <span>Tambah Berita</span>
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
                                        @if ($news->count() > 0) wire:click="orderBy('judul')" style="cursor: pointer" @endif>JUDUL
                                        @if ($orderBy === 'judul' && $orderDirection === 'asc' && $news->count() > 0)
                                            <i class="fa-solid fa-arrow-down-a-z fa-lg"></i>
                                        @elseif ($orderBy === 'judul' && $orderDirection === 'desc' && $news->count() > 0)
                                            <i class="fa-solid fa-arrow-down-z-a fa-lg"></i>
                                        @endif
                                    </span>
                                </th>
                                <th scope="col" class="text-center">
                                    <span
                                        @if ($news->count() > 0) wire:click="orderBy('keterangan')" style="cursor: pointer" @endif>KETERANGAN
                                        @if ($orderBy === 'keterangan' && $orderDirection === 'asc' && $news->count() > 0)
                                            <i class="fa-solid fa-arrow-down-a-z fa-lg"></i>
                                        @elseif ($orderBy === 'keterangan' && $orderDirection === 'desc' && $news->count() > 0)
                                            <i class="fa-solid fa-arrow-down-z-a fa-lg"></i>
                                        @endif
                                    </span>
                                </th>
                                <th scope="col" class="text-center">
                                    <span
                                        @if ($news->count() > 0) wire:click="orderBy('created_at')" style="cursor: pointer" @endif>TANGGAL
                                        @if ($orderBy === 'created_at' && $orderDirection === 'asc' && $news->count() > 0)
                                            <i class="fa-solid fa-arrow-down-1-9 fa-lg"></i>
                                        @elseif ($orderBy === 'created_at' && $orderDirection === 'desc' && $news->count() > 0)
                                            <i class="fa-solid fa-arrow-down-9-1 fa-lg"></i>
                                        @endif
                                    </span>
                                </th>
                                <th scope="col" class="text-center">AKSI</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($news as $index => $post)
                                <tr class="align-middle">
                                    <td class="text-center ps-4">
                                        <div class="form-check">
                                            <input wire:model="selectedRows"
                                                class="form-check-input focus-ring focus-ring-light" type="checkbox"
                                                value="{{ $post->id }}" id="{{ $post->id }}"
                                                style="cursor: pointer">
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $news->firstItem() + $index }}
                                    </td>
                                    <td wire:click.prevent="readPost({{ $post }})" data-bs-toggle="tooltip"
                                        data-bs-title="Detail" style="cursor: pointer">
                                        {{ $post->judul }}
                                    </td>
                                    <td wire:click.prevent="readPost({{ $post }})" data-bs-toggle="tooltip"
                                        data-bs-title="Detail" style="cursor: pointer">
                                        {{ $post->keterangan }}
                                    </td>
                                    <td class="text-center">{{ $post->created_at }}</td>
                                    <td class="text-center">
                                        <a href="{{ url("posts/$post->id/$post->slug") }}" target="_blank"
                                            class="text-decoration-none" data-bs-toggle="tooltip" data-bs-title="Lihat">
                                            <button type="button"
                                                class="btn btn-sm btn-outline-secondary rounded-3 py-1 px-2 my-1">
                                                <i class="fa-solid fa-up-right-from-square"></i>
                                            </button>
                                        </a>
                                        <button wire:click.prevent="confirmPostUpdate({{ $post }})"
                                            data-bs-toggle="tooltip" data-bs-title="Ubah" type="button"
                                            class="btn btn-sm btn-outline-primary rounded-3 py-1 px-2 my-1 ms-1">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <button wire:click.prevent="confirmPostDelete({{ $post->id }})"
                                            data-bs-toggle="tooltip" data-bs-title="Hapus" type="button"
                                            class="btn btn-sm btn-outline-danger rounded-3 py-1 px-2 my-1 ms-1">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-5">Data berita tidak ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Paginate --}}
                {{ $news->links() }}
            </div>
        </div>
    </div>

    {{-- Create Update Modal --}}
    @include('news.create-update-modal')

    {{-- Read Offcanvas --}}
    @include('news.read-offcanvas')

    {{-- Delete Modal --}}
    @include('news.delete-modal')

    {{-- Alert Success --}}
    @include('partials.alert-success')

</div>
