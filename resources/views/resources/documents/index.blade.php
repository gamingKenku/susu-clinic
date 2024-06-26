@extends('layouts.admin')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {!! session('success_message') !!}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
        </div>
    @endif

    <div class="card text-bg-theme">

        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Документы</h4>
            <div>
                <a href="{{ route('documents.create') }}" class="btn btn-secondary" title="Создать">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($documents) == 0)
            <div class="card-body text-center">
                <h4>Документы пока не созданы</h4>

                {{-- @include('resources.filter') --}}

            </div>
        @else
        <div class="card-body p-0">
            
            {{-- @include('resources.filter') --}}
            
            <div class="table-responsive">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Название</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($documents as $document)
                        <tr>
                            <td class="align-middle">{{ $document->name }}</td>

                            <td class="text-end">

                                <form method="POST" action="{!! route('documents.destroy', $document->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('documents.show', $document->id ) }}" class="btn btn-info" title="Показать">
                                            <span class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('documents.edit', $document->id ) }}" class="btn btn-primary" title="Редактировать">
                                            <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Удалить" onclick="return confirm(&quot;Click Ok to delete Document.&quot;)">
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

            {!! $documents->links() !!}
        </div>
        
        @endif
    
    </div>
@endsection