
<div class="mb-3 row">
    <label for="weekday" class="col-form-label text-lg-end col-lg-2 col-xl-3">День недели</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('weekday') ? ' is-invalid' : '' }}" name="weekday" type="number" id="weekday" value="{{ old('weekday', optional($workingHours)->weekday) }}" min="-2147483648" max="2147483647" required="true" placeholder="Enter weekday here...">
        {!! $errors->first('weekday', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="start_time" class="col-form-label text-lg-end col-lg-2 col-xl-3">Start Time</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('start_time') ? ' is-invalid' : '' }}" name="start_time" type="text" id="start_time" value="{{ old('start_time', optional($workingHours)->start_time) }}" required="true" placeholder="Enter start time here...">
        {!! $errors->first('start_time', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="end_time" class="col-form-label text-lg-end col-lg-2 col-xl-3">End Time</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('end_time') ? ' is-invalid' : '' }}" name="end_time" type="text" id="end_time" value="{{ old('end_time', optional($workingHours)->end_time) }}" required="true" placeholder="Enter end time here...">
        {!! $errors->first('end_time', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="staff_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Staff</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('staff_id') ? ' is-invalid' : '' }}" id="staff_id" name="staff_id" required="true">
        	    <option value="" style="display: none;" {{ old('staff_id', optional($workingHours)->staff_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select staff</option>
        	@foreach ($Staff as $key => $Staff)
			    <option value="{{ $key }}" {{ old('staff_id', optional($workingHours)->staff_id) == $key ? 'selected' : '' }}>
			    	{{ $Staff }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('staff_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

