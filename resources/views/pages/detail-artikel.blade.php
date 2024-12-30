@extends('template')
@section('title')
Detail Artikel
@endsection
@section('content')
{{-- MAIN CONTENT --}}
<section id="detail-article" class="detail-article">
    <div class="container" data-aos="fade-up">
        <h2 class="h2 title mb-0">{{ $articles->title }}</h2>
        <span class="small subtitle d-flex">
            <span><i class="fa-solid fa-calendar-days"></i>&ensp; {{ $articles->created_at }}</span>
            <span><i class="fa-solid fa-user"></i>&ensp; {{ $articles->user_create }}</span>
        </span>
        <div class="row gy-4 mt-2">
            <div class="col-lg-6">
                <img src="{{ asset('images/articles/'.$articles->image) }}" alt="" class="img-fluid">
            </div>
            <div class="col-lg-6">
                <div class="article-text fs-5">
                    {!! html_entity_decode($articles->description) !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')

@endsection