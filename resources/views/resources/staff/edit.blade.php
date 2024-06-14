@extends('layouts.admin')

@section('content')

    <div class="card text-bg-theme">
  
         <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">{{ !empty($title) ? $title : 'Сотрудник' }}</h4>
            <div>
                <a href="{{ route('staff.index') }}" class="btn btn-info" title="Показать все">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('staff.create') }}" class="btn btn-secondary" title="Создать">
                    <span class="fa-solid fa-plus" aria-hidden="true"></span>
                </a>
            </div>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul class="list-unstyled mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" class="quill-form needs-validation" novalidate action="{{ route('staff.update', $staff->id) }}" id="edit_staff_form" name="edit_staff_form" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('resources.staff.form', [
                                        'staff' => $staff,
                                      ])

                <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                    <input class="btn btn-primary" type="submit" value="Сохранить">
                </div>
            </form>

        </div>
    </div>

@endsection