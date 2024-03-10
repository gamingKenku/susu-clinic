
<div class="mb-3 row">
    <label for="name" class="col-form-label text-lg-end col-lg-2 col-xl-3">Название</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" type="text" id="name" value="{{ old('name', optional($position)->name) }}" minlength="1" maxlength="255" required="true" placeholder="Введите название...">
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="description" class="col-form-label text-lg-end col-lg-2 col-xl-3">Описание</label>
    <div class="col-lg-10 col-xl-9">
        <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description" required="true">{{ old('description', optional($position)->description) }}</textarea>
        {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="responsibilities" class="col-form-label text-lg-end col-lg-2 col-xl-3">Обязанности</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('responsibilities') ? ' is-invalid' : '' }}" name="responsibilities" type="text" id="responsibilities" value="{{ old('responsibilities', optional($position)->responsibilities) }}" minlength="1" maxlength="16777215" required="true" placeholder="Введите обязанности...">
        {!! $errors->first('responsibilities', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="requirements" class="col-form-label text-lg-end col-lg-2 col-xl-3">Требования</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('requirements') ? ' is-invalid' : '' }}" name="requirements" type="text" id="requirements" value="{{ old('requirements', optional($position)->requirements) }}" minlength="1" maxlength="16777215" required="true" placeholder="Введите требования...">
        {!! $errors->first('requirements', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="conditions" class="col-form-label text-lg-end col-lg-2 col-xl-3">Условия</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('conditions') ? ' is-invalid' : '' }}" name="conditions" type="text" id="conditions" value="{{ old('conditions', optional($position)->conditions) }}" minlength="1" maxlength="16777215" required="true" placeholder="Введите условия...">
        {!! $errors->first('conditions', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="has_vacancy" class="col-form-label text-lg-end col-lg-2 col-xl-3">Есть вакансия</label>
    <div class="col-lg-10 col-xl-9">
        <div class="form-check checkbox">
            <input id="has_vacancy_1" class="form-check-input" name="has_vacancy" type="checkbox" value="1" {{ old('has_vacancy', optional($position)->has_vacancy) == '1' ? 'checked' : '' }}>
            <label class="form-check-label" for="has_vacancy_1">
                Да
            </label>
        </div>


        {!! $errors->first('has_vacancy', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

