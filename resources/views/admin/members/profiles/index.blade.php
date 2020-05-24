@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
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
                    <li class="nav-item"><a class="nav-link" href="#tab-image" data-toggle="tab">Image</a></li>
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
                <div class="tab-pane" id="tab-image"></div>
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
    <script>
        $( document ).ready(function() {
            $('#image').select2();
        });
    </script>
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
