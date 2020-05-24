@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        @if(Auth::user()->adminType == 'superAdmin')
            <span>
                <span>Featured:&nbsp;&nbsp;
                    <a href="{{ route('admin.menus.action',['up','featured','all']) }}" class="badge badge-success">
                        <i class="fa fa-cloud-upload"></i>
                    </a>
                    <a href="{{ route('admin.menus.action',['down','featured','all']) }}" class="badge badge-danger">
                        <i class="fa fa-cloud-download"></i>
                    </a>
                </span>&nbsp;&nbsp;&nbsp;&nbsp;
                <span>Menu:&nbsp;&nbsp;
                    <a href="{{ route('admin.menus.action',['up','menu','all']) }}" class="badge badge-success">
                        <i class="fa fa-cloud-upload"></i>
                    </a>
                    <a href="{{ route('admin.menus.action',['down','menu','all']) }}" class="badge badge-danger">
                        <i class="fa fa-cloud-download"></i>
                    </a>
                </span>
            </span>
            <a href="{{ route('admin.menus.create') }}" class="btn btn-primary pull-right">Add Menu</a>
        @endif
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> Name </th>
                            <th> Slug </th>
                            <th class="text-center"> Parent </th>
                            <th class="text-center"> Featured </th>
                            <th class="text-center"> Menu </th>
                            <th class="text-center"> Order </th>
                            <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($menus as $menu)
                            @if ($menu->parent_id != 0)
                                <tr>
                                    <td>{{ $menu->id }}</td>
                                    <td>{{ $menu->name }}</td>
                                    <td>{{ $menu->slug }}</td>
                                    <td>{{ $menu->parent->name }}</td>
                                    <td class="text-center">
                                        @if ($menu->featured == 1)
                                            <span class="badge badge-info">Yes</span>
                                            <a href="{{ route('admin.menus.action', ['down','featured',$menu->id]) }}" class="badge badge-danger">
                                                <i class="fa fa-cloud-download"></i></a>
                                        @else
                                            <span class="badge badge-warning">No</span>
                                            <a href="{{ route('admin.menus.action', ['up','featured',$menu->id]) }}" class="badge badge-success">
                                                <i class="fa fa-cloud-upload"></i></a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($menu->menu == 1)
                                            <span class="badge badge-info">Visible</span>
                                            <a href="{{ route('admin.menus.action', ['down','menu',$menu->id]) }}" class="badge badge-danger">
                                                <i class="fa fa-eye-slash"></i></a>
                                        @else
                                            <span class="badge badge-warning">Hidden</span>
                                            <a href="{{ route('admin.menus.action', ['up','menu',$menu->id]) }}" class="badge badge-success">
                                                <i class="fa fa-eye"></i></a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $menu->order }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            @if(Auth::user()->adminType == 'superAdmin')
                                                <a href="{{ route('admin.menus.delete', $menu->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure? If deleted once data can not be retrieve')"><i class="fa fa-trash"></i></a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endif
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
