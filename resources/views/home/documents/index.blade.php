@extends('layouts.app')

@section('title')
    Документы
@endsection

@section('content')
<div class="container">
    <h3 class="mb-3">Документы</h3>
    <div class="row">
        <div class="col-md">
            @foreach ($documents as $document)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $document->name }}</h5>
                        <a href="{{ route('documentsShow', $document->id) }}" role="button" class="btn btn-primary">Показать</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection