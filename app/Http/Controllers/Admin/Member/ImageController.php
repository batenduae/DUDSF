<?php

namespace App\Http\Controllers\Admin\Member;

use App\Http\Controllers\BaseController;
use App\Contracts\MemberContract;
use App\Http\Controllers\Controller;
use App\Models\Member\MemberImage;
use App\Models\Setting;
use App\Traits\FileUpload;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    use FileUpload;

    protected $memberRepository;

    public function __construct(MemberContract $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    public function upload(Request $request)
    {
        $member = $this->memberRepository->findMemberById($request->member_id);
        $memberMaxImage = null;
        if($setting = Setting::where('key','memberMaxImage')->first()){
            $memberMaxImage =$setting->value;
        }
        if(!($memberMaxImage == null) && $memberMaxImage > 0){
            $mi = count($member->pImages()->get());
            if($mi<$memberMaxImage){
                if ($request->has('image')) {
                    $image = $this->uploadOne($request->image, 'members');
                    $memberImage = new MemberImage([
                        'image'      =>  $image
                    ]);
                    $member->pImages()->save($memberImage);
                }
                return response()->json('success', 200);
//                return response()->json(['status' => 'Success']);
            } else{
//                return 'Can not upload more';
                return response()->json('error', 400);
//                return response()->json(['status' => 'fail','messages'=>'maximum number of image uploaded']);
            }
        }

    }
    public function delete($id)
    {
        $memberImage = MemberImage::findOrFail($id);

        if ($memberImage->image != '') {
            $this->deleteOne($memberImage->image);
        }
        $memberImage->delete();
        return redirect()->back();
    }
}
