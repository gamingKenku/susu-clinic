@extends('layouts.app')

@php
    use Carbon\Carbon;
    $categories_chunks = $categories->chunk(6);
@endphp

@section('content')
    <div class="container">
        @if ($events->isNotEmpty())
            <div class="row justify-content-center mb-5">
                <div class="col-md">
                    <div id="eventsCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($events as $event)
                                <div class="carousel-item @if ($loop->index == 0) active @endif">
                                    <a href="{{ route('eventShow', $event->id) }}"><img
                                            src="{{ $event->picture_path ? asset('storage/' . $event->picture_path) : asset('storage/event_pictures/event_default.jpg') }}"
                                            class="d-block w-100"></a>
                                    <div class="carousel-caption">
                                        <h5>{{ $event->header }}</h5>
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
        <div class="row justify-content-center mb-5">
            @foreach ($discounts as $discount)
                <div class="col-md d-flex mb-3 mb-md-0">
                    <div class="card flex-fill">
                        <h5 class="card-header">Акция</h5>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $discount->header }}</h5>
                            <p class="card-text flex-grow-1">{{ $discount->content }}</p>
                            @if ($discount->end_date)
                                @php
                                    $end_date_string = Carbon::createFromFormat('Y-m-d', $discount->end_date)->format('d.m.Y');
                                @endphp
                                <p class="card-text"><small class="text-muted">Акция действует до
                                        {{ $end_date_string }}</small></p>
                            @endif
                            <a href="{{ route('discountsShow', $discount->id) }}"
                                class="btn btn-primary mt-auto">Просмотреть</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row justify-content-center">
            @foreach ($categories_chunks as $categories_chunk)
                <div class="col-md d-flex mb-3 mb-md-0">
                    <div class="card flex-fill d-flex flex-column">
                        <h5 class="card-header">Категории услуг</h5>
                        <div class="card-body">
                            @foreach ($categories_chunk as $category)
                                <a href="{{ route('servicesIndex', ['category' => $category->id, 'filter' => $category->clinic->name]) }}"
                                    class="card-text fs-5 link-underline link-underline-opacity-0 link-underline-opacity-100-hover">{{ $category->name }}</a> <br>
                            @endforeach
                        </div>
                        <div class="mt-auto"></div>
                    </div>
                </div>
            @endforeach
            <div class="col-md-1"></div>
            <div class="col-md-2 d-flex">
                <a class="btn btn-primary align-self-center" href="{{ route('servicesIndex') }}">Открыть все услуги</a>
            </div>
        </div>

    </div>
@endsection
