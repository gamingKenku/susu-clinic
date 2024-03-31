@php
    use Carbon\Carbon;
    $weekdays = ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье'];

    if ($staff->workingHours)
    {
        $start_time_array = [];
        $end_time_array = [];
        for ($i = 0; $i <= 6; $i++)
        {
            $start_time_temp = optional($staff->workingHours->where('weekday', '=', $i)->where('staff_id', '=', $staff->id)->first())->start_time;
            $end_time_temp = optional($staff->workingHours->where('weekday', '=', $i)->where('staff_id', '=', $staff->id)->first())->end_time;
            $start_time_array += [$i => $start_time_temp ? Carbon::parse($start_time_temp)->format('H:i') : null];
            $end_time_array += [$i => $end_time_temp ? Carbon::parse($end_time_temp)->format('H:i') : null];
        }
    }
@endphp

<div class="mb-3 row">
    <label for="staff_name" class="col-form-label text-lg-end col-lg-2 col-xl-3">ФИО</label>
    <div class="col-lg-10 col-xl-9">
        {{ $staff->first_name }} {{ $staff->last_name }} {{ $staff->patronym }}
    </div>
</div>

@if ($staff->workingHours)
    @foreach($weekdays as $index => $weekday)
        <div class="mb-3 row">
            <label for="start_time[{{ $index }}]" class="col-form-label text-lg-end col-lg-2 col-xl-3">{{ $weekday }}</label>
            <div class="col-lg-4 col-xl-3">
                <input class="d-flex-inline form-control {{ $errors->has("start_time.$index") || $errors->has("start_time") ? ' is-invalid' : '' }}" name="start_time[{{ $index }}]" type="time" id="start_time_{{ $index }}" value="{{ old("start_time.$index", $start_time_array[$index]) }}" required="true">
                {!! $errors->first("start_time[$index]", '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-lg-4 col-xl-3">
                <input class="d-flex-inline form-control {{ $errors->has("end_time.$index") || $errors->has("end_time") ? ' is-invalid' : '' }}" name="end_time[{{ $index }}]" type="time" id="end_time_{{ $index }}" value="{{ old("end_time.$index", $end_time_array[$index]) }}" required="true">
                {!! $errors->first("end_time[$index]", '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-lg-2 col-xl-3">
                <button type="button" class="btn btn-secondary clear-button" data-row="{{ $index }}">
                    <span class="fa-solid fa-broom" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    @endforeach
@else
    @foreach($weekdays as $index => $weekday)
    <div class="mb-3 row">
        <label for="start_time[{{ $index }}]" class="col-form-label text-lg-end col-lg-2 col-xl-3">{{ $weekday }}</label>
        <div class="col-lg-4 col-xl-3">
            <input class="d-flex-inline form-control {{ $errors->has("start_time[$index]") || $errors->has("start_time") ? ' is-invalid' : '' }}" name="start_time[{{ $index }}]" type="time" id="start_time_{{ $index }}" required="true">
            {!! $errors->first("start_time[$index]", '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="col-lg-4 col-xl-3">
            <input class="d-flex-inline form-control {{ $errors->has("end_time[$index]") || $errors->has("end_time") ? ' is-invalid' : '' }}" name="end_time[{{ $index }}]" type="time" id="end_time_{{ $index }}" required="true">
            {!! $errors->first("end_time[$index]", '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="col-lg-2 col-xl-3">
            <button type="button" class="btn btn-secondary clear-button" data-row="{{ $index }}">
                <span class="fa-solid fa-broom" aria-hidden="true"></span>
            </button>
        </div>
    </div>
    @endforeach
@endif
