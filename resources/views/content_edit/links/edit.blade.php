@extends('layouts.admin')

@section('content')

    <div class="card text-bg-theme">

        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">{{ !empty($link->title) ? $link->title : 'Ссылка' }}</h4>
            <div>
                <a href="{{ route('links.index') }}" class="btn btn-primary" title="Показать все">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('links.create') }}" class="btn btn-secondary" title="Создать">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>
            </div>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul class="list-unstyled mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" class="needs-validation" novalidate action="{{ route('links.update', $link->id) }}"
                id="edit_link_form" name="edit_link_form" accept-charset="UTF-8">

                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                
                <div class="mb-3 row">
                    <label for="link" class="col-form-label text-lg-end col-lg-2 col-xl-3">Адрес ссылки</label>
                    <div class="col-lg-10 col-xl-9">
                        <input class="form-control {{ $errors->has('link') ? ' is-invalid' : '' }}" name="link"
                            type="text" id="link" value="{{ old('link', optional($link)->link) }}" minlength="1"
                            maxlength="255" required="true" placeholder="Введите адрес ссылки...">
                        {!! $errors->first('link', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="title" class="col-form-label text-lg-end col-lg-2 col-xl-3">Название ссылки</label>
                    <div class="col-lg-10 col-xl-9">
                        <input class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"
                            type="text" id="title" value="{{ old('title', optional($link)->title) }}" minlength="1"
                            maxlength="255" required="true" placeholder="Введите название ссылки...">
                        {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>

                <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                    <input class="btn btn-primary" type="submit" value="Обновить">
                </div>
                
            </form>

        </div>
    </div>

@endsection
