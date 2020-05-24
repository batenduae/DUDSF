<?php

namespace App\Models\Member;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;

class MemberImage extends Model
{
    protected $table = 'member_images';

    protected $fillable = [
        'member_id','image','display','share'
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
