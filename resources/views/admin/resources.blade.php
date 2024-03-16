@extends('layouts.admin')

@section('content')

    <div class="card text-bg-theme">

        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Ресурсы</h4>
        </div>

        <div class="card-body p-0">

            <div class="row">
                <div class="col">
                    <div class="table-responsivce">
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
