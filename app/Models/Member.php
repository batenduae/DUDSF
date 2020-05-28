<?php

namespace App\Models;

use App\Models\Member\MemberAddress;
use App\Models\Member\MemberContact;
use App\Models\Member\MemberEducationalBackground;
use App\Models\Member\MemberImage;
use App\Models\Member\MemberJobInfo;
use App\Models\Member\MemberLoginLog;
use App\Models\Member\MemberPersonalInfo;
use App\Models\Member\MemberProfile;
use App\Models\Member\MemberUniversityInfo;
use Illuminate\Database\Eloquent\Model;
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
    public function pImages(){
        return $this->hasMany(MemberImage::class,'member_id');
    }
    public function profile(){
        return $this->hasOne(MemberProfile::class,'member_id');
    }
    public function address(){
        return $this->hasOne(MemberAddress::class,'member_id');
    }
    public function contact(){
        return $this->hasOne(MemberContact::class,'member_id');
    }
    public function eduBack(){
        return $this->hasOne(MemberEducationalBackground::class,'member_id');
    }
    public function job(){
        return $this->hasOne(MemberJobInfo::class,'member_id');
    }
    public function loginLog(){
        return $this->hasMany(MemberLoginLog::class,'member_id');
    }
    public function personalInfo(){
        return $this->hasOne(MemberPersonalInfo::class,'member_id');
    }
    public function universityInfo(){
        return $this->hasOne(MemberUniversityInfo::class,'member_id');
    }
}
