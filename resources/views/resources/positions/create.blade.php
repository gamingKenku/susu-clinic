@extends('layouts.admin')

@section('content')

    <div class="card text-bg-theme">

         <div class="card-header d-flex justify-content-between align-items-center p-3">
            <h4 class="m-0">Создание должности</h4>
            <div>
                <a href="{{ route('positions.index') }}" class="btn btn-info" title="Показать все">
                    <span class="fa-solid fa-table-list" aria-hidden="true"></span>
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

            <form method="POST" class="quill-form needs-validation" novalidate action="{{ route('positions.store') }}" accept-charset="UTF-8" id="create_position_form" name="create_position_form" >
            {{ csrf_field() }}
            @include ('resources.positions.form', [
                                        'position' => null,
                                        'staff' => $staff,
                                      ])

                <div class="col-lg-10 col-xl-9 offset-lg-2 offset-xl-3">
                    <input class="btn btn-primary" type="submit" value="Сохранить">
                </div>

            </form>

        </div>
    </div>

@endsection


