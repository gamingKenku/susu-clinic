<div class="mb-3 row">
    <label for="name" class="col-form-label text-lg-end col-lg-2 col-xl-3">Название</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" type="text"
            id="name" value="{{ old('name', optional($service)->name) }}" minlength="1" maxlength="255"
            required="true" placeholder="Введите название...">
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="price" class="col-form-label text-lg-end col-lg-2 col-xl-3">Цена</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" type="number"
            id="price" value="{{ old('price', optional($service)->price) }}" min="0" max="999999"
            required="true" placeholder="Введите цену..." step="0.01">
        {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="category_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Категория</label>
    <div class="col-lg-10 col-xl-9">
        <select class="selectpicker form-select{{ $errors->has('category_id') ? ' is-invalid' : '' }}" id="category_id"
            name="category_id" required="true">
            <option value="" style="display: none;"
                {{ old('category_id', optional($service)->category_id ?: '') == '' ? 'selected' : '' }} disabled
                selected>Выберите категорию...</option>
            @foreach ($categories as $key => $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', optional($service)->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        {!! $errors->first('category_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="discounts" class="col-form-label text-lg-end col-lg-2 col-xl-3">Акции</label>
    <div class="col-lg-10 col-xl-9">
        <select multiple class="selectpicker form-select{{ $errors->has('discounts') ? ' is-invalid' : '' }}" id="discounts"
            name="discounts[]" required="true">
            {{-- <option value="" style="display: none;" {{ old('category_id', optional($service)->category_id ?: '') == '' ? 'selected' : '' }} disabled selected>Выберите категорию...</option> --}}
            @if ($service != null)
                @foreach ($discounts as $key => $discount)
                    <option value="{{ $discount->id }}" {{ in_array($discount->id, $service->discounts->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ "$discount->header ($discount->created_at)" }}
                    </option>
                @endforeach
            @elseif (old('discounts') != null)
                @foreach ($discounts as $key => $discount)
                    <option value="{{ $discount->id }}" {{ in_array($discount->id, old('discounts')) ? 'selected' : '' }}>
                        {{ "$discount->header ($discount->created_at)" }}
                    </option>
                @endforeach
            @else
                @foreach ($discounts as $key => $discount)
                    <option value="{{ $discount->id }}">
                        {{ "$discount->header ($discount->created_at)" }}
                    </option>
                @endforeach   
            @endif
        </select>

        {!! $errors->first('discounts', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
