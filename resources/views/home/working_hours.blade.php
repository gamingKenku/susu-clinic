@extends('layouts.app')

@section('title')
    Расписание сотрудников
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
    <li class="breadcrumb-item active" aria-current="page">Расписание</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mb-0 mb-md-3">
        <div class="col-md d-flex flex-md-row flex-column">
            <input type="text" name="filter" id="filter" class="form-control me-0 me-md-3 mb-3 mb-md-0 w-auto"
                value="{{ Request::input('filter') }}" placeholder="Введите фамилию...">
            <button type="button" name="filter-btn" id="filter-btn"
                class="btn btn-primary me-0 me-md-3 mb-3 mb-md-0">Обновить</button>
            <button type="button" name="clear-filter-btn" id="clear-filter-btn"
                class="btn btn-primary mb-3 mb-md-0">Сбросить</button>
        </div>
    </div>
</div>
    <div class="card text-bg-theme">

        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Расписание сотрудников</h4>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>ФИО сотрудника</th>
                            <th>Понедельник</th>
                            <th>Вторник</th>
                            <th>Среда</th>
                            <th>Четверг</th>
                            <th>Пятница</th>
                            <th>Суббота</th>
                            <th>Воскресенье</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($staff as $staff_member)
                            <tr>
                                <td class="align-middle">{{ $staff_member->last_name }} {{ $staff_member->first_name }}
                                    {{ $staff_member->patronym }}</td>
                                @if ($staff_member->workingHours()->exists())
                                    @for ($i = 0; $i <= 6; $i++)
                                        <td class="align-middle">
                                            {{ optional($staff_member->workingHours->where('weekday', '=', $i)->where('staff_id', '=', $staff_member->id)->first())->start_time }}
                                            -
                                            {{ optional($staff_member->workingHours->where('weekday', '=', $i)->where('staff_id', '=', $staff_member->id)->first())->end_time }}
                                        </td>
                                    @endfor
                                @else
                                    @for ($i = 0; $i <= 6; $i++)
                                        <td class="align-middle"> - </td>
                                    @endfor
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

            {!! $staff->links() !!}
        </div>

    </div>
@endsection
