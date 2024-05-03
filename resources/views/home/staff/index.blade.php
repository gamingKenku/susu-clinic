@extends('layouts.app')

@php
    $staff_chunks = $staff->chunk(4);
@endphp

@section('title')
    Сотрудники медицинского центра
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-0 mb-md-3">
            <div class="col-md d-flex flex-md-row flex-column">
                <button class="btn btn-primary me-0 me-md-3 mb-3 mb-md-0 staff-type-filter-btn" data-staff-type="doctor" type="button">Врачи</button>
                <button class="btn btn-primary me-0 me-md-3 mb-3 mb-md-0 staff-type-filter-btn" data-staff-type="nurse" type="button">Медработник</button>
                <button class="btn btn-primary me-0 me-md-3 mb-3 mb-md-0 staff-type-filter-btn" data-staff-type="administrator" type="button">Руководство</button>
                <input type="text" name="filter" id="filter" class="form-control me-0 me-md-3 mb-3 mb-md-0"
                    value="@if(in_array(Request::input('filter'), ['doctor', 'nurse', 'administrator']))@else{{ Request::input('filter') }}@endif" placeholder="Введите фильтр...">
                <button type="button" name="filter-btn" id="filter-btn"
                    class="btn btn-primary me-0 me-md-3 mb-3 mb-md-0">Обновить</button>
                <button type="button" name="clear-filter-btn" id="clear-filter-btn"
                    class="btn btn-primary mb-3 mb-md-0">Сбросить</button>
            </div>
        </div>
        @foreach ($staff_chunks as $staff_chunk)
            <div class="row justify-content-center">
                @foreach ($staff_chunk as $staff_member)
                    <div class="col-md-3 d-flex mb-3">
                        <div class="card flex-fill d-flex flex-column">
                            <img src="{{ $staff_member->photo_path ? asset('storage/' . $staff_member->photo_path) : asset('storage/staff_photos/staff_default.jpg') }}"
                                class="card-img-top">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $staff_member->last_name }} {{ $staff_member->first_name }}
                                    {{ $staff_member->patronym }}</h5>
                                <p class="card-text flex-grow-1">{{ ucfirst($staff_member->positions()->implode('name', ', ')) }}</p>
                                <a href="{{ route('staffShow', $staff_member->id) }}"
                                    class="btn btn-primary mt-auto">Подробнее</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach

        {!! $staff->links() !!}

    </div>
@endsection
