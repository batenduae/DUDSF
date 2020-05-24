<?php

namespace App\Http\Controllers\Admin\Member;

use App\Http\Controllers\Controller;
use App\Models\Member\MemberImage;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function get(Request $request)
    {
        $memberId = $request->input('id');
        $memberImages = MemberImage::where('member_id',$memberId)->get();
        return response()->json($memberImages);
    }
}
