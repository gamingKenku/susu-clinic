@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col">
            <button type="button" data-unchecked-flag="false" class="refresh-button btn me-3 @if(!Request::boolean('unchecked')) btn-primary @else btn-secondary @endif">Все</button>
            <button type="button" data-unchecked-flag="true" class="refresh-button btn me-3 @if(Request::boolean('unchecked')) btn-primary @else btn-secondary @endif">Непроверенные</button>
        </div>
    </div>
    <div class="row">
        <div class="col">

            @if (!$feedback->isEmpty())
                <table class="table table-striped table-sm">
                    <tr>
                        <th class="w-15">Автор</th>
                        <th class="w-auto">Содержание</th>
                        <th class="w-auto">Дата отправки</th>
                        <th class="w-10">Оценка</th>
                        <th class="w-auto">Статус</th>
                        <th class="w-auto"></th>
                    </tr>
                    @foreach($feedback as $review)
                        <tr>
                            <td class="align-middle">{{$review->author}}</td>
                            <td class="align-middle">{{Str::limit($review->content, 100)}}</td>
                            <td class="align-middle">{{$review->created_at}}</td>
                            <td class="align-middle">
                                @for ($i = 1; $i <= $review->rating ; $i++)
                                    <span class="fa fa-star checked"></span>
                                @endfor
                                @for ($i = 1; $i <= 5 - $review->rating; $i++)
                                    <span class="fa fa-star"></span>
                                @endfor
                            </td>
                            <td class="align-middle">
                                @if ($review->moderated == 1)
                                    <span class="text-success">Опубликован</span>
                                @elseif ($review->blocked == 1)
                                    <span class="text-danger">Заблокирован</span>
                                @else
                                    <span class="text-muted">Не проверен</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <a href="{{route('moderationEdit', $review->id)}}" role="button" class="btn btn-primary">Просмотреть</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <p class="text-muted">Отзывов пока нет.</p>
            @endif

            {{ $feedback->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
