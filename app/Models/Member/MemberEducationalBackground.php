<?php

namespace App\Models\Member;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;

class MemberEducationalBackground extends Model
{
    protected $table = 'member_educational_backgrounds';

    protected $fillable = [
        'member_id','primary_school','primary_year','primary_gpa','jsc',
        'jsc_school','jsc_board','jsc_year','jsc_gpa','jsc_version',
        'ssc_oLevel', 'ssc_school','ssc_board','ssc_group',
        'ssc_version','ssc_year','ssc_reg','ssc_roll','ssc_gpa',
        'hsc_aLevel','hsc_college','hsc_board','hsc_group','hsc_version',
        'hsc_year','hsc_reg','hsc_roll','hsc_gpa','display','share'
    ];

    protected $casts = [
        'member_id'             =>  'integer',
//        'primary_year'        =>  'year',
        'primary_gpa'           =>  'decimal',
        'jsc'                   =>  'boolean',
//        'jsc_year'              =>  'year',
        'jsc_gpa'               =>  'decimal',
        'ssc_oLevel'            =>  'boolean',
//        'ssc_year'              =>  'year',
        'ssc_gpa'               =>  'decimal',
        'hsc_aLevel'            =>  'boolean',
//        'hsc_year'              =>  'year',
        'hsc_gpa'               =>  'decimal',
        'display'                 =>  'boolean',
        'share'                 =>  'boolean',
    ];
    public function member(){
        return $this->belongsTo(Member::class,'id','member_id');
    }
}
