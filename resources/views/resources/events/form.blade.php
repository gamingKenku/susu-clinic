
<div class="mb-3 row">
    <label for="header" class="col-form-label text-lg-end col-lg-2 col-xl-3">Заголовок</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('header') ? ' is-invalid' : '' }}" name="header" type="text" id="header" value="{{ old('header', optional($event)->header) }}" minlength="1" maxlength="255" required="true" placeholder="Введите заголовок...">
        {!! $errors->first('header', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="content" class="col-form-label text-lg-end col-lg-2 col-xl-3">Содержание</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" type="text" id="content" value="{{ old('content', optional($event)->content) }}" minlength="1" maxlength="16777215" required="true" placeholder="Введите содержание...">
        {!! $errors->first('content', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="picture_path" class="col-form-label text-lg-end col-lg-2 col-xl-3">Картинка</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('picture_path') ? ' is-invalid' : '' }}" name="picture_path" type="text" id="picture_path" value="{{ old('picture_path', optional($event)->picture_path) }}" maxlength="255" placeholder="Вставьте картинку...">
        {!! $errors->first('picture_path', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

