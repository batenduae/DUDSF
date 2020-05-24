@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-user"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        @if(Auth::user()->adminType == 'superAdmin')
{{--            <a href="{{ route('admin.members.indexEditAll') }}" class="btn btn-primary ">Edit Members</a>--}}
        @endif
        <span>
            <span>Member:&nbsp;&nbsp;
                <a href="{{ route('admin.members.action',['up','membership','all']) }}" class="badge badge-success">
                    <i class="fa fa-cloud-upload"></i>
                </a>
                <a href="{{ route('admin.members.action',['down','membership','all']) }}" class="badge badge-danger">
                    <i class="fa fa-cloud-download"></i>
                </a>
            </span>&nbsp;&nbsp;
            <span>Display:&nbsp;&nbsp;
                <a href="{{ route('admin.members.action',['up','display','all']) }}" class="badge badge-success">
                    <i class="fa fa-cloud-upload"></i>
                </a>
                <a href="{{ route('admin.members.action',['down','display','all']) }}" class="badge badge-danger">
                    <i class="fa fa-cloud-download"></i>
                </a>
            </span>&nbsp;&nbsp;
            <span>Banned:&nbsp;&nbsp;
                <a href="{{ route('admin.members.action',['up','banned','all']) }}" class="badge badge-success">
                    <i class="fa fa-cloud-upload"></i>
                </a>
                <a href="{{ route('admin.members.action',['down','banned','all']) }}" class="badge badge-danger">
                    <i class="fa fa-cloud-download"></i>
                </a>
            </span>&nbsp;&nbsp;
            <span>Activity:&nbsp;&nbsp;
                <a href="{{ route('admin.members.action',['up','active','all']) }}" class="badge badge-success">
                    <i class="fa fa-cloud-upload"></i>
                </a>
                <a href="{{ route('admin.members.action',['down','active','all']) }}" class="badge badge-danger">
                    <i class="fa fa-cloud-download"></i>
                </a>
            </span>&nbsp;&nbsp;
            <span>Inform:&nbsp;&nbsp;
                <a href="{{ route('admin.members.action',['up','inform','all']) }}" class="badge badge-success">
                    <i class="fa fa-cloud-upload"></i>
                </a>
                <a href="{{ route('admin.members.action',['down','inform','all']) }}" class="badge badge-danger">
                    <i class="fa fa-cloud-download"></i>
                </a>
            </span>&nbsp;&nbsp;
            <span>Edit:&nbsp;&nbsp;
                <a href="{{ route('admin.members.action',['up','edit','all']) }}" class="badge badge-success">
                    <i class="fa fa-cloud-upload"></i>
                </a>
                <a href="{{ route('admin.members.action',['down','edit','all']) }}" class="badge badge-danger">
                    <i class="fa fa-cloud-download"></i>
                </a>
            </span>&nbsp;&nbsp;
            <span>Show Image:&nbsp;&nbsp;
                <a href="{{ route('admin.members.action',['up','imageShow','all']) }}" class="badge badge-success">
                    <i class="fa fa-cloud-upload"></i>
                </a>
                <a href="{{ route('admin.members.action',['down','imageShow','all']) }}" class="badge badge-danger">
                    <i class="fa fa-cloud-download"></i>
                </a>
            </span>&nbsp;&nbsp;
        </span>
        <a href="{{ route('admin.members.create') }}" class="btn btn-primary pull-right">Add Member</a>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered text-center" id="sampleTable">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> Name </th>
                            <th> Membership </th>
                            <th> Display in list</th>
                            <th> Banned </th>
                            <th> Activity </th>
                            <th> Inform </th>
                            <th> Can Edit Form </th>
                            <th> Show Image on Profile</th>
                            <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $member)
                            <tr>
                                <td>{{ $member->id }}</td>
                                <td>{{ $member->name }}</td>
                                <td class="text-center">
                                    @if ($member->membership == 1)
                                        <span class="badge">Yes</span>
                                        @if(Auth::user()->adminType == 'superAdmin')
                                            <a href="{{ route('admin.members.action',['down','membership',$member->id]) }}" class="badge badge-danger"><i class="fa fa-cloud-download"></i></a>
                                        @endif
                                    @else
                                        <span class="badge badge-warning">No</span>
                                        @if(Auth::user()->adminType == 'superAdmin')
                                            <a href="{{ route('admin.members.action',['up','membership',$member->id]) }}" class="badge badge-success"><i class="fa fa-cloud-upload"></i></a>
                                        @endif
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($member->display == 1)
                                        <span class="badge">Yes</span>
                                        <a href="{{ route('admin.members.action',['down','display',$member->id]) }}" class="badge badge-danger"><i class="fa fa-cloud-download"></i></a>
                                    @else
                                        <span class="badge badge-warning">No</span>
                                        <a href="{{ route('admin.members.action',['up','display',$member->id]) }}" class="badge badge-success"><i class="fa fa-cloud-upload"></i></a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($member->banned == 1)
                                        <span class="badge badge-danger">Banned</span>
                                        @if(Auth::user()->adminType == 'superAdmin')
                                            <a href="{{ route('admin.members.action',['down','banned',$member->id]) }}" class="badge badge-warning"><i class="fa fa-cloud-download"></i></a>
                                        @endif
                                    @else
                                        <span class="badge">No</span>
                                        @if(Auth::user()->adminType == 'superAdmin')
                                            <a href="{{ route('admin.members.action',['up','banned',$member->id]) }}" class="badge badge-danger"><i class="fa fa-cloud-upload"></i></a>
                                        @endif
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($member->active == 1)
                                        <span class="badge badge-primary">Active</span>
                                        <a href="{{ route('admin.members.action',['down','active',$member->id]) }}" class="badge badge-danger"><i class="fa fa-cloud-download"></i></a>
                                    @else
                                        <span class="badge badge">Not</span>
                                        <a href="{{ route('admin.members.action',['up','active',$member->id]) }}" class="badge badge-success"><i class="fa fa-cloud-upload"></i></a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($member->inform == 1)
                                        <span class="badge">Yes</span>
                                        <a href="{{ route('admin.members.action',['down','inform',$member->id]) }}" class="badge badge-danger"><i class="fa fa-cloud-download"></i></a>
                                    @else
                                        <span class="badge badge-warning">No</span>
                                        <a href="{{ route('admin.members.action',['up','inform',$member->id]) }}" class="badge badge-success"><i class="fa fa-cloud-upload"></i></a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($member->edit == 1)
                                        <span class="badge">Yes</span>
                                        <a href="{{ route('admin.members.action',['down','edit',$member->id]) }}" class="badge badge-danger"><i class="fa fa-cloud-download"></i></a>
                                    @else
                                        <span class="badge badge-warning">No</span>
                                        <a href="{{ route('admin.members.action',['up','edit',$member->id]) }}" class="badge badge-success"><i class="fa fa-cloud-upload"></i></a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($member->imageShow == 1)
                                        <span class="badge">Yes</span>
                                        <a href="{{ route('admin.members.action',['down','imageShow',$member->id]) }}" class="badge badge-danger"><i class="fa fa-cloud-download"></i></a>
                                    @else
                                        <span class="badge badge-warning">No</span>
                                        <a href="{{ route('admin.members.action',['up','imageShow',$member->id]) }}" class="badge badge-success"><i class="fa fa-cloud-upload"></i></a>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Second group">
                                        <a href="{{ route('admin.members.edit', $member->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                        @if(Auth::user()->adminType == 'superAdmin')
                                            <a href="{{ route('admin.members.delete', $member->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure? If deleted once data can not be retrieve')"><i class="fa fa-trash"></i></a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush
