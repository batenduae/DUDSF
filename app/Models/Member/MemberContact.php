<?php

namespace App\Models\Member;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;

class MemberContact extends Model
{
    protected $table = 'member_contacts';

    protected $fillable = [
        'member_id','permanent_phone1','permanent_phone2','optional_phone1','optional_phone2',
        'home_phone1','home_phone2','email','facebook','twitter','instagram','linkedIn','skype',
        'whatsapp','display','share'
    ];

    protected $casts = [
        'member_id'     =>  'integer',
        'display'       =>  'boolean',
        'share'       =>  'boolean',

    ];
    public function member(){
        return $this->belongsTo(Member::class,'id','member_id');
    }
}
