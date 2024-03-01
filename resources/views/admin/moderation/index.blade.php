@use('Illuminate\Http\Request')

<span @class([
    'btn-primary' => Request::boolean('unchecked'),
    'btn-secondary' => !Request::boolean('unchecked'),
    ])>
</span>

<div class="container">
    <div class="row">
        <div class="col-md">
            <button type="button" class="btn btn-primary btn-secondary">Все</button>
            <button type="button" class="btn btn-primary btn-secondary">Непроверенные</button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-hover">
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
