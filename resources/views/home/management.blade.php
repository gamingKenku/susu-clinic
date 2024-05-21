@extends('layouts.app')

@section('title')
    Руководство
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-start">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row justify-content-center align-items-start">
                                <div class="col-4 col-lg-2">
                                    <img class="w-100" src="{{ asset('storage/staff_photos/head_physician.jpg') }}"
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
                </div>
            </div>
        </div>
    </div>
@endsection
