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
            <h4 class="m-0">Сотрудники</h4>
            <div>
                <a href="{{ route('staff.create') }}" class="btn btn-secondary" title="Создать">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($staffObjects) == 0)
            <div class="card-body text-center">

                @include('resources.filter')

                <h4>Сотрудников пока нет.</h4>
            </div>
        @else
        <div class="card-body p-0">

            @include('resources.filter')

            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Фамилия</th>
                            <th>Имя</th>
                            <th>Отчество</th>
                            <th>Тип сотрудника</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($staffObjects as $staff)
                        <tr>
                            <td class="align-middle">{{ $staff->last_name }}</td>
                            <td class="align-middle">{{ $staff->first_name }}</td>
                            <td class="align-middle">{{ $staff->patronym }}</td>
                            <td class="align-middle">{{ __(ucfirst($staff->staff_type)) }}</td>

                            <td class="text-end">

                                <form method="POST" action="{!! route('staff.destroy', $staff->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('staff.show', $staff->id ) }}" class="btn btn-info" title="Показать">
                                            <span class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('staff.edit', $staff->id ) }}" class="btn btn-primary" title="Редактировать">
                                            <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Удалить" onclick="return confirm(&quot;Click Ok to delete Staff.&quot;)">
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

            {!! $staffObjects->links() !!}
        </div>
        
        @endif
    
    </div>
@endsection