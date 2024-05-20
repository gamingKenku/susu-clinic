@extends('layouts.app')

@section('title')
    {{ $discount->header }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <h5 class="card-header">{{ $discount->header }}</h5>
                    <div class="card-body">
                        <div class="card-text">
                            {!! $discount->markup !!}
                        </div>
                        @if ($discount->services)
                            <p class="card-text">
                                Дествует на услуги:
                            </p>
                            <ol>
                                @foreach ($discount->services as $service)
                                    <li>{{ $service->name }} ({{ $service->category->name }})</li>
                                @endforeach
                            </ol>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
