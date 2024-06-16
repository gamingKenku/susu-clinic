@extends('layouts.app')

@section('title')
    Вакансии
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
    <li class="breadcrumb-item active" aria-current="page">Вакансии</li>
@endsection

@php
    $vacancies_chunks = $vacancies->chunk(2);
@endphp

@section('content')
<div class="container">
    <h3 class="mb-3">Актуальные вакансии</h3>
    @foreach ($vacancies_chunks as $vacancies_chunk)
        <div class="row mb-0 mb-md-3 justify-content-center">
            @foreach ($vacancies_chunk as $vacancy)
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">{{ $vacancy->name }}</h5>
                            <a class="btn btn-primary" href="{{ route('vacanciesShow', $vacancy->id) }}">Подробнее</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach

    {!! $vacancies->links() !!}
</div>
@endsection