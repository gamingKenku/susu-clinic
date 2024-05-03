@extends('layouts.app')

@section('title')
    Скидки на медицинские услуги
@endsection

@php
    use Carbon\Carbon;
@endphp

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md">
                @foreach ($discounts as $discount)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $discount->header }}</h5>
                            <p class="card-text">{!! $discount->markup !!}</p>
                            @php
                                $start_date_string = Carbon::createFromFormat('Y-m-d', $discount->start_date)->format('d.m.Y');
                                $end_date_string = Carbon::createFromFormat('Y-m-d', $discount->end_date)->format('d.m.Y');
                            @endphp
                            <p class="card-text"><small class="text-muted">Акция действует с {{ $start_date_string }} по {{ $end_date_string }}</small></p>
                        </div>
                    </div>
                @endforeach

                {!! $discounts->links() !!}
            </div>
        </div>
    </div>
@endsection
