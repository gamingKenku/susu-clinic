@extends('layouts.admin')

@section('content')

<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($categories->name) ? $categories->name : 'Категории' }}</h4>
        <div>
            <form method="POST" action="{!! route('categories.destroy', $categories->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('categories.edit', $categories->id ) }}" class="btn btn-primary" title="Редактировать">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Удалить" onclick="return confirm(&quot;Click Ok to delete Categories.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('categories.index') }}" class="btn btn-primary" title="Просмотреть">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('categories.create') }}" class="btn btn-secondary" title="Создать">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Клиника</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($categories->Clinic)->name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Название</dt>
            <dd class="col-lg-10 col-xl-9">{{ $categories->name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Дата создания</dt>
            <dd class="col-lg-10 col-xl-9">{{ $categories->created_at }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Дата обновления</dt>
            <dd class="col-lg-10 col-xl-9">{{ $categories->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection