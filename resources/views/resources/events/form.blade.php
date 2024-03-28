
<div class="mb-3 row">
    <label for="header" class="col-form-label text-lg-end col-lg-2 col-xl-3">Заголовок</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('header') ? ' is-invalid' : '' }}" name="header" type="text" id="header" value="{{ old('header', optional($event)->header) }}" minlength="1" maxlength="255" required="true" placeholder="Введите заголовок...">
        {!! $errors->first('header', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

{{-- <div class="mb-3 row">
    <label for="content" class="col-form-label text-lg-end col-lg-2 col-xl-3">Содержание</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" type="text" id="content" value="{{ old('content', optional($event)->content) }}" minlength="1" maxlength="16777215" required="true" placeholder="Введите содержание...">
        {!! $errors->first('content', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div> --}}

<div class="mb-3 row">
    <label for="content" class="col-form-label text-lg-end col-lg-2 col-xl-3">Содержание</label>
    <div class="col-lg-10 col-xl-9">
        <input class="quill-content" name="content" type="hidden" id="content" value="{{ old('content', optional($event)->content) }}">
        <div class="editor-container">
            <div class="quill-editor {{ $errors->has('content') ? ' is-invalid' : '' }}"></div>
        </div>
        {!! $errors->first('content', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="picture_path" class="col-form-label text-lg-end col-lg-2 col-xl-3">Картинка</label>
    <div class="col-lg-10 col-xl-9 d-flex flex-column align-items-start">
        <input {{ optional($event)->picture_path ? 'disabled hidden' : '' }} class="form-control{{ $errors->has('picture_path') ? ' is-invalid' : '' }}" name="picture_path" type="file" id="picture_path" maxlength="255" placeholder="Вставьте картинку...">
        {!! $errors->first('picture_path', '<div class="invalid-feedback">:message</div>') !!}
        @if(optional($event)->picture_path)
            <img name="resource-file" id="resource-file" src="{{ asset("storage/" . $event->picture_path) }}" alt="{{ $event->picture_path }}" class="mt-3">
        @endif
        <button type="button" {{ optional($event)->picture_path ? '' : 'disabled hidden' }} name="change-file-btn" id="change-file-btn" class="btn btn-primary mt-3 mb-3">Сбросить картинку</button>
        <input class="form-check-input" name="keep_file" type="checkbox" id="keep_file" value="1" minlength="1" required="true" readonly hidden selected>
    </div>
</div>

{{-- @if($event)
    <div class="mb-3 row">
        <label for="keep_file" class="col-form-label text-lg-end col-lg-2 col-xl-3">Не менять картинку</label>
        <div class="col-lg-10 col-xl-9">
            <input class="form-check-input{{ $errors->has('keep_file') ? ' is-invalid' : '' }}" name="keep_file" type="checkbox" id="keep_file" value="1" minlength="1" required="true" checked>
            {!! $errors->first('keep_file', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
@endif --}}

