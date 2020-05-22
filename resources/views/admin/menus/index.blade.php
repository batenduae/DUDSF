@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        @if(Auth::user()->adminType == 'superAdmin')
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
                                            <span class="badge badge-success">Yes</span>
                                            <a href="{{ route('admin.menus.changeFeature', $menu->id) }}" class="badge badge-success"><i class="fa fa-cloud-upload"></i></a>
                                        @else
                                            <span class="badge badge-danger">No</span>
                                            <a href="{{ route('admin.menus.changeFeature', $menu->id) }}" class="badge badge-warning"><i class="fa fa-cloud-download"></i></a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($menu->menu == 1)
                                            <span class="badge badge-success">Visible</span>
                                            <a href="{{ route('admin.menus.changeStatus', $menu->id) }}" class="badge badge-success"><i class="fa fa-eye"></i></a>
                                        @else
                                            <span class="badge badge-danger">Hidden</span>
                                            <a href="{{ route('admin.menus.changeStatus', $menu->id) }}" class="badge badge-warning"><i class="fa fa-eye-slash"></i></a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $menu->order }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            @if(Auth::user()->adminType == 'superAdmin')
                                                <a href="{{ route('admin.menus.delete', $menu->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
