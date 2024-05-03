@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md">

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul class="list-unstyled mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" class="needs-validation" novalidate action="{{ route('feedbackStore') }}"
                    accept-charset="UTF-8">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="author" class="form-label">Ваше имя</label>
                        <input name="author" type="text" value="{{ old('author') }}" class="form-control {{ $errors->has('author') ? ' is-invalid' : '' }}"
                            id="author" required>
                        {!! $errors->first('author', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="mb-3">
                        <label for="mail" class="form-label">Адрес электронной почты</label>
                        <input name="mail" type="email" value="{{ old('mail') }}" class="form-control {{ $errors->has('mail') ? ' is-invalid' : '' }}"
                            id="mail" required>
                        {!! $errors->first('mail', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Отзыв</label>
                        <textarea name="content" class="form-control {{ $errors->has('content') ? ' is-invalid' : '' }}" id="content" rows="3"
                            required>{{ old('content') }}</textarea>
                        {!! $errors->first('content', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Рейтинг (нажмите для звезду для отметки)</label>
                        <input id="rating" name="rating" type="hidden" value="{{ old('rating') }}" class="form-control {{ $errors->has('rating') ? ' is-invalid' : '' }}"
                            id="rating" min="1" max="5" required>
                        <div id="rating-stars">
                            <span data-index="1" class="fa fa-star rating-star @if(old('rating') >= 1) checked @endif"></span>
                            <span data-index="2" class="fa fa-star rating-star @if(old('rating') >= 2) checked @endif"></span>
                            <span data-index="3" class="fa fa-star rating-star @if(old('rating') >= 3) checked @endif"></span>
                            <span data-index="4" class="fa fa-star rating-star @if(old('rating') >= 4) checked @endif"></span>
                            <span data-index="5" class="fa fa-star rating-star @if(old('rating') >= 5) checked @endif"></span>
                        </div>
                        {!! $errors->first('rating', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
