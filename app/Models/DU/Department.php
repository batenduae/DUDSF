<?php

namespace App\Models\DU;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    protected $fillable = [
        'name','parent_id'
    ];

}
