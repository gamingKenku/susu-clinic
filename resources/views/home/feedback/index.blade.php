@extends('layouts.app')

@php
    $feedback_chunks = $feedback->chunk(2);
@endphp

@section('title')
    Отзывы
@endsection

@section('content')
    <div class="container">
        @if (Session::has('success_message'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {!! session('success_message') !!}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
            </div>
        @endif
        <h3 class="mb-3">Отзывы</h3>
        <div class="row justify-content-center mb-3">
            <div class="col-md d-flex flex-md-row flex-column">
                <a href="{{ route('feedbackCreate') }}" class="btn btn-primary me-0 me-md-3 mb-3 mb-md-0">Оставить отзыв</a>
            </div>
        </div>
        @foreach ($feedback_chunks as $feedback_chunk)
            <div class="row justify-content-center mb-0 mb-md-3">
                @foreach ($feedback_chunk as $review)
                    <div class="col-md-6 d-flex mb-3 mb-md-0">
                        <div class="card flex-fill">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $review->author }}</h5>
                                <p class="card-text flex-grow-1">{{ $review->content }}</p>
                                <p>
                                    @for ($i = 1; $i <= $review->rating; $i++)
                                        <span class="fa fa-star checked"></span>
                                    @endfor
                                    @for ($i = 1; $i <= 5 - $review->rating; $i++)
                                        <span class="fa fa-star"></span>
                                    @endfor
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach

        {!! $feedback->links() !!}

    </div>
@endsection
