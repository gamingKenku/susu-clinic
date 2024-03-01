@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md">
            <button type="button" class="btn me-3 @if(!Request::boolean('unchecked')) btn-primary @else btn-secondary @endif">Все</button>
            <button type="button" class="btn me-3 @if(Request::boolean('unchecked')) btn-primary @else btn-secondary @endif">Непроверенные</button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-hover table-sm">
                <tr>
                    <th>Автор</th>
                    <th>Содержание</th>
                    <th>Рейтинг</th>
                    <th></th>
                </tr>
                @foreach($feedback as $review)
                    <tr>
                        <td>{{$review->author}}</td>
                        <td>{{Str::limit($review->content, 30)}}</td>
                        <td>{{$review->rating}}</td>
                        <td>
                            <a href="{{route('moderationEdit', $review->id)}}" role="button" class="btn btn-primary">Просмотреть</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
