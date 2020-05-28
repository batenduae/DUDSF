<div class="app-title">
    <div>
        <h1><i class="fa fa-user"></i> {{ $pageTitle }}</h1>
        <p>{{ $subTitle }}</p>
    </div>
    @if(Auth::user()->adminType == 'superAdmin')

    @endif
    <span>
            <span>Display:&nbsp;&nbsp;
                <a href="{{ route('admin.members.image.action',['up','display','all',$member->id]) }}" class="badge badge-success">
                    <i class="fa fa-cloud-upload"></i>
                </a>
                <a href="{{ route('admin.members.image.action',['down','display','all',$member->id]) }}" class="badge badge-danger">
                    <i class="fa fa-cloud-download"></i>
                </a>
            </span>&nbsp;&nbsp;
            <span>Share:&nbsp;&nbsp;
                <a href="{{ route('admin.members.image.action',['up','share','all',$member->id]) }}" class="badge badge-success">
                    <i class="fa fa-cloud-upload"></i>
                </a>
                <a href="{{ route('admin.members.image.action',['down','share','all',$member->id]) }}" class="badge badge-danger">
                    <i class="fa fa-cloud-download"></i>
                </a>
            </span>&nbsp;&nbsp;

        </span>
    <a href="{{ route('admin.members.create') }}" class="btn btn-primary pull-right">Add Member</a>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <table class="table table-hover table-bordered text-center" id="sampleTable123">
                    <thead>
                    <tr>
                        <th> # </th>
                        <th> Image </th>
                        <th> Display on public profile</th>
                        <th> Share among dudsf member</th>
                        <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($member->pImages as $memberImage)
                        <tr>
                            <td>{{ $memberImage->id }}</td>
                            <td>{{ $memberImage->image }}</td>
                            <td class="text-center">
                                @if ($memberImage->display == 1)
                                    <span class="badge">Yes</span>
                                    <a href="{{ route('admin.members.image.action',['down','display',$memberImage->id]) }}" class="badge badge-danger"><i class="fa fa-cloud-download"></i></a>
                                @else
                                    <span class="badge badge-warning">No</span>
                                    <a href="{{ route('admin.members.image.action',['up','display',$memberImage->id]) }}" class="badge badge-success"><i class="fa fa-cloud-upload"></i></a>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($memberImage->share == 1)
                                    <span class="badge">Yes</span>
                                    <a href="{{ route('admin.members.image.action',['down','share',$memberImage->id]) }}" class="badge badge-danger"><i class="fa fa-cloud-download"></i></a>
                                @else
                                    <span class="badge badge-warning">No</span>
                                    <a href="{{ route('admin.members.image.action',['up','share',$memberImage->id]) }}" class="badge badge-success"><i class="fa fa-cloud-upload"></i></a>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Second group">
                                    <a href="{{ route('admin.members.images.delete', $memberImage->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure? If deleted once data can not be retrieve')"><i class="fa fa-trash"></i></a>
                                </div>
{{--                                <a class="card-link float-right text-danger" href="{{ route('admin.members.images.delete', $memberImage->id) }}">--}}
{{--                                    <i class="fa fa-fw fa-lg fa-trash"></i>--}}
{{--                                </a>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable123').DataTable();</script>
@endpush
