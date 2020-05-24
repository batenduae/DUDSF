<?php

namespace App\Models\Member;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;

class MemberAddress extends Model
{
    protected $table = 'member_addresses';

    protected $fillable = [
        'member_id','p_country','p_division','p_district','p_city',
        'p_upazilla_city','p_police','p_post','p_union','p_union_municipality',
        'p_ward', 'p_village','p_sector','p_road','p_house','p_location','p_extra',
        'p_display','p_share', 'same',
        'country','division','district','city',
        'pazilla_city','police','post','union','union_municipality',
        'ward', 'village','sector','road','house','location','p_extra','display','share',
    ];

    protected $casts = [
        'member_id'             =>  'integer',
        'p_city'                =>  'boolean',
        'p_union'               =>  'boolean',
        'p_display'             =>  'boolean',
        'p_share'               =>  'boolean',
        'same'                  =>  'boolean',
        'city'                  =>  'boolean',
        'union'                 =>  'boolean',
        'display'               =>  'boolean',
        'share'                 =>  'boolean',
    ];
    public function member(){
        return $this->belongsTo(Member::class,'id','member_id');
    }
}
