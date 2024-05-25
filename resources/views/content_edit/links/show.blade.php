@extends('layouts.admin')

@section('content')

<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($link->title) ? $link->title : 'Ссылка' }}</h4>
        <div>
            <form method="POST" action="{!! route('links.destroy', $link->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('links.edit', $link->id ) }}" class="btn btn-primary" title="Редактировать">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Удалить" onclick="return confirm(&quot;Click Ok to delete Link.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('links.index') }}" class="btn btn-primary" title="Показать все">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('links.create') }}" class="btn btn-secondary" title="Создать">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Название</dt>
            <dd class="col-lg-10 col-xl-9">{{ $link->title }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Адрес ссылки</dt>
            <dd class="col-lg-10 col-xl-9"><a href="{{ $link->link }}">{{ $link->link }}</a></dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Создано в</dt>
            <dd class="col-lg-10 col-xl-9">{{ $link->created_at }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Обновлено в</dt>
            <dd class="col-lg-10 col-xl-9">{{ $link->updated_at }}</dd>
        </dl>
    </div>
</div>

@endsection