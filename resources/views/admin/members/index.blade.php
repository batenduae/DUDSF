@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-user"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        @if(Auth::user()->adminType == 'superAdmin')
            <a href="{{ route('admin.members.indexEditAll') }}" class="btn btn-primary ">Edit Members</a>
            <a href="{{ route('admin.members.getRegLoginId') }}" class="btn btn-primary ">Get Reg,Login Id</a>
        @endif
        <span>
            <span>Member:&nbsp;&nbsp;
                <a href="{{ route('admin.members.action',['up','display','all']) }}" class="badge badge-success">
                    <i class="fa fa-cloud-upload"></i>
                </a>
                <a href="{{ route('admin.members.action',['down','display','all']) }}" class="badge badge-danger">
                    <i class="fa fa-cloud-download"></i>
                </a>
            </span>
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
                            <th> Slug </th>
                            <th class="text-center"> Phone </th>
                            <th class="text-center"> Email </th>
                            <th class="text-center"> Display </th>
                            <th class="text-center"> Image </th>
                            <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $member)
                            <tr>
                                <td>{{ $member->id }}</td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->slug }}</td>
                                @if($member->phone2 == null)
                                    <td>{{ $member->phone1}} &nbsp;<a href="tel:{{ $member->phone1}}"><i class="fa fa-phone"></i></a></td>
                                @else
                                    <td>{{ $member->phone1}} &nbsp;<a href="tel:{{ $member->phone1}}"><i class="fa fa-phone"></i></a><br/>{{ $member->phone1}} &nbsp;<a href="tel:{{ $member->phone1}}"><i class="fa fa-phone"></i></a></td>
                                @endif
                                <td>{{ $member->email }}
                                    @if($member->email != null)
                                        &nbsp;&nbsp;<a href="mailto:{{ $member->email }}"> <i class="fa fa-envelope" aria-hidden="true"></i></a>
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
                                    @if ($member->image != null)
                                        <span class="badge badge-success"><i class="fa fa-check-circle"></i></span>
                                    @else
                                        <span class="badge badge-danger"><i class="fa fa-times-circle"></i></span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Second group">
                                        <a href="{{ route('admin.members.edit', $member->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                        @if(Auth::user()->adminType == 'superAdmin')
                                            <a href="{{ route('admin.members.profiles.editProfile', $member->id) }}" class="btn btn-sm btn-success" ><i class="fa fa-pencil"></i></a>
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
    <data-table
        url="/"
        :per-page="perPage"
        :columns="columns">
    </data-table>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush
