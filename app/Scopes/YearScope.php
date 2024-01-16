<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class YearScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->whereYear('date', Carbon::now()->year);
    }
}
