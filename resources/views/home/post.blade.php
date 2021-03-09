@extends('layouts.main')

@section('contents')
    <div class="article-internal mt-5">
        <div class="container">
            <div class="row">
                <article class="col-md-12">
                    <div class="row">
                        <figure class="col-12">
                            @if ($post->main_photo->count() > 0)
                                <img class="img img-fluid article-img" src="{{ $post->main_photo->url_lowres }}" >

                                <figcaption class="article-image-caption">
                                    <span class="article-image-author">{{ $post->main_photo->notes_and_author ?: $post->main_photo->author_credits }}</span>
                                    {{--A mostra conta com vídeos, músicas, esculturas, fotogra as e pinturas que remetem à cultura africana contemporânea--}}
                                </figcaption>
                            @endif
                        </figure>
                    </div>
                    <h1 class="article-title">{{ $post->title }}</h1>
                    <h5 class="article-subtitle">{{ $post->subtitle }}</h5>

                    <div class="post-author">{{ $post->authors_string }}</div>
                    <div class="article-body">
                        <p>{!! $post->lead_html !!}</p>

                        <p>{!! $post->body_html !!}</p>

                        <div class="row article-gallery" > {{-- ACR - transoformar este style em css!!!! --}}
                            @foreach ($post->other_photos as $photo)
                                <figure class="col-6 col-md-3">
                                    <a href="{{ $photo['url_lowres'] }}" data-lightbox="post-{{ $photo['id'] }}" data-title="{{ $photo['notes_and_author'] }}">
                                        <img
                                            class="img img-fluid article-img"
                                            src="{{ $photo['url_lowres'] }}"
                                        >
                                    </a>
                                    <figcaption class="article-image-caption">
                                        <span class="article-image-author">{{ $photo['notes_and_author'] }}</span>
                                    </figcaption>
                                </figure>
                            @endforeach
                        </div>

                    </div>
                </article>
            </div>

            @include('home.read-also')
        </div>
    </div>
@stop
