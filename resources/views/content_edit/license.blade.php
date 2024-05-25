@extends('layouts.admin')

@section('content')

    <div class="card text-bg-theme">

        <div class="card-header justify-content-between align-items-center p-3">
            <h4 class="m-0">Лицензия</h4>
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

            <form method="POST" class="quill-form need-validation" novalidate action="{{ route('licenseUpdate') }}"
                name="edit_license_form" accept-charset="UTF-8" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">

                <div class="mb-3 row">
                    <label for="license" class="col-form-label text-lg-end col-lg-2 col-xl-3">Файл лицензии</label>
                    <div class="col-lg-10 col-xl-9 d-flex flex-column align-items-start">
                        <input class="form-control {{ $errors->has('license') ? ' is-invalid' : '' }}" name="license"
                            type="file" id="license" maxlength="255" placeholder="Вставьте файл лицензии...">
                        {!! $errors->first('license', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                        <input class="btn btn-primary" type="submit" value="Сохранить">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                        <p>Сохранение приведет к перезаписи файла на сохраненный. Текущий файл можно просмотреть по <a
                                href="{{ route('licenseShow') }}">ссылке</a>.</p>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
