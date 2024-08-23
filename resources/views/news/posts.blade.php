@extends('layouts.main')
@section('content')
    <div class="px-2 py-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card rounded-4">
                        <div class="card-body">
                            <div class="row mx-1">
                                <div class="col">
                                    <dl>
                                        <dt class="pt-3 pb-4">
                                            <p class="fs-2 lh-1">Berita Terbaru</p>
                                        </dt>
                                        @forelse ($recentPosts as $index => $recentPost)
                                            <div class="border border-start-0 border-end-0 border-bottom-0 pt-4 pb-1">
                                                <dd class="fw-normal lh-1 text-body-secondary">
                                                    {{ $recentPost->formattedDate }}</dd>
                                                <dd>
                                                    <p class="fw-semibold fs-5 lh-1 pt-2"><a
                                                            class="link-dark link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover"
                                                            href="{{ url("posts/$recentPost->id/$recentPost->slug") }}"
                                                            target="_blank">{{ $recentPost->judul }}</a></p>
                                                    @if (!empty($recentPost->pdf))
                                                        <p class="fw-medium lh-1">
                                                            <a class="link-dark link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover"
                                                                href="{{ Storage::disk('news')->url($recentPost->pdf) }}"
                                                                target="_blank">Download PDF</a>
                                                        </p>
                                                    @endif
                                                </dd>
                                            </div>
                                        @empty
                                        @endforelse
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
