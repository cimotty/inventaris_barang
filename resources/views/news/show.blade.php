@extends('layouts.main')
@section('content')
    <div class="px-2 py-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card rounded-4">
                        <div class="card-body">
                            @auth
                                <p class="ms-1">
                                    <a href="/news"
                                        class="link-secondary link-opacity-75-hover link-underline-opacity-0 link-underline-opacity-0-hover"><i
                                            class="fa-solid fa-chevron-left me-1"></i>Kembali</a>
                                </p>
                            @endauth
                            @guest
                                <p class="ms-1">
                                    <a href="/posts"
                                        class="link-secondary link-opacity-75-hover link-underline-opacity-0 link-underline-opacity-0-hover"><i
                                            class="fa-solid fa-chevron-left me-1"></i>Kembali</a>
                                </p>
                            @endguest
                            <div class="row mx-1">
                                <div class="col">
                                    <dl class="pt-2">
                                        <dt>
                                            <p class="fs-3 lh-1">{{ $post->judul }}</p>
                                        </dt>
                                        <dd class="border-bottom text-body-secondary mb-4">
                                            Dibuat pada {{ $formattedDate }}
                                        </dd>
                                        <dd>
                                            <p class="fs-6 lh-1">{{ $post->keterangan }}</p>
                                            @if (!empty($post->pdf))
                                                <p class="lh-1">File PDF :
                                                    <a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                                        href="{{ Storage::disk('news')->url($post->pdf) }}"
                                                        target="_blank"><strong>{{ $post->namaPdf }}</strong></a>
                                                </p>
                                            @endif
                                        </dd>
                                    </dl>
                                </div>
                                @if ($recentPosts->count() > 0)
                                    <div class="col-sm-4">
                                        <dl class="border rounded-3 p-3">
                                            <dt class="mb-2">
                                                <p class="fs-5 lh-1">Berita Terbaru</p>
                                            </dt>
                                            @forelse ($recentPosts as $index => $recentPost)
                                                <dd>
                                                    <p class="fs-6 lh-1">
                                                        <a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                                            href="{{ url("posts/$recentPost->id/$recentPost->slug") }}"
                                                            target="_blank">{{ $recentPost->judul }}</a>
                                                    </p>
                                                </dd>
                                            @empty
                                            @endforelse
                                        </dl>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
