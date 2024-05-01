@extends('layouts.app')

@php
    $categories_chunks = $categories->chunk(6);
@endphp

@section('content')
    <div class="container">
        @if ($events->isNotEmpty())
            <div class="row justify-content-center">
                <div class="col-md mb-3">
                    <div id="eventsCarousel" class="carousel slide" data-bs-ride="carousel">
                        {{-- <div class="carousel-indicators">
                        <button type="button" data-bs-target="#eventsCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#eventsCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#eventsCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div> --}}
                        <div class="carousel-inner">
                            @foreach ($events as $event)
                                <div class="carousel-item active">
                                    <img src="{{ $event->picture_path }}" class="d-block w-100">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>{{ $event->header }}</h5>
                                        <p>{{ Str::limit($event->content, 100) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#eventsCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Предыдущий</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#eventsCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Следующий</span>
                        </button>
                    </div>
                </div>
            </div>
        @endif
        <div class="row justify-content-center">
            @foreach ($discounts as $discount)
                <div class="col-md">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $discount->header }}</h5>
                            <p class="card-text">{{ $discount->content }}</p>
                            <a href="{{ route('discountsShow', $discount->id) }}" class="btn btn-primary">Просмотреть</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row justify-content-center">
            @foreach ($categories_chunks as $categories_chunk)
                <div class="col-md">
                    <div class="card">
                        <div class="card-header">Категории услуг</div>
                        <div class="card-body">
                            @foreach ($categories_chunk as $category)
                                <a href="{{ route('servicesIndex', ['category' => $category->name]) }}"
                                    class="card-text">{{ $category->name }}</a> <br>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-md-1">

            </div>
            <div class="col-md-2 d-flex">
                <a class="btn btn-primary align-self-center" href="{{ route('servicesIndex') }}">Открыть все услуги</a>
            </div>
        </div>
    </div>
@endsection
