@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <p class="card-text fs-5">Здравствуйте, {{ auth()->user()->last_name }} {{ auth()->user()->first_name }} {{ auth()->user()->patronym }}</p>
                    <p class="card-text fs-5">На данный момент модерации ожидают <span class="fw-bold">{{ $unmodded_feedback_count }}</span> отзывов.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection