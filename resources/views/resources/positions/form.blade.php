
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
        <input class="quill-content" name="description" type="hidden" id="description" value="{{ old('description', optional($position)->description) }}">
        <div class="editor-container">
            <div class="quill-editor {{ $errors->has('description') ? ' is-invalid' : '' }}"></div>
        </div>
        {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="responsibilities" class="col-form-label text-lg-end col-lg-2 col-xl-3">Обязанности</label>
    <div class="col-lg-10 col-xl-9">
        <input class="quill-content" name="responsibilities" type="hidden" id="responsibilities" value="{{ old('responsibilities', optional($position)->responsibilities) }}">
        <div class="editor-container">
            <div class="quill-editor {{ $errors->has('responsibilities') ? ' is-invalid' : '' }}"></div>
        </div>
        {!! $errors->first('responsibilities', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="requirements" class="col-form-label text-lg-end col-lg-2 col-xl-3">Требования</label>
    <div class="col-lg-10 col-xl-9">
        <input class="quill-content" name="requirements" type="hidden" id="requirements" value="{{ old('requirements', optional($position)->requirements) }}">
        <div class="editor-container">
            <div class="quill-editor {{ $errors->has('requirements') ? ' is-invalid' : '' }}"></div>
        </div>        
        {!! $errors->first('requirements', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="conditions" class="col-form-label text-lg-end col-lg-2 col-xl-3">Условия</label>
    <div class="col-lg-10 col-xl-9">
        <input class="quill-content" name="conditions" type="hidden" id="conditions" value="{{ old('conditions', optional($position)->conditions) }}">
        <div class="editor-container">
            <div class="quill-editor {{ $errors->has('conditions') ? ' is-invalid' : '' }}"></div>
        </div>        
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

<div class="mb-3 row">
    <label for="staff[]" class="col-form-label text-lg-end col-lg-2 col-xl-3">Сотрудники на должности</label>
    <div class="col-lg-10 col-xl-9">
        <select multiple class="selectpicker form-control {{ $errors->has('staff') ? ' is-invalid' : '' }}" id="staff"
            name="staff[]" required="true">
            {{-- <option value="" style="display: none;" {{ old('category_id', optional($staff)->category_id ?: '') == '' ? 'selected' : '' }} disabled selected>Выберите категорию...</option> --}}
            @if ($position != null)
                @foreach ($staff as $key => $staffMember)
                    <option value="{{ $staffMember->id }}" {{ in_array($staffMember->id, $position->staff->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $staffMember->first_name }} {{ $staffMember->last_name }} {{ $staffMember->patronym }}
                    </option>
                @endforeach
            @elseif (old('staff') != null)
                @foreach ($staff as $key => $staffMember)
                    <option value="{{ $staffMember->id }}" {{ in_array($staffMember->id, old('staff')) ? 'selected' : '' }}>
                        {{ $staffMember->first_name }} {{ $staffMember->last_name }} {{ $staffMember->patronym }}
                    </option>
                @endforeach
            @else
                @foreach ($staff as $key => $staffMember)
                    <option value="{{ $staffMember->id }}">
                        {{ $staffMember->first_name }} {{ $staffMember->last_name }} {{ $staffMember->patronym }}
                    </option>
                @endforeach   
            @endif
        </select>

        {!! $errors->first('staff', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
