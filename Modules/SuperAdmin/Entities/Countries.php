<?php

namespace Modules\SuperAdmin\Entities;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $fillable = [
        'country_code',
        'country_name'
    ];
}
