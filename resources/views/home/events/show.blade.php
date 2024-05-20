@extends('layouts.app')

@section('title')
    {{ $event->header }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md">
                                <h4 class="card-title">{{ $event->header }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg mb-3">
                                <div class="card-text">
                                    {!! $event->content !!}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <img class="w-100 mb-1" src="{{ $event->picture_path ? asset('storage/' . $event->picture_path) : asset('storage/event_pictures/event_default.jpg') }}" alt="">
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection