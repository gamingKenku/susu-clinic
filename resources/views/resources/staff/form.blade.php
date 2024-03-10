
<div class="mb-3 row">
    <label for="first_name" class="col-form-label text-lg-end col-lg-2 col-xl-3">Имя</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" type="text" id="first_name" value="{{ old('first_name', optional($staff)->first_name) }}" minlength="1" maxlength="255" required="true" placeholder="Введите имя сотрудника...">
        {!! $errors->first('first_name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="last_name" class="col-form-label text-lg-end col-lg-2 col-xl-3">Фамилия</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" type="text" id="last_name" value="{{ old('last_name', optional($staff)->last_name) }}" minlength="1" maxlength="255" required="true" placeholder="Введите фамилию сотрудника...">
        {!! $errors->first('last_name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="patronym" class="col-form-label text-lg-end col-lg-2 col-xl-3">Отчество</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('patronym') ? ' is-invalid' : '' }}" name="patronym" type="text" id="patronym" value="{{ old('patronym', optional($staff)->patronym) }}" maxlength="255" placeholder="Введите отчество сотрудника...">
        {!! $errors->first('patronym', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="specialities" class="col-form-label text-lg-end col-lg-2 col-xl-3">Специализация</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('specialities') ? ' is-invalid' : '' }}" name="specialities" type="text" id="specialities" value="{{ old('specialities', optional($staff)->specialities) }}" minlength="1" maxlength="16777215" required="true" placeholder="Введите специализации сотрудника...">
        {!! $errors->first('specialities', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="photo_path" class="col-form-label text-lg-end col-lg-2 col-xl-3">Фотография</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('photo_path') ? ' is-invalid' : '' }}" name="photo_path" type="text" id="photo_path" value="{{ old('photo_path', optional($staff)->photo_path) }}" maxlength="255" placeholder="Вставьте фотографию сотрудника...">
        {!! $errors->first('photo_path', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="experience" class="col-form-label text-lg-end col-lg-2 col-xl-3">Стаж работы</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('experience') ? ' is-invalid' : '' }}" name="experience" type="text" id="experience" value="{{ old('experience', optional($staff)->experience) }}" required="true" placeholder="Введите стаж работы сотрудника...">
        {!! $errors->first('experience', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="staff_type" class="col-form-label text-lg-end col-lg-2 col-xl-3">Тип сотрудника</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('staff_type') ? ' is-invalid' : '' }}" id="staff_type" name="staff_type" required="true">
        	    <option value="" style="display: none;" {{ old('staff_type', optional($staff)->staff_type ?: '') == '' ? 'selected' : '' }} disabled selected>Выберите тип сотрудника...</option>
        	@foreach (['doctor' => 'Врач',
                        'nurse' => 'Медсестра/медбрат',
                        'administrator' => 'Руководство'] as $key => $text)
			    <option value="{{ $key }}" {{ old('staff_type', optional($staff)->staff_type) == $key ? 'selected' : '' }}>
			    	{{ $text }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('staff_type', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

