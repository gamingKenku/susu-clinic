@extends('layouts.admin')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {!! session('success_message') !!}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card text-bg-theme">

        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Категории</h4>
            <div>
                <a href="{{ route('categories.create') }}" class="btn btn-secondary" title="Создать новую категорию">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($categoriesObjects) == 0)

            @include('resources.filter')
        
            <div class="card-body text-center">
                <h4>Категории не были найдены.</h4>
            </div>
        @else
        <div class="card-body p-0">

            @include('resources.filter')

            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Клиника</th>
                            <th>Название</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($categoriesObjects as $categories)
                        <tr>
                            <td class="align-middle">{{ optional($categories->Clinic)->name }}</td>
                            <td class="align-middle">{{ $categories->name }}</td>

                            <td class="text-end">

                                <form method="POST" action="{!! route('categories.destroy', $categories->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('categories.show', $categories->id ) }}" class="btn btn-info" title="Показать">
                                            <span class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('categories.edit', $categories->id ) }}" class="btn btn-primary" title="Редактировать">
                                            <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Удалить" onclick="return confirm(&quot;Click Ok to delete Categories.&quot;)">
                                            <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                                        </button>
                                    </div>

                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

            {!! $categoriesObjects->links() !!}
        </div>
        
        @endif
    
    </div>
@endsection