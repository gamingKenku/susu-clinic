
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
    <label for="specialities" class="col-form-label text-lg-end col-lg-2 col-xl-3">Специализации</label>
    <div class="col-lg-10 col-xl-9">
        <input class="quill-content" name="specialities" type="hidden" id="specialities" value="{{ old('specialities', optional($staff)->specialities) }}">
        <div class="editor-container">
            <div class="quill-editor {{ $errors->has('specialities') ? ' is-invalid' : '' }}"></div>
        </div>           
        {!! $errors->first('specialities', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>


<div class="mb-3 row">
    <label for="experience" class="col-form-label text-lg-end col-lg-2 col-xl-3">Стаж работы</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('experience') ? ' is-invalid' : '' }}" name="experience" type="date" id="experience" value="{{ old('experience', optional($staff)->experience) }}" required="true" placeholder="Введите стаж работы сотрудника...">
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

<div class="mb-3 row">
    <label for="positions[]" class="col-form-label text-lg-end col-lg-2 col-xl-3">Должности</label>
    <div class="col-lg-10 col-xl-9">
        <select multiple class="selectpicker form-control {{ $errors->has('positions') ? ' is-invalid' : '' }}" id="positions"
            name="positions[]" required="true">
            {{-- <option value="" style="display: none;" {{ old('category_id', optional($position)->category_id ?: '') == '' ? 'selected' : '' }} disabled selected>Выберите категорию...</option> --}}
            @if ($staff != null)
                @foreach ($positions as $key => $position)
                    <option value="{{ $position->id }}" {{ in_array($position->id, $staff->positions->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $position->name }}
                    </option>
                @endforeach
            @elseif (old('positions') != null)
                @foreach ($positions as $key => $position)
                    <option value="{{ $position->id }}" {{ in_array($position->id, old('positions')) ? 'selected' : '' }}>
                        {{ $position->name }} 
                    </option>
                @endforeach
            @else
                @foreach ($positions as $key => $position)
                    <option value="{{ $position->id }}">
                        {{ $position->name }} 
                    </option>
                @endforeach   
            @endif
        </select>

        {!! $errors->first('positions', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="photo_path" class="col-form-label text-lg-end col-lg-2 col-xl-3">Фотография</label>
    <div class="col-lg-10 col-xl-9 d-flex flex-column align-items-start">
        <input {{ optional($staff)->photo_path ? 'disabled hidden' : '' }} class="form-control {{ $errors->has('photo_path') ? ' is-invalid' : '' }}" name="photo_path" type="file" id="photo_path" maxlength="255" placeholder="Вставьте фотографию сотрудника...">
        {!! $errors->first('photo_path', '<div class="invalid-feedback">:message</div>') !!}
        @if(optional($staff)->photo_path)
            <img name="resource-file" id="resource-file" src="{{ asset("storage/" . $staff->photo_path) }}" alt="{{ $staff->photo_path }}" class="mt-3">
        @endif
        <button type="button" {{ optional($staff)->photo_path ? '' : 'disabled hidden' }} name="change-file-btn" id="change-file-btn" class="btn btn-primary mt-3 mb-3">Сбросить фотографию</button>
        <input class="form-check-input" name="keep_file" type="checkbox" id="keep_file" value="1" minlength="1" required="true" readonly hidden selected>
    </div>
</div>


{{-- @if($staff)
    <div class="mb-3 row">
        <label for="keep_file" class="col-form-label text-lg-end col-lg-2 col-xl-3">Не менять картинку</label>
        <div class="col-lg-10 col-xl-9">
            <input class="form-check-input{{ $errors->has('keep_file') ? ' is-invalid' : '' }}" name="keep_file" type="checkbox" id="keep_file" value="1" minlength="1" required="true" checked>
            {!! $errors->first('keep_file', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
@endif --}}
