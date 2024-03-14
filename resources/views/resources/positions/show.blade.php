@extends('layouts.admin')

@section('content')

<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($position->name) ? $position->name : 'Должность' }}</h4>
        <div>
            <form method="POST" action="{!! route('positions.destroy', $position->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('positions.edit', $position->id ) }}" class="btn btn-primary" title="Редактировать">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Удалить" onclick="return confirm(&quot;Click Ok to delete Position.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('positions.index') }}" class="btn btn-primary" title="Показать все">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('positions.create') }}" class="btn btn-secondary" title="Создать">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Название</dt>
            <dd class="col-lg-10 col-xl-9">{{ $position->name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Описание</dt>
            <dd class="col-lg-10 col-xl-9">{!! $position->description !!}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Обязанности</dt>
            <dd class="col-lg-10 col-xl-9">{!! $position->responsibilities !!}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Требования</dt>
            <dd class="col-lg-10 col-xl-9">{!! $position->requirements !!}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Условия</dt>
            <dd class="col-lg-10 col-xl-9">{!! $position->conditions !!}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Есть вакансия</dt>
            <dd class="col-lg-10 col-xl-9">{{ ($position->has_vacancy) ? 'Да' : 'Нет' }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Сотрудники</dt>
            <dd class="col-lg-10 col-xl-9">
                <ol>
                    @foreach ($position->staff as $staff)
                        <li>{{ $staff->first_name }} {{ $staff->last_name }} {{ $staff->patronym }}</li>
                    @endforeach
                </ol>
            </dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Дата создания</dt>
            <dd class="col-lg-10 col-xl-9">{{ $position->created_at }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Дата последнего обновления</dt>
            <dd class="col-lg-10 col-xl-9">{{ $position->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection