<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function filterColumns(Builder $builder, mixed $value, array $columns) : Builder
    {
        foreach($columns as $column) 
        {
            $builder = $builder->orWhere($column, 'LIKE', "%$value%");
        }

        return $builder;
    }

    protected function filterRelatedColumns(Builder $builder, mixed $value, array $columns)
    {
        foreach($columns as $table => $table_columns)
        {
            foreach($table_columns as $table_column)
            {
                $builder = $builder->orWhereHas($table, function ($query) use ($value, $table_column) {
                    $query->where($table_column, 'LIKE', "%$value%");
                });
            }
        }

        return $builder;
    }

    // protected function filterRelatedColumnManyToMany(Builder $builder, mixed $value, array $columns)
    // {
    //     return $builder;
    // }
}
