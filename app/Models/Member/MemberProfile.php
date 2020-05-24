<?php

namespace App\Models\Member;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;

class MemberProfile extends Model
{
    protected $table = 'member_profiles';

    protected $fillable = [
        'member_id','dudsf_dudaa','email','password','email_verified_at','first_name',
        'last_name','full_name','sur_name','inform','donate','prefer','display','share'
    ];

    protected $casts = [
        'member_id'             =>  'integer',
        'dudsf_dudaa'           =>  'boolean',
        'email_verified_at'     =>  'datetime',
        'inform'               =>  'boolean',
        'donate'               =>  'boolean',
        'prefer'               =>  'boolean',
        'display'               =>  'boolean',
        'share'                 =>  'boolean',

    ];
    public function member(){
        return $this->belongsTo(Member::class,'id','member_id');
    }
}
