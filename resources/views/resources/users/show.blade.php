@extends('layouts.admin')

@section('content')

<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($title) ? $title : 'Пользователь' }}</h4>
        <div>
            <form method="POST" action="{!! route('users.destroy', $user->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('users.edit', $user->id ) }}" class="btn btn-primary" title="Редактировать">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Удалить" onclick="return confirm(&quot;Click Ok to delete User.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('users.index') }}" class="btn btn-primary" title="Просмотреть">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('users.create') }}" class="btn btn-secondary" title="Создать">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Имя пользователя</dt>
            <dd class="col-lg-10 col-xl-9">{{ $user->username }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Адрес электронной почты</dt>
            <dd class="col-lg-10 col-xl-9">{{ $user->email }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Имя</dt>
            <dd class="col-lg-10 col-xl-9">{{ $user->first_name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Фамилия</dt>
            <dd class="col-lg-10 col-xl-9">{{ $user->last_name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Отчество</dt>
            <dd class="col-lg-10 col-xl-9">{{ $user->patronym }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Дата создания</dt>
            <dd class="col-lg-10 col-xl-9">{{ $user->created_at }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Дата последнего обновления</dt>
            <dd class="col-lg-10 col-xl-9">{{ $user->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection