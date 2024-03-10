
<div class="mb-3 row">
    <label for="name" class="col-form-label text-lg-end col-lg-2 col-xl-3">Название</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" type="text" id="name" value="{{ old('name', optional($service)->name) }}" minlength="1" maxlength="255" required="true" placeholder="Введите название...">
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="price" class="col-form-label text-lg-end col-lg-2 col-xl-3">Цена</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" type="number" id="price" value="{{ old('price', optional($service)->price) }}" min="-999999" max="999999" required="true" placeholder="Введите цену..." step="any">
        {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="category_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Категория</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('category_id') ? ' is-invalid' : '' }}" id="category_id" name="category_id" required="true">
        	    <option value="" style="display: none;" {{ old('category_id', optional($service)->category_id ?: '') == '' ? 'selected' : '' }} disabled selected>Выберите категорию...</option>
        	@foreach ($categories as $key => $category)
			    <option value="{{ $key }}" {{ old('category_id', optional($service)->category_id) == $key ? 'selected' : '' }}>
			    	{{ $category->name }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('category_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

