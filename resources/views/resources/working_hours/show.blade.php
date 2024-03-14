@extends('layouts.app')

@section('content')

<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($title) ? $title : 'Working Hours' }}</h4>
        <div>
            <form method="POST" action="{!! route('working_hours.working_hours.destroy', $workingHours->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('working_hours.working_hours.edit', $workingHours->id ) }}" class="btn btn-primary" title="Edit Working Hours">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete Working Hours" onclick="return confirm(&quot;Click Ok to delete Working Hours.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('working_hours.working_hours.index') }}" class="btn btn-primary" title="Show All Working Hours">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('working_hours.working_hours.create') }}" class="btn btn-secondary" title="Create New Working Hours">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Weekday</dt>
            <dd class="col-lg-10 col-xl-9">{{ $workingHours->weekday }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Start Time</dt>
            <dd class="col-lg-10 col-xl-9">{{ $workingHours->start_time }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">End Time</dt>
            <dd class="col-lg-10 col-xl-9">{{ $workingHours->end_time }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Created At</dt>
            <dd class="col-lg-10 col-xl-9">{{ $workingHours->created_at }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Updated At</dt>
            <dd class="col-lg-10 col-xl-9">{{ $workingHours->updated_at }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Staff</dt>
            <dd class="col-lg-10 col-xl-9">{{ optional($workingHours->Staff)->first_name }}</dd>

        </dl>

    </div>
</div>

@endsection