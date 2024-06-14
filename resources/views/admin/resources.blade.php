@extends('layouts.admin')

@section('content')

    <div class="card text-bg-theme">

        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Ресурсы</h4>
        </div>

        <div class="card-body p-0">

            <div class="row">
                <div class="col">

                    @if (Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {!! session('success_message') !!}

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
                        </div>
                    @endif

                    @if (Session::has('error_message'))
                        <div class="alert alert-error alert-dismissible" role="alert">
                            {!! session('error_message') !!}

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>Название</th>
                                <th>Количество</th>
                                <th>Последнее обновление</th>
                                <th class="w-15"></th>
                            </tr>
                            @foreach ($tables as $table)
                                <tr>
                                    <td class="align-middle">{{ __(ucfirst($table)) }}</td>
                                    <td class="align-middle">{{ DB::table($table)->get()->count() }}</td>
                                    <td class="align-middle">
                                        @if (!is_null(DB::table($table)->latest()->first()))
                                            {{ DB::table($table)->latest()->first()->updated_at }}
                                        @endif
                                    </td>
                                    <td class="align-middle text-end"><a role="button" class="btn btn-primary"
                                            href="{{ route('resources') . '/' . str_replace('_', '-', $table) }}">Просмотреть</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
