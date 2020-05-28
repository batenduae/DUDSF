<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\MemberContract;
use App\Http\Controllers\BaseController;
use App\Models\Member\MemberImage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class MemberController extends BaseController
{
    protected $memberRepository;

    public function __construct(MemberContract $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    public function index()
    {
        $members = $this->memberRepository->listMembers();
        $this->setPageTitle('Members', 'List of all members');
        return view('admin.members.index',compact('members'));
    }

    public function create()
    {
        $members = $this->memberRepository->listMembers();
        $this->setPageTitle('Members','Create Member');
        return view('admin.members.create',compact('members'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:40',
            'phone1'    =>  'required',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $registrationId = 'dudsf@reg@'.Carbon::now()->format('YmdHs').Str::random(5);
        $loginId = 'dudsf@login@:'.(Carbon::now()->format('YmdHs')+1534).'-'.Str::random(10);
        $request->request->add(['registrationId' => $registrationId]);
        $request->request->add(['loginId' => $loginId]);

        $params = $request->except('_token');
        $member = $this->memberRepository->createMember($params);
        if(!$member) {
            return $this->responseRedirectBack('Error Occurred while adding member','error',true,true);
        }
        return $this->responseRedirect('admin.members.index','Member added successfully.','success',false,false);
    }

    public function edit($id)
    {
        $targetMember = $this->memberRepository->findMemberById($id);
        $members = $this->memberRepository->listMembers();
        $this->setPageTitle('Members','Edit Member: '.$targetMember->name);
        return view('admin.members.edit',compact('members','targetMember'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:40',
            'phone1'    =>  'required',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');
        $member = $this->memberRepository->updateMember($params);
        if(!$member) {
            return $this->responseRedirectBack('Error Occurred while updating member','error',true,true);
        }
        return $this->responseRedirectBack('Member updated successfully.','success',false,false);
    }

    public function delete($id)
    {
        $member = $this->memberRepository->deleteMember($id);
        if (!$member){
            return $this->responseRedirectBack('Error Occurred while deleting member','error',true,true);
        }
        return $this->responseRedirect('admin.members.index','Member deleted successfully.','success',false,false);
    }

    public function indexEditAll()
    {
        $members = $this->memberRepository->listMembers();
        $this->setPageTitle('Members', 'List of all members');
        return view('admin.members.indexEditAll',compact('members'));
    }

    public function actionOnMember($action,$item,$id = null)
    {
        switch ($action){
            case 'up':
                $value = 1;
                break;
            case 'down':
                $value = 0;
                break;
        }
        switch ($id){
            case is_numeric($id):{
                $justMember = $this->memberRepository->findMemberById($id);
                $members = [$justMember];
            } break;
            case 'all':
                $members = $this->memberRepository->all();
                break;
            default:
                return $this->responseRedirectBack('Nothing Changed','warning',true,true);
                break;
        }
        foreach ($members as $member){
            switch ($item){
                case 'membership':
                    $member->membership = $value;
                    break;
                case 'display':
                    $member->display = $value;
                    break;
                case 'banned':
                    $member->banned = $value;
                    break;
                case 'active':
                    $member->active = $value;
                    break;
                case 'inform':
                    $member->inform = $value;
                    break;
                case 'edit':
                    $member->edit = $value;
                    break;
                case 'imageShow':
                    $member->imageShow = $value;
                    break;
            }
            $member->save();
        }
        return $this->responseRedirectBack('Updated successfully','success',true,true);
    }

    public function actionOnMemberImage($action,$item,$id = null,$memberId = null)
    {
        switch ($action){
            case 'up':
                $value = 1;
                break;
            case 'down':
                $value = 0;
                break;
        }
        switch ($id){
            case is_numeric($id):{
                $justMemberImage = MemberImage::findOrFail($id);
                $memberImages = [$justMemberImage];
            } break;
            case 'all':{
                $memberImages = MemberImage::where('member_id',$memberId)->get();
            } break;
            default:
                return $this->responseRedirectBack('Nothing Changed','warning',true,true);
                break;
        }
        foreach ($memberImages as $memberImage){
            switch ($item){
                case 'display':
                    $memberImage->display = $value;
                    break;
                case 'share':
                    $memberImage->share = $value;
                    break;
            }
            $memberImage->save();
        }
        return $this->responseRedirectBack('Updated successfully','success',true,true);
    }

    public function getRegLoginId()
    {
        $members = $this->memberRepository->listMembers();
        $this->setPageTitle('Members', 'List of all members');
        return view('admin.members.getRegLoginId',compact('members'));
    }

    public function sendLoginIdMail($email,$name,$registrationId,$loginId)
    {
        $to_name = $name;
        $to_email = $email;
        $data = array('name'=>$name, 'registrationId'=>$registrationId,'loginId'=>$loginId);

        Mail::send('admin.emails.sendLoginIdMail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                ->subject('Registration Id & Login ID');
            $message->from('dudsf.org@gmail.com','DUDSF');
        });
        return $this->responseRedirectBack('Mail Send successfully','success',true,true);
    }
    public function sendLoginIdMailAll()
    {
        $members = $members = $this->memberRepository->listMembers();
        foreach ($members as $member)
        {
            if($member->email != null)
            {
                $to_name = $member->name;
                $to_email = $member->email;
                $data = array('name'=>$member->name, 'registrationId'=>$member->registrationId,'loginId'=>$member->loginId);

                Mail::send('admin.emails.sendLoginIdMail', $data, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                        ->subject('Registration Id & Login ID');
                    $message->from('dudsf.org@gmail.com','DUDSF');
                });
            }
        }
        return $this->responseRedirectBack('Mail Send successfully','success',true,true);
    }

    public function editProfile($id)
    {
        $member = $this->memberRepository->findMemberById($id);
        $this->setPageTitle('Member','Edit Member\'s Profile: '.$member ->name);
        return view('admin.members.profiles.index',compact('member'));
    }


    public function sendLoginIdMailAllVue(Request $request)
    {
        $members = $members = $this->memberRepository->listMembers();
        foreach ($members as $member)
        {
            if($member->email != null)
            {
                $to_name = $member->name;
                $to_email = $member->email;
                $data = array('name'=>$member->name, 'registrationId'=>$member->registrationId,'loginId'=>$member->loginId);

                Mail::send('admin.emails.sendLoginIdMail', $data, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                        ->subject('Registration Id & Login ID');
                    $message->from('dudsf.org@gmail.com','DUDSF');
                });
            }
        }
        return response()->json(['status' => 'success','message'=>'Setting deleted successfully']);
    }
}
