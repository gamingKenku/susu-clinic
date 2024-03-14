@extends('layouts.app')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {!! session('success_message') !!}

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card text-bg-theme">

        <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Working Hours</h4>
            <div>
                <a href="{{ route('working_hours.working_hours.create') }}" class="btn btn-secondary" title="Create New Working Hours">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        
        @if(count($workingHoursObjects) == 0)
            <div class="card-body text-center">
                <h4>No Working Hours Available.</h4>
            </div>
        @else
        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Weekday</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Staff</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($workingHoursObjects as $workingHours)
                        <tr>
                            <td class="align-middle">{{ $workingHours->weekday }}</td>
                            <td class="align-middle">{{ $workingHours->start_time }}</td>
                            <td class="align-middle">{{ $workingHours->end_time }}</td>
                            <td class="align-middle">{{ optional($workingHours->Staff)->first_name }}</td>

                            <td class="text-end">

                                <form method="POST" action="{!! route('working_hours.working_hours.destroy', $workingHours->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('working_hours.working_hours.show', $workingHours->id ) }}" class="btn btn-info" title="Show Working Hours">
                                            <span class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('working_hours.working_hours.edit', $workingHours->id ) }}" class="btn btn-primary" title="Edit Working Hours">
                                            <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Working Hours" onclick="return confirm(&quot;Click Ok to delete Working Hours.&quot;)">
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

            {!! $workingHoursObjects->links('pagination') !!}
        </div>
        
        @endif
    
    </div>
@endsection