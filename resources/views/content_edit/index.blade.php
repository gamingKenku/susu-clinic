@extends('layouts.admin')

@php
    use App\Models\Link;
@endphp

@section('content')
    <div class="container-fluid p-0">
        <div class="card text-bg-theme">

            <div class="card-header d-flex justify-content-between align-items-center p-3">
                <h4 class="m-0">Контент</h4>
            </div>

            <div class="card-body p-0">

                <div class="row">
                    <div class="col">
                            <table class="table table-striped">
                                <tr>
                                    <th>Название</th>
                                    <th>Количество</th>

                                    <th class="w-15"></th>
                                </tr>
                                <tr>
                                    <td class="align-middle">О нас</td>
                                    <td class="align-middle"></td>
                                    <td class="align-middle text-end">
                                        <a href="{{ route('aboutEdit') }}" role="button" class="btn btn-primary">Изменить</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Контакты</td>
                                    <td class="align-middle"></td>
                                    <td class="align-middle text-end">
                                        <a href="{{ route('contactsEdit') }}" role="button" class="btn btn-primary">Изменить</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Лицензия</td>
                                    <td class="align-middle"></td>
                                    <td class="align-middle text-end">
                                        <a href="{{ route('licenseEdit') }}" role="button" class="btn btn-primary">Изменить</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Ссылки</td>
                                    <td class="align-middle">{{ Link::all()->count() }}</td>
                                    <td class="align-middle text-end">
                                        <a href="{{ route('links.index') }}" role="button" class="btn btn-primary">Просмотреть</a>
                                    </td>
                                </tr>
                            </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
