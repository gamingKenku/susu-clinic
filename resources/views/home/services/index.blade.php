@extends('layouts.app')

@section('title')
    Услуги
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-0 mb-md-3">
            <div class="col-md d-flex flex-md-row flex-column">
                @if(!Request::input('filter'))
                    @foreach ($clinics as $clinic)
                        <button data-clinic-name="{{ $clinic->name }}" class="btn @if($loop->index == 0) btn-primary @else btn-secondary @endif me-0 me-md-3 mb-3 mb-md-0 clinic-filter-btn"
                            data-clinic-name="{{ $clinic->name }}" type="button">{{ $clinic->name }}</button>
                    @endforeach
                @else
                    @foreach ($clinics as $clinic)
                        <button data-clinic-name="{{ $clinic->name }}" class="btn @if(Request::input('filter') == $clinic->name) btn-primary @else btn-secondary @endif me-0 me-md-3 mb-3 mb-md-0 clinic-filter-btn"
                            data-clinic-name="{{ $clinic->name }}" type="button">{{ $clinic->name }}</button>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="row justify-content-center mb-0 mb-md-3">
            <div class="col-12 col-md-4 col-lg-3 mb-3 d-flex">
                <div class="card flex-grow-1">
                    <div class="card-header">Категории услуг</div>
                    <div class="card-body">
                        @foreach ($categories as $category)
                            <button data-category-id="{{ $category->id }}" class="btn btn-category w-100 mb-1 text-start @if(Request::input('category') == $category->id) btn-primary @else btn-secondary @endif">{{ $category->name }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md mb-3 d-flex">
                <div id="services-card" class="card flex-grow-1 @if(!Request::input('category')) d-none @endif">
                    <div class="card-header">Услуги</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="w-50">Название</th>
                                        <th class="w-50">Цена</th>
                                        {{-- <th>Категория</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($services as $service)
                                        <tr data-service-category="{{ $service->category->id }}" class="@if(Request::input('category') != $service->category->id) d-none @endif service-row">
                                            <td>{{ $service->name }}</td>
                                            <td>{{ $service->price }}</td>
                                            {{-- <td>{{ $service->category->name }}</td> --}}
                                        </tr>   
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>
@endsection
