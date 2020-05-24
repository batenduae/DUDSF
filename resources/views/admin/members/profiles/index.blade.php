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
                    <li class="nav-item"><a class="nav-link" href="#tab-images" data-toggle="tab">Image</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab-profile" data-toggle="tab">Profile</a></li>
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
                        <div class="tile-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="" class="dropzone" id="dropzone" style="border: 2px dashed rgba(0,0,0,0.3)">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="product_id" value="{{ $targetMember->id }}">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row d-print-none mt-2">
                            <div class="col-12 text-right">
                                <button class="btn btn-success" type="button" id="uploadButton">
                                    <i class="fa fa-fw fa-lg fa-upload"></i>Upload Images
                                </button>
                            </div>
                        </div>
                        @if($targetMember->id)
                            <hr/>
                            <div class="row">
{{--                                @foreach($product->images as $image)--}}
{{--                                    <div class="col-md-3">--}}
{{--                                        <div class="card">--}}
{{--                                            <div class="card-body">--}}
{{--                                                <img src="{{ asset('storage/'.$image->full) }}" id="brandLogo" class="img-fluid" alt="img">--}}
{{--                                                <a class="card-link float-right text-danger" href="{{ route('admin.products.images.delete', $image->id) }}">--}}
{{--                                                    <i class="fa fa-fw fa-lg fa-trash"></i>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
                            </div>
                        @endif
                    </div>
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
    <script src="{{ asset('backend/js/app.js') }}"></script>
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
        };
        loadFile = function(event, id) {
            var output = document.getElementById(id);
            output.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
    <script>
        Dropzone.autoDiscover = false;

        $( document).ready(function () {
            // $('#categories').select2();

            let myDropzone = new Dropzone('#dropzone', {
                paramName: "image",
                addRemoveLinks: false,
                maxFiles: 5,
                parallelUploads: 2,
                uploadMultiple: false,
                {{--url: "{{ route('admin.products.images.upload') }}",--}}
                autoProcessQueue: false,
            });
            myDropzone.on("queuecomplete", function (file) {
                window.location.reload();
                showNotification('Completed','All product images uploaded', 'success', 'fa-check');
            });
            $('#uploadButton').click(function () {
                if (myDropzone.files.length === 0) {
                    showNotification('Error', 'Please select files to upload.', 'danger', 'fa-check');
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
