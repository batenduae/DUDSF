<div class="tile">
    <form action="{{ route('admin.members.update') }}" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="name">Name <span class="m-l-5 text-danger"> *</span></label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name', $targetMember->name) }}"/>
                <input type="hidden" name="id" value="{{ $targetMember->id }}">
                @error('name') {{ $message }} @enderror
            </div>
            <div class="form-group">
                <label class="control-label" for="phone1">Phone <span class="m-l-5 text-danger"> *</span></label>
                <input class="form-control @error('phone1') is-invalid @enderror" type="text" name="phone1" id="phone1" value="{{ old('phone1', $targetMember->phone1) }}"/>
                @error('phone1') {{ $message }} @enderror
            </div>
            <div class="form-group">
                <label class="control-label" for="phone2">Phone </label>
                <input class="form-control @error('phone2') is-invalid @enderror" type="text" name="phone2" id="phone2" value="{{ old('phone2', $targetMember->phone2) }}"/>
                @error('phone2') {{ $message }} @enderror
            </div>
            <div class="form-group">
                <label class="control-label" for="phone2">Email </label>
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" value="{{ old('email', $targetMember->email) }}"/>
                @error('email') {{ $message }} @enderror
            </div>
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" id="membership" name="membership"
                            {{ $targetMember->membership == 1 ? 'checked' : '' }}
                        />Membership of Member
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" id="display" name="display"
                            {{ $targetMember->display == 1 ? 'checked' : '' }}
                        />Display Member
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" id="banned" name="banned"
                            {{ $targetMember->banned == 1 ? 'checked' : '' }}
                        />Restrict(Banned) Member
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" id="active" name="active"
                            {{ $targetMember->active == 1 ? 'checked' : '' }}
                        />Activeness of Member
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" id="inform" name="inform"
                            {{ $targetMember->inform == 1 ? 'checked' : '' }}
                        />Inform Member
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" id="edit" name="edit"
                            {{ $targetMember->edit == 1 ? 'checked' : '' }}
                        />Member can edit Profile
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" id="imageShow" name="imageShow"
                            {{ $targetMember->imageShow == 1 ? 'checked' : '' }}
                        />Member can edit Profile
                    </label>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-3">
                        @if ($targetMember->image != null)
                            <img src="{{ asset('/storage/'.$targetMember->image) }}" id="memberImg" style="width: 80px; height: auto;">
                        @else
                            <img src="{{asset('/storage/settings/default.png')}}" id="memberImg" style="width: 80px; height: auto;">
                        @endif
                    </div>
                    <div class="col-9">
                        <div class="form-group">
                            <label class="control-label">Member Image</label>
                            <input class="form-control @error('image') is-invalid @enderror"
                                   type="file" id="image" name="image"
                                   onchange="runMultipleFunction(event, 'memberImg', 'image','hideImageDelButton');"
                            />
                            @error('image') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
                @if ($targetMember->image != null)
                    <div class="form-group" id="hideImageDelButton">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" id="delete" name="delete"
                                />Remove Image
                            </label>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="tile-footer">
            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Member</button>
            <button class="btn btn-warning" type="button"
                    onclick="location.reload();"
            ><i class="fa fa-fw fa-lg fa-refresh"></i>Reset</button>
            &nbsp;&nbsp;&nbsp;

            <a class="btn btn-secondary float-right" href="{{ route('admin.members.index') }}">
                <i class="fa fa-fw fa-lg fa-arrow-circle-left"></i>Go Back</a>
        </div>
    </form>
</div>
