@extends('layouts.admin')

@section('content')

<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($title) ? $title : 'Рабочие часы' }}</h4>
        <div>
            <form method="POST" action="{!! route('working-hours.destroy', $staff->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('working-hours.edit', $staff->id ) }}" class="btn btn-primary" title="Редактировать">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Удалить" onclick="return confirm(&quot;Click Ok to delete Working Hours.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('working-hours.index') }}" class="btn btn-primary" title="Показать все">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                {{-- <a href="{{ route('working-hours.create') }}" class="btn btn-secondary" title="Создать">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a> --}}

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">ФИО сотрудника</dt>
            <dd class="col-lg-10 col-xl-9">{{ $staff->first_name }} {{ $staff->last_name }} {{ $staff->patronym }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Понедельник</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($staff->workingHours->where('weekday', '=', 0)->where('staff_id', '=', $staff->id)->first())->start_time }} - {{ optional($staff->workingHours->where('weekday', '=', 0)->where('staff_id', '=', $staff->id)->first())->end_time }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Вторник</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($staff->workingHours->where('weekday', '=', 1)->where('staff_id', '=', $staff->id)->first())->start_time }} - {{ optional($staff->workingHours->where('weekday', '=', 1)->where('staff_id', '=', $staff->id)->first())->end_time }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Среда</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($staff->workingHours->where('weekday', '=', 2)->where('staff_id', '=', $staff->id)->first())->start_time }} - {{ optional($staff->workingHours->where('weekday', '=', 2)->where('staff_id', '=', $staff->id)->first())->end_time }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Четверг</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($staff->workingHours->where('weekday', '=', 3)->where('staff_id', '=', $staff->id)->first())->start_time }} - {{ optional($staff->workingHours->where('weekday', '=', 3)->where('staff_id', '=', $staff->id)->first())->end_time }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Пятница</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($staff->workingHours->where('weekday', '=', 4)->where('staff_id', '=', $staff->id)->first())->start_time }} - {{ optional($staff->workingHours->where('weekday', '=', 4)->where('staff_id', '=', $staff->id)->first())->end_time }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Суббота</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($staff->workingHours->where('weekday', '=', 5)->where('staff_id', '=', $staff->id)->first())->start_time }} - {{ optional($staff->workingHours->where('weekday', '=', 5)->where('staff_id', '=', $staff->id)->first())->end_time }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Воскресенье</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($staff->workingHours->where('weekday', '=', 6)->where('staff_id', '=', $staff->id)->first())->start_time }} - {{ optional($staff->workingHours->where('weekday', '=', 6)->where('staff_id', '=', $staff->id)->first())->end_time }}</dd>
        </dl>

    </div>
</div>

@endsection