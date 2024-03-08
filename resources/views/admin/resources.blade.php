@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <table class="table table-hover">
                <tr>
                    <th>Название</th>
                    <th></th>    
                </tr>
                @foreach ($tables as $table)
                    <tr>
                        <td></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
