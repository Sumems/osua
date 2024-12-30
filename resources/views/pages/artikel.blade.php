@extends('template')
@section('title')
Artikel
@endsection
@section('content')
{{-- NAVIGATION PAGE --}}
<div class="breadcrumbs">
    <div class="page-header d-flex align-items-center" style="background-image: url('assets/image/carousel-1.jpg');">
        <div class="container position-relative">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 text-center">
                    <h2>Artikel</h2>
                </div>
            </div>
        </div>
    </div>
    <nav>
        <div class="container">
            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Artikel</li>
            </ol>
        </div>
    </nav>
</div>

{{-- MAIN CONTENT --}}
<section id="article" class="article pt-4">
    <div class="container" data-aos="fade-up">
        <div class="section-header">
            <span>Artikel</span>
            <h2>Artikel</h2>
        </div>
        <div class="row gy-4">
            @foreach ($articles as $article)
                
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card">
                    <div class="card-img">
                        <img src="{{ asset('images/articles/'.$article->image) }}" alt="" class="img-fluid">
                    </div>
                    <h3><a href="{{ route('detail-article', $article->id) }}" class="stretched-link">{{ $article->title }}</a></h3>
                    <p class="text-truncate-multiline">{!! \Str::limit(html_entity_decode($article->description), 100) !!}</p>
                    <a class="readmore"><span>Baca Selengkapnya</span><i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
@section('js')

@endsection