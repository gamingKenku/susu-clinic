@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <table class="table table-hover">
                <tr>
                    <th>Название</th>
                    <th>Количество</th>
                    <th>Последнее обновление</th>
                    <th class="w-15"></th>    
                </tr>
                @foreach ($tables as $table)
                    <tr>
                        <td>{{ __(ucfirst($table)) }}</td>
                        <td>{{ DB::table($table)->get()->count() }}</td>
                        <td>@if(!is_null(DB::table($table)->latest()->first())) {{ DB::table($table)->latest()->first()->updated_at }} @endif </td>
                        <td><a role="button" class="btn btn-primary" href="{{ route('resources') . '/' . $table }}">Просмотреть</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
