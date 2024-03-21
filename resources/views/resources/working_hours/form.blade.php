@php
    $weekdays = ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье'];
@endphp

<div class="mb-3 row">
    <label for="staff_name" class="col-form-label text-lg-end col-lg-2 col-xl-3">ФИО</label>
    <div class="col-lg-10 col-xl-9">
        <p>{{ $staff->first_name }} {{ $staff->last_name }} {{ $staff->patronym }}</p>
    </div>
</div>

@if ($staff->workingHours)
    @foreach($weekdays as $index => $weekday)
        <div class="mb-3 row">
            <label for="start_time[{{ $index }}]" class="col-form-label text-lg-end col-lg-2 col-xl-3">{{ $weekday }}</label>
            <div class="col-lg-4 col-xl-3">
                <input class="d-flex-inline form-control {{ $errors->has("start_time[$index]") ? ' is-invalid' : '' }}" name="start_time[{{ $index }}]" type="time" id="start_time_{{ $index }}" value="{{ old("start_time[$index]", optional($staff->workingHours->where('weekday', '=', $index)->where('staff_id', '=', $staff->id)->first())->start_time) }}" required="true">
                {!! $errors->first("start_time[$index]", '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-lg-4 col-xl-3">
                <input class="d-flex-inline form-control {{ $errors->has("end_time[$index]") ? ' is-invalid' : '' }}" name="end_time[{{ $index }}]" type="time" id="end_time_{{ $index }}" value="{{ old("end_time[$index]", optional($staff->workingHours->where('weekday', '=', $index)->where('staff_id', '=', $staff->id)->first())->end_time) }}" required="true">
                {!! $errors->first("end_time[$index]", '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
    @endforeach
@else
    @foreach($weekdays as $index => $weekday)
    <div class="mb-3 row">
        <label for="start_time[{{ $index }}]" class="col-form-label text-lg-end col-lg-2 col-xl-3">{{ $weekday }}</label>
        <div class="col-lg-4 col-xl-3">
            <input class="d-flex-inline form-control {{ $errors->has("start_time[$index]") ? ' is-invalid' : '' }}" name="start_time[{{ $index }}]" type="time" id="start_time_{{ $index }}" required="true">
            {!! $errors->first("start_time[$index]", '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="col-lg-4 col-xl-3">
            <input class="d-flex-inline form-control {{ $errors->has("end_time[$index]") ? ' is-invalid' : '' }}" name="end_time[{{ $index }}]" type="time" id="end_time_{{ $index }}" required="true">
            {!! $errors->first("end_time[$index]", '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    @endforeach
@endif
