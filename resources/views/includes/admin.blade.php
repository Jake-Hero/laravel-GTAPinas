<div class="container mb-5">

    <div class="mt-1">

        <div class="btn-group btn-group-sm mr-2" role="group">
            <a href="{{ route('admin.index') }}" class="btn btn-dark"><span class="fas fa-home"></span> Dashboard</a>
        </div>

        <div class="btn-group btn-group-sm mr-2" role="group">
            <a href="{{ route('admin.characters') }}" class="btn btn-dark"><span class="fas fa-users"></span> Characters List</a>
        </div>

        {{-- <div class="btn-group btn-group-sm mr-2" role="group">
            @if($obj->isUserAdmin() >= 2)
                <a href="/admin/ban_list.php" class="btn btn-dark"><span class="fas fa-gavel"></span> Ban List</a>
            @endif
        </div> --}}

        <div class="btn-group btn-group-sm mr-2" role="group">
            <a href="{{ route('admin.groups') }}" class="btn btn-dark"><span class="fas fa-users"></span> Groups</a>
        </div>

        <div class="btn-group btn-group-sm mr-2" role="group">
            <a href="{{ route('admin.turfs') }}" class="btn btn-dark"><span class="fas fa-map-pin"></span> Turfs</a>
        </div>

    </div>

</div>