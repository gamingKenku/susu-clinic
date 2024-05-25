
<div class="mb-3 row">
    <label for="link" class="col-form-label text-lg-end col-lg-2 col-xl-3">Адрес ссылки</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control {{ $errors->has('link') ? ' is-invalid' : '' }}" name="link" type="text" id="link" value="{{ old('link', optional($link)->link) }}" minlength="1" maxlength="255" required="true" placeholder="Введите адрес ссылки...">
        {!! $errors->first('link', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="title" class="col-form-label text-lg-end col-lg-2 col-xl-3">Название ссылки</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" type="text" id="title" value="{{ old('title', optional($link)->title) }}" minlength="1" maxlength="255" required="true" placeholder="Введите название ссылки...">
        {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

