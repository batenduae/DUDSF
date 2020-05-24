<?php

namespace App\Models\DU;

use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    protected $table = 'halls';

    protected $fillable = [
        'name','gender','unit'
    ];
}
