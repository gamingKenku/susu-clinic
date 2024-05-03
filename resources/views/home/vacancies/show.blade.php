@extends('layouts.app')

@section('title')
    Вакансии
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-md">
            <div class="card">
                <h5 class="card-header">Вакансия на должность "{{ $vacancy->name }}"</h5>
                <div class="card-body">
                    <h5 class="card-text">Описание</h5>
                    <p class="card-text">{!! $vacancy->description !!}</p>
                    <h5 class="card-text">Обязанности</h5>
                    <p class="card-text">{!! $vacancy->responsibilities !!}</p>
                    <h5 class="card-text">Требования</h5>
                    <p class="card-text">{!! $vacancy->requirements !!}</p>
                    <h5 class="card-text">Условия</h5>
                    <p class="card-text">{!! $vacancy->conditions !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection