<?php

namespace App\Models\Member;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;

class MemberPersonalInfo extends Model
{
    protected $table = 'member_personal_infos';

    protected $fillable = [
        'member_id','married','marriage_status','spouse_name','children',
        'family_member','blood_group','donate','religion','birth_date','hobby',
        'skills','extra_info','display','share'
    ];

    protected $casts = [
        'member_id'             =>  'integer',
        'married'               =>  'boolean',
        'children'              =>  'integer',
        'family_member'         =>  'integer',
        'donate'                =>  'boolean',
        'birth_date'            =>  'datetime',
        'display'               =>  'boolean',
        'share'                 =>  'boolean',
    ];
    public function member(){
        return $this->belongsTo(Member::class,'id','member_id');
    }
}
