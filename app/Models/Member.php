<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Member extends Model
{
    protected $fillable = [
      'name','slug','phone1','phone2','email','registrationId','loginId','membership','display','banned','active','inform','edit','image','imageShow'
    ];

    protected $casts = [
        'membership'    =>  'boolean',
        'display'       =>  'boolean',
        'banned'        =>  'boolean',
        'active'        =>  'boolean',
        'inform'        =>  'boolean',
        'edit'          =>  'boolean',
        'imageShow'     =>  'boolean'
    ];

    public function setNameAttribute($value){
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = 'dudsf-'.Str::slug($value).'-'.Str::random(3);
//        $this->attributes['registrationId'] = 'dudsf@'.Carbon::now()->format('YmdHs').Str::random(3);
//        $this->attributes['loginId'] = 'dudsf:'.(Carbon::now()->format('YmdHs')+1500).'-'.Str::random(5);
    }
}
