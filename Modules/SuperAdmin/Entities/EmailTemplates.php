<?php

namespace Modules\SuperAdmin\Entities;

use Illuminate\Database\Eloquent\Model;

class EmailTemplates extends Model
{
    protected $fillable = [];

    protected $guarded = [];

    protected $table = 'email_templates';
}
