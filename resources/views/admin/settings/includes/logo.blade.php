<div class="tile">
    <form action="{{ route('admin.settings.update') }}" method="POST" role="form" enctype="multipart/form-data">
        @csrf
        <h3 class="tile-title">Site Logo</h3>
        <hr>
        <div class="tile-body">
            <div class="row">
                <div class="col-3">
                    @if (config('settings.site_logo') != null)
                        <img src="{{ asset('storage/'.config('settings.site_logo')) }}" id="siteLogoImg" style="width: 80px; height: auto;">
                    @else
                        <img src="{{asset('/storage/settings/default.png')}}" id="siteLogoImg" style="width: 80px; height: auto;">
                    @endif
                </div>
                <div class="col-9">
                    <div class="form-group">
                        <label class="control-label">Site Logo</label>
                        <input class="form-control" type="file" name="site_logo" id="site_logo"
                               onchange="runMultipleFunction(event, 'siteLogoImg', 'site_logo','hideLogoDelButton');"
                        />
                    </div>
                </div>
            </div>
            <div class="form-group" id="hideLogoDelButton">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" id="deleteLogo" name="deleteLogo"
                        />Remove Site Logo
                    </label>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3">
                    @if (config('settings.site_favicon') != null)
                        <img src="{{ asset('storage/'.config('settings.site_favicon')) }}" id="siteFaviconImg" style="width: 80px; height: auto;">
                    @else
                        <img src="{{asset('/storage/settings/default.png')}}" id="siteFaviconImg" style="width: 80px; height: auto;">
                    @endif
                </div>
                <div class="col-9">
                    <div class="form-group">
                        <label class="control-label">Site Favicon</label>
                        <input class="form-control" type="file" name="site_favicon" id="site_favicon"
                               onchange="runMultipleFunction(event, 'siteFaviconImg', 'site_favicon','hideFaviconDelButton');"
                        />
                    </div>
                </div>
            </div>
            <div class="form-group" id="hideFaviconDelButton">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" id="deleteFavicon" name="deleteFavicon"
                        />Remove Site Favicon
                    </label>
                </div>
            </div>
        </div>
        <div class="tile-footer">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Settings</button>
                </div>
            </div>
        </div>
    </form>
</div>
@push('scripts')
    <script type="text/javascript">
        function runMultipleFunction(event, eventId, id,hideId) {
            loadFile(event, eventId)
            hideButton(id,hideId);
        }
        loadFile = function(event, id) {
            var output = document.getElementById(id);
            output.src = URL.createObjectURL(event.target.files[0]);
        };
        function hideButton(id,hideId) {
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById(id).files[0]);

            oFReader.onload = function (oFREvent) {
                document.getElementById(hideId).setAttribute("style", "display: none");
            };
        };
    </script>
@endpush
