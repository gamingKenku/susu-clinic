@extends('layouts.admin')

@section('content')

<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($event->header) ? $event->header : 'Новость' }}</h4>
        <div>
            <form method="POST" action="{!! route('events.destroy', $event->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('events.edit', $event->id ) }}" class="btn btn-info" title="Редактировать">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Удалить" onclick="return confirm(&quot;Click Ok to delete Event.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('events.index') }}" class="btn btn-info" title="Показать все">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('events.create') }}" class="btn btn-secondary" title="Создать">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Заголовок</dt>
            <dd class="col-lg-10 col-xl-9">{{ $event->header }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Содержание</dt>
            <dd class="col-lg-10 col-xl-9">{!! $event->content !!}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Картинка</dt>
            <dd class="col-lg-10 col-xl-9">{{ $event->picture_path }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Дата создания</dt>
            <dd class="col-lg-10 col-xl-9">{{ $event->created_at }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Дата последнего обновления</dt>
            <dd class="col-lg-10 col-xl-9">{{ $event->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection