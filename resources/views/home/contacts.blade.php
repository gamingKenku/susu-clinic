@extends('layouts.app')

@section('title')
    Контакты
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-start">
            <div class="col-md">
                <div class="card">
                    <h4 class="card-header">Контакты</h4>
                    <div class="card-body">
                        {{-- <p class="card-text">Адрес: 454080, г. Челябинск, ул. Сони Кривой 60, 2 этаж</p> --}}
                        <p class="card-text">Телефон: +7 (351) 267-91-43</p>
                        <p class="card-text">E-mail: <a href="mailto:krylovasf@susu.ru">krylovasf@susu.ru</a></p>
                        <p class="card-text">Группа ВК: <a href="http://vk.com/medcentrsusu">vk.com/medcentrsusu</a></p>
                        <p class="card-text">Время работы: 09:00-17:00</p>
                        <h4 class="card-title">Адреса отделений</h4>
                        @foreach ($clinics as $clinic)
                            <h5 id="clinic{{ $clinic->id }}" class="card-title">{{ $clinic->name }}</h5>
                            <p class="card-text">{{ $clinic->address }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection