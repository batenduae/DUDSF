@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <form action="{{ route('admin.menus.store') }}" method="POST" role="form" enctype="multipart/form-data" id="form">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name') }}"/>
                            @error('name') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Description</label>
                            <textarea class="form-control" rows="4" name="description" id="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="parent">Parent Menu <span class="m-l-5 text-danger"> *</span></label>
                            <select id=parent class="form-control custom-select mt-15 @error('parent_id') is-invalid @enderror" name="parent_id">
                                <option value="0">Select a parent menu</option>
                                @foreach($menus as $menu)
                                    <option value="{{ $menu->id }}"> {{ $menu->name }} </option>
                                @endforeach
                            </select>
                            @error('parent_id') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="featured" name="featured"/>Featured Menu
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="menu" name="menu"/>Show in Menu
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <img src="{{asset('/storage/settings/default.png')}}" id="logoImg" style="width: 80px; height: auto;">
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <label class="control-label">Menu Image</label>
                                    <input class="form-control @error('image') is-invalid @enderror"
                                    type="file" id="image" name="image" onchange="loadFile(event,'logoImg')"/>
                                    @error('image') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Menu</button>
                        <button class="btn btn-warning" type="button"
                                onclick="location.reload();"
                        ><i class="fa fa-fw fa-lg fa-refresh"></i>Reset</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary float-right" href="{{ route('admin.menus.index') }}">
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
