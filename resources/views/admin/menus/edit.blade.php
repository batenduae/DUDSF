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
                <form action="{{ route('admin.menus.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name', $targetMenu->name) }}"/>
                            <input type="hidden" name="id" value="{{ $targetMenu->id }}">
                            @error('name') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Description</label>
                            <textarea class="form-control" rows="4" name="description" id="description">{{ old('description', $targetMenu->description) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="parent">Parent Menu <span class="m-l-5 text-danger"> *</span></label>
                            <select id=parent class="form-control custom-select mt-15 @error('parent_id') is-invalid @enderror" name="parent_id">
                                <option value="0">Select a parent menu</option>
                                @foreach($menus as $menu)
                                    @if ($targetMenu->parent_id == $menu->id)
                                        <option value="{{ $menu->id }}" selected> {{ $menu->name }} </option>
                                    @else
                                        <option value="{{ $menu->id }}"> {{ $menu->name }} </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('parent_id') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="featured" name="featured"
                                        {{ $targetMenu->featured == 1 ? 'checked' : '' }}
                                    />Featured Menu
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="menu" name="menu"
                                        {{ $targetMenu->menu == 1 ? 'checked' : '' }}
                                    />Show in Menu
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    @if ($targetMenu->image != null)
                                        <img src="{{ asset('/storage/'.$targetMenu->image) }}" id="menuImg" style="width: 80px; height: auto;">
                                    @else
                                        <img src="{{asset('/storage/settings/default.png')}}" id="menuImg" style="width: 80px; height: auto;">
                                    @endif
                                </div>
                                <div class="col-9">
                                    <div class="form-group">
                                        <label class="control-label">Menu Image</label>
                                        <input class="form-control @error('image') is-invalid @enderror"
                                               type="file" id="image" name="image"
                                               onchange="runMultipleFunction(event, 'menuImg', 'image','hideImageDelButton');"
                                        />
                                        @error('image') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="hideImageDelButton">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" id="delete" name="delete"
                                        />Remove Image
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Menu</button>
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
    <script type="text/javascript">
        function runMultipleFunction(event, eventId, id,hideId) {
            loadFile(event, eventId)
            hideButton(id,hideId);
        }
        function hideButton(id,hideId) {
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById(id).files[0]);

            oFReader.onload = function (oFREvent) {
                document.getElementById(hideId).setAttribute("style", "display: none");
            };
        };
        loadFile = function(event, id) {
            var output = document.getElementById(id);
            output.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endpush
