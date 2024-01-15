<?php

namespace App\Acessors;

trait DefaultAcessors
{
    public function getTitleAttribute($value)
    {
        return strtoupper($value);
    }

    public function getTitleAndBodyAttribute()
    {
        return $this->title . ' - ' . $this->body;
    }
}
