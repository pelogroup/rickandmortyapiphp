@section('title', 'All Episodes')
@extends('view_admin.layout')

@section('content_admin')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">All Episodes</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Back</a></li>
                            <!--<li class="breadcrumb-item active">Dashboard v1</li>-->
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <!--<h3 class="card-title">Expandable Table</h3>-->
                                <!-- HERE THE DIV FOR NOTIFICATION MESSAGE -->
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success">
                                        <p>{{ $message }}</p>
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if ($message = Session::get('unauthorised'))
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                        <p>{{ $message }}</p>
                                    </div>
                                @endif

                            </div>
                            <!-- ./card-header -->
                            <div class="card-body">



                                <table id="example1" class="table table-bordered table-striped" >
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Air Date</th>
                                        <th>Episode</th>
                                        <th>Characters</th>
                                        <th>URL</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($episodes as $episods)
                                        <tr>
                                            <td>{{ $episods->id }}</td>
                                            <td>{{ $episods->name }}</td>
                                            <td>{{ $episods->air_date }}</td>
                                            <td>{{ $episods->episode }}</td>
                                            <td>
                                                {{-- --}}
                                                @php
                                                $appearEpisodes = \App\Models\Character::join('appear_episodes', 'appear_episodes.character_id', '=', 'characters.id')->where('appear_episodes.episode_id', $episods->id)->where('appear_episodes.user_id', Auth::user()->id)->get(['characters.name', 'characters.url']);
                                                @endphp
                                                @foreach ($appearEpisodes as $appearEpisode)
                                                    <a href="{{ $appearEpisode->url }}" data-toggle="lightbox"/> {{ $appearEpisode->name }}</a>; 
                                                @endforeach
                                               {{-- --}}
                                            </td>
                                            <td>{{ $episods->url }}</td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Air Date</th>
                                        <th>Episode</th>
                                        <th>Characters</th>
                                        <th>URL</th>
                                    </tr>
                                    </tfoot>
                                </table>
                                {{ $episodes->links('vendor.pagination.bootstrap-4') }}

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->



        </div>
        <!-- /.content -->
    </div>
    <!-- Content Wrapper. Contains page content -->


@endsection

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
