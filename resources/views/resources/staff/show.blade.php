@extends('layouts.admin')

@section('content')

<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($title) ? $title : 'Сотрудник' }}</h4>
        <div>
            <form method="POST" action="{!! route('staff.destroy', $staff->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('staff.edit', $staff->id ) }}" class="btn btn-primary" title="Редактировать">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Удалить" onclick="return confirm(&quot;Click Ok to delete Staff.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('staff.index') }}" class="btn btn-primary" title="Показать все">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('staff.create') }}" class="btn btn-secondary" title="Создать">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Имя</dt>
            <dd class="col-lg-10 col-xl-9">{{ $staff->first_name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Фамилия</dt>
            <dd class="col-lg-10 col-xl-9">{{ $staff->last_name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Отчество</dt>
            <dd class="col-lg-10 col-xl-9">{{ $staff->patronym }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Специализации</dt>
            <dd class="col-lg-10 col-xl-9">{{ $staff->specialities }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Фотография</dt>
            <dd class="col-lg-10 col-xl-9">{{ $staff->photo_path }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Стаж работы</dt>
            <dd class="col-lg-10 col-xl-9">{{ $staff->experience }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Тип сотрудника</dt>
            <dd class="col-lg-10 col-xl-9">{{ __(ucfirst($staff->staff_type)) }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Дата создания</dt>
            <dd class="col-lg-10 col-xl-9">{{ $staff->created_at }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Дата последнего обновления</dt>
            <dd class="col-lg-10 col-xl-9">{{ $staff->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection