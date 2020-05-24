<?php

namespace App\Models\Member;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;

class MemberUniversityInfo extends Model
{
    protected $table = 'member_university_infos';

    protected $fillable = [
        'member_id','hons_unit','hons_dept_inst','hons_faculty_inst','hons_dept',
        'hons_session','hons_regId','hons_pass_year','hons_cgpa','done_masters',
        'masters_dept_inst', 'masters_faculty','masters_dept','masters_session',
        'masters_pass_year','masters_cgpa','hall','resident','building','room',
        'live-here','display','share'
    ];

    protected $casts = [
        'member_id'             =>  'integer',
        'hons_dept_inst'        =>  'boolean',
//        'hons_pass_year'        =>  'year',
        'hons_cgpa'             =>  'decimal',
        'done_masters'          =>  'boolean',
        'masters_dept_inst'     =>  'boolean',
//        'masters_pass_year'     =>  'year',
        'masters_cgpa'          =>  'decimal',
        'resident'              =>  'boolean',
        'live-here'              =>  'boolean',
        'display'               =>  'boolean',
        'share'                 =>  'boolean',
    ];
    public function member(){
        return $this->belongsTo(Member::class,'id','member_id');
    }
}
