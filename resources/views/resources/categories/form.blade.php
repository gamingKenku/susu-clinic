

<div class="mb-3 row">
    <label for="name" class="col-form-label text-lg-end col-lg-2 col-xl-3">Название</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" type="text" id="name" value="{{ old('name', optional($categories)->name) }}" minlength="1" maxlength="255" required="true" placeholder="Введите название категерии...">
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="clinic_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Клиника</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('clinic_id') ? ' is-invalid' : '' }}" id="clinic_id" name="clinic_id" required="true">
        	    <option value="" style="display: none;" {{ old('clinic_id', optional($categories)->clinic_id ?: '') == '' ? 'selected' : '' }} disabled selected>Выберите клинику</option>
        	@foreach ($clinics as $key => $clinic)
			    <option value="{{ $key }}" {{ old('clinic_id', optional($categories)->clinic_id) == $key ? 'selected' : '' }}>
			    	{{ $clinic->name }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('clinic_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>


