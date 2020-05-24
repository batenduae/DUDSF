<?php

namespace App\Models\Member;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;

class MemberLoginLog extends Model
{
    protected $table = 'member_login_logs';

    protected $fillable = [
        'member_id','login_no'
    ];

    protected $casts = [
        'member_id'             =>  'integer',
        'login_no'              =>  'integer',

    ];

    public function member(){
        return $this->belongsTo(Member::class,'id','member_id');
    }
}
