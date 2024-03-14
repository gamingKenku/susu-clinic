
<div class="mb-3 row">
    <label for="name" class="col-form-label text-lg-end col-lg-2 col-xl-3">Название</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" type="text" id="name" value="{{ old('name', optional($document)->name) }}" minlength="1" maxlength="255" required="true" placeholder="Введите название...">
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="document_path" class="col-form-label text-lg-end col-lg-2 col-xl-3">Документ</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('document_path') ? ' is-invalid' : '' }}" name="document_path" type="file" id="document_path" value="{{ old('document_path', optional($document)->document_path) }}" minlength="1" maxlength="255" required="true" placeholder="Вставьте документ...">
        {!! $errors->first('document_path', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>


