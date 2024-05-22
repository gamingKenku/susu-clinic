@extends('layouts.app')

@section('title')
    Скидки на медицинские услуги
@endsection

@php
    use Carbon\Carbon;
@endphp

@section('content')
    <div class="container">
        <h3 class="mb-3">Действующие акции</h3>
        <div class="row justify-content-center">
            <div class="col-md">
                @foreach ($discounts as $discount)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $discount->header }}</h5>
                            <div class="card-text">
                                {!! $discount->markup !!}
                            </div>
                            @if ($discount->services)
                                <p class="card-text">
                                    Дествует на услуги:
                                <ol>
                                    @foreach ($discount->services as $service)
                                        <li>{{ $service->name }} ({{ $service->category->name }})</li>
                                    @endforeach
                                </ol>
                                </p>
                            @endif
                            @php
                                $start_date_string = Carbon::createFromFormat('Y-m-d', $discount->start_date)->format(
                                    'd.m.Y',
                                );
                                $end_date_string = Carbon::createFromFormat('Y-m-d', $discount->end_date)->format(
                                    'd.m.Y',
                                );
                            @endphp
                            <p class="card-text"><small class="text-muted">Акция действует с {{ $start_date_string }} по
                                    {{ $end_date_string }}</small></p>
                        </div>
                    </div>
                @endforeach

                {!! $discounts->links() !!}
            </div>
        </div>
    </div>
@endsection
