@extends('layouts.admin')

@section('content')

    <div class="card text-bg-theme">

        <div class="card-header justify-content-between align-items-center p-3">
            <h4 class="m-0">О нас</h4>
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

            <form method="POST" class="quill-form need-validation" novalidate action="{{ route('aboutUpdate') }}" name="edit_about_form" accept-charset="UTF-8" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">

                <div class="mb-3 row">
                    <label for="content" class="col-form-label text-lg-end col-lg-2 col-xl-3">Содержание</label>
                    <div class="col-lg-10 col-xl-9">
                        <input class="quill-content" name="content" type="hidden" id="content" value="{{ old('content', $about) }}">
                        <div class="editor-container">
                            <div class="quill-editor {{ $errors->has('content') ? ' is-invalid' : '' }}"></div>
                        </div>
                        {!! $errors->first('content', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>

                <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                    <input class="btn btn-primary" type="submit" value="Сохранить">
                </div>
            </form>
        </div>

    </div>
@endsection
