@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/js/plugins/dropzone/dist/min/dropzone.min.css') }}"/>
@endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-shopping-bag"></i> {{ $pageTitle }} - {{ $subTitle }}</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row user">
        <div class="col-md-3">
            <div class="title p-0">
                <ul class="nav flex-column nav-tabs user-tabs">
                    <li class="nav-item"><a class="nav-link active" href="#tab-general" data-toggle="tab">General</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab-images" data-toggle="tab">Images</a></li>
                    <li class="nav-item"><a class="nav-link" href=#tab-profile" data-toggle="tab">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab-contact" data-toggle="tab">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab-university-info" data-toggle="tab">University Info</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab-personal-info" data-toggle="tab">Personal Info</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab-address" data-toggle="tab">Address</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab-educational-background" data-toggle="tab">Educational Background</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab-job-info" data-toggle="tab">Job Info</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active" id="tab-general">
                    @include('admin.members.profiles.general')
                </div>
                <div class="tab-pane" id="tab-images">
                    <div class="tile">
                        <h3 class="tile-title">Upload Image</h3>
                        <hr>
                        <form action="{{ route('admin.members.images.upload1') }}" method="POST" role="form" enctype="multipart/form-data" hidden>
                            @csrf
                           <input type="hidden" name="member_id" value="{{ $member->id }}">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-3">
                                        @if ($member->image != null)
                                            <img src="{{ asset('/storage/'.$member->image) }}" id="memberImg10" style="width: 80px; height: auto;">
                                        @else
                                            <img src="{{asset('/storage/settings/default.png')}}" id="memberImg10" style="width: 80px; height: auto;">
                                        @endif
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label class="control-label">Member Image</label>
                                            <input class="form-control @error('image') is-invalid @enderror"
                                                   type="file" id="profile_image" name="image"
                                                   onchange="runMultipleFunction(event, 'memberImg10', 'profile_image','hideImageDelButton10');"
                                            />
                                            @error('image') {{ $message }} @enderror
                                        </div>
                                    </div>
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
                        <div class="tile-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="" class="dropzone" id="dropzone" style="border: 2px dashed rgba(0,0,0,0.3)">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="member_id" value="{{ $member->id }}">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row d-print-none mt-2">
                            <div class="col-12 text-right">
                                <button class="btn btn-success" type="button" id="uploadButton">
                                    <i class="fa fa-fw fa-lg fa-upload"></i>Upload Images
                                </button>
                                <button class="btn btn-warning" type="button"
                                        onclick="location.reload();"
                                ><i class="fa fa-fw fa-lg fa-refresh"></i>Reset</button>
                            </div>
                        </div>
                        <div hidden>
                            {{$maxUpload = Setting::where('key','memberMaxImage')->first()->value}}
                            {{$uploaded = count($member->pImages)}}
                            {{$remainingUpload = $maxUpload-$uploaded}}
                        </div>
                        @if($member->pImages)
                            <hr/>
                            @if($remainingUpload<=0)
                                <div>
                                    <h4 class="text-center text-danger">You have uploaded maximum number of image.</h4>
                                    <hr/>
                                </div>
                            @endif
                            <div class="row">
                                @foreach($member->pImages as $memberImage)
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <img src="{{ asset('storage/'.$memberImage->image) }}" id="brandLogo" class="img-fluid" alt="img">
                                                <div>Id: {{$memberImage->id}}
                                                <a class="card-link float-right text-danger" href="{{ route('admin.members.images.delete', $memberImage->id) }}">
                                                    <i class="fa fa-fw fa-lg fa-trash"></i>
                                                </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    @include('admin.members.profiles.images')
                </div>


                <div class="tab-pane" id="tab-profile"></div>
                <div class="tab-pane" id="tab-contact"></div>
                <div class="tab-pane" id="tab-university-info"></div>
                <div class="tab-pane" id="tab-personal-info"></div>
                <div class="tab-pane" id="tab-address"></div>
                <div class="tab-pane" id="tab-educational-background"></div>
                <div class="tab-pane" id="tab-job-info"></div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

    <script type="text/javascript" src="{{ asset('backend/js/plugins/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dropzone/dist/min/dropzone.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/bootstrap-notify.min.js') }}"></script>
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
        }
        loadFile = function(event, id) {
            var output = document.getElementById(id);
            output.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
    <script>
    Dropzone.autoDiscover = false;

    $( document ).ready(function() {
        let myDropzone = new Dropzone("#dropzone", {
            paramName: "image",
            addRemoveLinks: false,
            maxFilesize: 4,
            parallelUploads: 2,
            uploadMultiple: false,
            url: "{{ route('admin.members.images.upload') }}",
            autoProcessQueue: false,
            maxFiles: {{$remainingUpload}},
            init: function() {
                this.on('maxfilesreached', function () {
                    $('.dropzone').unbind('click');
                });
            }
        });
        myDropzone.on("queuecomplete", function (file) {
            window.location.reload();
            showNotification('Completed', 'All member images uploaded', 'success', 'fa-check');
        });
        $('#uploadButton').click(function(){
            if (myDropzone.files.length === 0) {
                showNotification('Error', 'Please select files to upload.', 'danger', 'fa-close');
            } else {
                myDropzone.processQueue();
            }
        });
        function showNotification(title, message, type, icon)
        {
            $.notify({
                title: title + ' : ',
                message: message,
                icon: 'fa ' + icon
            },{
                type: type,
                allow_dismiss: true,
                placement: {
                    from: "top",
                    align: "right"
                },
            });
        }
    });
</script>
@endpush
