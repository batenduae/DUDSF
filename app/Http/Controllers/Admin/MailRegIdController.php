<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\MemberContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class MailRegIdController extends BaseController
{
    protected $memberRepository;

    public function __construct(MemberContract $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }
    public function get(Request $request)
    {
        $members = $this->memberRepository->listMembers();
        return response()->json($members);
    }
}
