
<div class="mb-3 row">
    <label for="name" class="col-form-label text-lg-end col-lg-2 col-xl-3">Название</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" type="text" id="name" value="{{ old('name', optional($clinic)->name) }}" minlength="1" maxlength="255" required="true" placeholder="Введите название...">
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="address" class="col-form-label text-lg-end col-lg-2 col-xl-3">Адрес</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" type="text" id="address" value="{{ old('address', optional($clinic)->address) }}" minlength="1" maxlength="255" required="true" placeholder="Введите адрес...">
        {!! $errors->first('address', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
