
<div class="mb-3 row">
    <label for="address" class="col-form-label text-lg-end col-lg-2 col-xl-3">Address</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" type="text" id="address" value="{{ old('address', optional($clinics)->address) }}" minlength="1" maxlength="255" required="true" placeholder="Enter address here...">
        {!! $errors->first('address', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="name" class="col-form-label text-lg-end col-lg-2 col-xl-3">Name</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" type="text" id="name" value="{{ old('name', optional($clinics)->name) }}" minlength="1" maxlength="255" required="true" placeholder="Enter name here...">
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

