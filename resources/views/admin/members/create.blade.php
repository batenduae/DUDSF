@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-user"></i> {{ $pageTitle }}</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <form action="{{ route('admin.members.store') }}" method="POST" role="form" enctype="multipart/form-data" id="form">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name') }}"/>
                            @error('name') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="phone1">Phone <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('phone1') is-invalid @enderror" type="text" name="phone1" id="phone1" value="{{ old('phone1') }}"/>
                            @error('phone1') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="phone2">Phone </label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="phone2" id="phone2" value="{{ old('phone2') }}"/>
                            @error('phone2') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="phone2">Email </label>
                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" value="{{ old('email') }}"/>
                            @error('email') {{ $message }} @enderror
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <img src="{{asset('/storage/settings/default.png')}}" id="memberImg" style="width: 80px; height: auto;">
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <label class="control-label">Member Image</label>
                                    <input class="form-control @error('image') is-invalid @enderror"
                                    type="file" id="image" name="image" onchange="loadFile(event,'memberImg')"/>
                                    @error('image') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Member</button>
                        <button class="btn btn-warning" type="button"
                                onclick="location.reload();"
                        ><i class="fa fa-fw fa-lg fa-refresh"></i>Reset</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary float-right" href="{{ route('admin.members.index') }}">
                            <i class="fa fa-fw fa-lg fa-arrow-circle-left"></i>Go Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        loadFile = function(event, id) {
            var output = document.getElementById(id);
            output.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endpush
