@extends('layouts.admin')

@section('content')

<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($discount->header) ? $discount->header : 'Скидка' }}</h4>
        <div>
            <form method="POST" action="{!! route('discounts.destroy', $discount->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('discounts.edit', $discount->id ) }}" class="btn btn-primary" title="Редактировать">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Удалить" onclick="return confirm(&quot;Click Ok to delete Discount.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('discounts.index') }}" class="btn btn-primary" title="Показать все">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('discounts.create') }}" class="btn btn-secondary" title="Создать">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Заголовок</dt>
            <dd class="col-lg-10 col-xl-9">{{ $discount->header }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Содержание</dt>
            <dd class="col-lg-10 col-xl-9">{!! $discount->markup !!}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Действует на услуги</dt>
            <dd class="col-lg-10 col-xl-9">
                <ol>
                    @foreach ($discount->services as $service)
                        <li>{{ $service->name }} ({{ $service->category->name }})</li>
                    @endforeach
                </ol>
            </dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Дата начала акции</dt>
            <dd class="col-lg-10 col-xl-9">{{ $discount->start_date }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Дата окончания акции</dt>
            <dd class="col-lg-10 col-xl-9">{{ $discount->end_date }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Дата создания</dt>
            <dd class="col-lg-10 col-xl-9">{{ $discount->created_at }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Дата последнего обновления</dt>
            <dd class="col-lg-10 col-xl-9">{{ $discount->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection