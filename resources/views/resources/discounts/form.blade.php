
<div class="mb-3 row">
    <label for="header" class="col-form-label text-lg-end col-lg-2 col-xl-3">Заголовок</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('header') ? ' is-invalid' : '' }}" name="header" type="text" id="header" value="{{ old('header', optional($discount)->header) }}" minlength="1" maxlength="255" required="true" placeholder="Введите заголовок...">
        {!! $errors->first('header', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="markup" class="col-form-label text-lg-end col-lg-2 col-xl-3">Содержание</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('markup') ? ' is-invalid' : '' }}" name="markup" type="text" id="markup" value="{{ old('markup', optional($discount)->markup) }}" minlength="1" maxlength="16777215" required="true" placeholder="Введите содержание...">
        {!! $errors->first('markup', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="services" class="col-form-label text-lg-end col-lg-2 col-xl-3">Действует на услуги</label>
    <div class="col-lg-10 col-xl-9">
        <select multiple class="selectpicker form-select{{ $errors->has('services') ? ' is-invalid' : '' }}" id="services"
            name="services[]" required="true">
            {{-- <option value="" style="display: none;" {{ old('category_id', optional($service)->category_id ?: '') == '' ? 'selected' : '' }} disabled selected>Выберите категорию...</option> --}}
            @if ($discount != null)
                @foreach ($services as $key => $service)
                    <option value="{{ $service->id }}" {{ in_array($service->id, $discount->services->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $service->name }} ({{ $service->category->name }})
                    </option>
                @endforeach
            @elseif (old('services') != null)
                @foreach ($services as $key => $service)
                    <option value="{{ $service->id }}" {{ in_array($service->id, old('service')) ? 'selected' : '' }}>
                        {{ $service->name }} ({{ $service->category->name }})
                    </option>
                @endforeach
            @else
                @foreach ($services as $key => $service)
                    <option value="{{ $service->id }}">
                        {{ $service->name }} ({{ $service->category->name }})
                    </option>
                @endforeach   
            @endif
        </select>

        {!! $errors->first('discounts', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="start_date" class="col-form-label text-lg-end col-lg-2 col-xl-3">Дата начала акции</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}" name="start_date" type="date" id="start_date" value="{{ old('start_date', optional($discount)->start_date) }}" placeholder="Введите дату начала акции...">
        {!! $errors->first('start_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="end_date" class="col-form-label text-lg-end col-lg-2 col-xl-3">Дата конца акции</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}" name="end_date" type="date" id="end_date" value="{{ old('end_date', optional($discount)->end_date) }}" placeholder="Введите дату окончания акции...">
        {!! $errors->first('end_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

