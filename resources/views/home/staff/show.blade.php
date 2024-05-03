@extends('layouts.app')

@php
    use Carbon\Carbon;
    $experience_year = Carbon::createFromFormat('Y-m-d', $staff->experience)->year
@endphp

@section('content')
    <div class="container">
        <div class="row mb-3 justify-content-center">
            <div class="col-md">
                <div class="card">
                    <h5 class="card-header">{{ $staff->last_name }} {{ $staff->first_name }} {{ $staff->patronym }}</h5>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <img class="w-100 mb-1" src="{{ $staff->photo_path ? asset('storage/' . $staff_member->photo_path) : asset('storage/staff_photos/staff_default.jpg') }}">
                                    <h5 class="text-center">{{ $staff->last_name }} {{ $staff->first_name }} {{ $staff->patronym }}, {{ __($staff->staff_type) }}</h5>
                                </div>
                                <div class="col-md">
                                    <h4>Стаж работы с {{ $experience_year }} года.</h4>
                                    <h4>Специализации</h4>
                                    <p>{!! $staff->specialities !!}</p>
                                    <h4>Должности</h4>
                                    <ul>
                                        @foreach ($staff->positions as $position)
                                            <li>{{ $position->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
