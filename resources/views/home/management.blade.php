@extends('layouts.app')

@section('title')
    Руководство
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
    <li class="breadcrumb-item active" aria-current="page">Руководство</li>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-start">
            <div class="col">
                <h3 class="mb-3">Руководство</h3>

                @foreach ($management as $management_staff)
                    <div class="row mb-3 justify-content-center">
                        <div class="col-md">
                            <div class="card">
                                <h5 class="card-header">{{ $management_staff->last_name }} {{ $management_staff->first_name }}
                                    {{ $management_staff->patronym }}</h5>
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-4 mb-3 mb-md-0">
                                                <img class="w-100 mb-1"
                                                    src="{{ $management_staff->photo_path ? asset('storage/' . $management_staff->photo_path) : asset('storage/staff_photos/staff_default.jpg') }}">
                                                <h5 class="text-center">{{ $management_staff->last_name }} {{ $management_staff->first_name }}
                                                    {{ $management_staff->patronym }}, {{ __($management_staff->staff_type) }}</h5>
                                            </div>
                                            <div class="col-md">
                                                <h4>Стаж работы с {{ $management_staff->experience }} года.</h4>
                                                <h4>Специализации</h4>
                                                <p>{!! $management_staff->specialities !!}</p>
                                                <h4>Должности</h4>
                                                <ul>
                                                    @foreach ($management_staff->positions as $position)
                                                        <li>{{ $position->name }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {!! $management->links() !!}
                        </div>
                    </div>
                @endforeach
                {{-- <div class="card">
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row justify-content-center align-items-start">
                                <div class="col-4 col-lg-2">
                                    <img class="w-100" src="{{ asset('storage/staff_photos/head_physician.png') }}"
                                        alt="">
                                </div>
                                <div class="col">
                                    <h5 class="card-text">Главный врач Медицинского центра</h5>
                                    <h4 class="card-text">Ольга Сергеевна Веселова</h4>
                                    <h5 class="card-text">Врач общей практики</h5>
                                    <br>
                                    <a class="link-underline link-underline-opacity-0 link-underline-opacity-100-hover" href="mailto:veselovaos@susu.ru">veselovaos@susu.ru</a>
                                    <br><br>
                                    <p class="fst-italic">
                                        <a class="link-underline link-underline-opacity-0 link-underline-opacity-100-hover"
                                        href="https://www.susu.ru/ru/news/2018/03/10/za-zdorovyy-obraz-zhizni-intervyu-s-direktorom-medicinskogo-centra-olgoy-veselovoy">За
                                        здоровый образ жизни: интервью с директором
                                        Медицинского центра ЮУрГУ Ольгой Веселовой</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
