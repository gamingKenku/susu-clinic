@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">

            <h5>Автор</h5>
            <p>{{ $feedback->author }}</p>

            <h5>Оценка</h5>
            <p>
                @for ($i = 1; $i <= $feedback->rating ; $i++)
                    <span class="fa fa-star checked"></span>
                @endfor
                @for ($i = 1; $i <= 5 - $feedback->rating; $i++)
                    <span class="fa fa-star"></span>
                @endfor
            </p>

            <h5>Содержание</h5>
            <p>
                {{ $feedback->content }}    
            </p>

            <form class="d-inline" method="post" action="{{ route('moderationUpdate', $feedback->id) }}">
                @method('PUT')
                @csrf
                <input name="blocked" id="blocked" type="hidden" value="1">
                <input name="moderated" id="moderated" type="hidden" value="0">
                <input name="deleted" id="deleted" type="hidden" value="0">
                <button class="btn btn-danger" type="submit">Заблокировать</button>
            </form>

            <form class="d-inline" method="post" action="{{ route('moderationUpdate', $feedback->id) }}">
                @method('PUT')
                @csrf
                <input name="blocked" id="blocked" type="hidden" value="1">
                <input name="moderated" id="moderated" type="hidden" value="0">
                <input name="deleted" id="deleted" type="hidden" value="1">
                <button class="btn btn-danger" type="submit">Удалить</button>
            </form>

            <form class="d-inline" method="post" action="{{ route('moderationUpdate', $feedback->id) }}">
                @method('PUT')
                @csrf
                <input name="blocked" id="blocked" type="hidden" value="0">
                <input name="moderated" id="moderated" type="hidden" value="1">
                <input name="deleted" id="deleted" type="hidden" value="0">
                <button class="btn btn-success" type="submit">Опубликовать</button>
            </form>

        </div>
    </div>
</div>
@endsection
