@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-user"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        @if(Auth::user()->adminType == 'superAdmin')
            <a href="{{ route('admin.members.sendLoginIdMailAll') }}" class="btn btn-primary ">Send Mail to All</a>

        @endif
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
                            <th> Phone </th>
                            <th> Email </th>
                            <th> Registration Id </th>
                            <th> Login Id </th>
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
                                        <a href="{{route('admin.members.sendLoginIdMail',[$member->email,$member->name,$member->registrationId,$member->loginId]) }}"><i class="fa fa-envelope" aria-hidden="true">Send Mail</i></a>
                                    @endif
                                </td>
                                <td>{{ $member->registrationId }}</td>
                                <td>{{ $member->loginId }}</td>
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
