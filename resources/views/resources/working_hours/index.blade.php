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
            <h4 class="m-0">Рабочие часы</h4>
            {{-- <div>
                <a href="{{ route('working-hours.create') }}" class="btn btn-secondary" title="Создать">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>
            </div> --}}
        </div>
        
        @if(count($staff) == 0)
            <div class="card-body text-center">
                <h4>Рабочие часы пока не созданы</h4>
            </div>
        @else
        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>ФИО сотрудника</th>
                            <th>Понедельник</th>
                            <th>Вторник</th>
                            <th>Среда</th>
                            <th>Четверг</th>
                            <th>Пятница</th>
                            <th>Суббота</th>
                            <th>Воскресенье</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($staff as $staff_member)
                        <tr>
                            <td class="align-middle">{{ $staff_member->first_name }} {{ $staff_member->last_name }} {{ $staff_member->patronym }}</td>
                            @if ($staff_member->workingHours()->exists())
                                @for($i = 0; $i <= 6; $i++)
                                    <td class="align-middle">{{ optional($staff_member->workingHours->where('weekday', '=', $i)->where('staff_id', '=', $staff_member->id)->first())->start_time }} - {{ optional($staff_member->workingHours->where('weekday', '=', $i)->where('staff_id', '=', $staff_member->id)->first())->end_time }}</td>
                                @endfor        
                            @else
                                @for($i = 0; $i <= 6; $i++)
                                    <td class="align-middle"> - </td>
                                @endfor                         
                            @endif
                            

                            <td class="text-end">
                                <form method="POST" action="{!! route('working-hours.destroy', $staff_member->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('working-hours.show', $staff_member->id ) }}" class="btn btn-info" title="Показать">
                                            <span class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('working-hours.edit', $staff_member->id ) }}" class="btn btn-primary" title="Редактировать">
                                            <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                                        </a>

                                        {{-- <button type="submit" class="btn btn-danger" title="Удалить" onclick="return confirm(&quot;Click Ok to delete Working Hours.&quot;)">
                                            <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                                        </button> --}}
                                    </div>

                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

            {!! $staff->links() !!}
        </div>
        
        @endif
    
    </div>
@endsection