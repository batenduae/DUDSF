<?php

namespace App\Models\Member;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;

class MemberJobInfo extends Model
{
    protected $table = 'member_job_infos';

    protected $fillable = [
        'member_id','employee','type','name','post',
        'join_date','address','phone','email','location','display','share'
    ];

    protected $casts = [
        'member_id'             =>  'integer',
        'employee'              =>  'boolean',
        'join_date'             =>  'datetime',
        'display'               =>  'boolean',
        'share'                 =>  'boolean',
    ];
    public function member(){
        return $this->belongsTo(Member::class,'id','member_id');
    }
}
