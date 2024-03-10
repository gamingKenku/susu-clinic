
<div class="mb-3 row">
    <label for="username" class="col-form-label text-lg-end col-lg-2 col-xl-3">Имя пользователя</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" type="text" id="username" value="{{ old('username', optional($user)->username) }}" minlength="1" maxlength="255" required="true" placeholder="Введите имя пользователя...">
        {!! $errors->first('username', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

@if (Route::current()->getName() === 'users.edit')
<div class="mb-3 row">
    <label for="old_password" class="col-form-label text-lg-end col-lg-2 col-xl-3">Старый пароль</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="old_password" type="password" id="old_password" value="" minlength="1" maxlength="255" required="true" placeholder="Введите старый пароль...">
        {!! $errors->first('old_password', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
@endif

<div class="mb-3 row">
    <label for="password" class="col-form-label text-lg-end col-lg-2 col-xl-3">Пароль</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" type="password" id="password" value="" minlength="1" maxlength="255" required="true" placeholder="Введите пароль...">
        {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="password_confirmation" class="col-form-label text-lg-end col-lg-2 col-xl-3">Подтвердите пароль</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password_confirmation" type="password" id="password_confirmation" value="" minlength="1" maxlength="255" required="true" placeholder="Подтвердите пароль...">
        {!! $errors->first('password_confirmation', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="email" class="col-form-label text-lg-end col-lg-2 col-xl-3">Адрес электронной почты</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" type="text" id="email" value="{{ old('email', optional($user)->email) }}" minlength="1" maxlength="255" required="true" placeholder="Введите адрес электронной почты...">
        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="first_name" class="col-form-label text-lg-end col-lg-2 col-xl-3">Имя</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" type="text" id="first_name" value="{{ old('first_name', optional($user)->first_name) }}" minlength="1" maxlength="255" required="true" placeholder="Введите имя пользователя...">
        {!! $errors->first('first_name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="last_name" class="col-form-label text-lg-end col-lg-2 col-xl-3">Фамилия</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" type="text" id="last_name" value="{{ old('last_name', optional($user)->last_name) }}" minlength="1" maxlength="255" required="true" placeholder="Введите фамилию пользователя...">
        {!! $errors->first('last_name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="patronym" class="col-form-label text-lg-end col-lg-2 col-xl-3">Отчество</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('patronym') ? ' is-invalid' : '' }}" name="patronym" type="text" id="patronym" value="{{ old('patronym', optional($user)->patronym) }}" maxlength="255" placeholder="Введите отчество пользователя...">
        {!! $errors->first('patronym', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
