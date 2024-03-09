@extends('layouts.admin')

@section('content')

<div class="card text-bg-theme">

     <div class="card-header d-flex justify-content-between align-items-center p-3">
        <h4 class="m-0">{{ isset($clinics->name) ? $clinics->name : 'Clinics' }}</h4>
        <div>
            <form method="POST" action="{!! route('clinics.clinics.destroy', $clinics->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}

                <a href="{{ route('clinics.clinics.edit', $clinics->id ) }}" class="btn btn-primary" title="Edit Clinics">
                    <span class="fa-regular fa-pen-to-square" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete Clinics" onclick="return confirm(&quot;Click Ok to delete Clinics.?&quot;)">
                    <span class="fa-regular fa-trash-can" aria-hidden="true"></span>
                </button>

                <a href="{{ route('clinics.clinics.index') }}" class="btn btn-primary" title="Show All Clinics">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('clinics.clinics.create') }}" class="btn btn-secondary" title="Create New Clinics">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>

            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="row">
            <dt class="text-lg-end col-lg-2 col-xl-3">Address</dt>
            <dd class="col-lg-10 col-xl-9">{{ $clinics->address }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Created At</dt>
            <dd class="col-lg-10 col-xl-9">{{ $clinics->created_at }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Name</dt>
            <dd class="col-lg-10 col-xl-9">{{ $clinics->name }}</dd>
            <dt class="text-lg-end col-lg-2 col-xl-3">Updated At</dt>
            <dd class="col-lg-10 col-xl-9">{{ $clinics->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection