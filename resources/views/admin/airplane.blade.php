@extends('layouts.app-admin')
@section('content')
    <div class="panel-heading">
        <div class="panel-title">Airplane</div>
    </div>
    <div style="padding-top:30px" class="panel-body">
        @if ($errors->any())
            <div id="login-alert" class="alert alert-danger col-sm-12">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success" id="success-message">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('success-message').style.display = 'none';
                }, 5000);
            </script>
        @endif
        <a class="btn btn-xs btn-default" href="/airplane_form.php">Add</a>
        <br />
        <div class="row">
            <div class="col-sm-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Airplane ID</th>
                            <th>Airplane Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = $datas->currentPage() * $datas->perPage() - $datas->perPage() + 1;
                            $matchCalculation = 0;
                        @endphp

                        @foreach ($datas as $data)
                            <tr>
                                <td>
                                    {{ $no }}
                                </td>
                                <td>
                                    <?php echo $data->air_plane_id; ?>
                                </td>
                                <td>
                                    <?php echo $data->air_plane_name; ?>
                                </td>
                                <td>
                                    <a class="btn btn-xs btn-primary"
                                        href="/airplane_form.php?id=<?php echo $data->air_plane_id; ?>">Edit</a>

                                    <form action="/airplane/delete.php" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $data->air_plane_id }}">
                                        <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                                    </form>
                                </td>
                                @php
                                    $no++;
                                @endphp
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                <ul class="pagination">
                                    @if ($datas->previousPageUrl())
                                        <li><a href="{{ $datas->previousPageUrl() }}" rel="prev">&laquo;
                                                Previous</a></li>
                                    @endif

                                    @for ($i = 1; $i <= $datas->lastPage(); $i++)
                                        <li class="{{ $datas->currentPage() == $i ? 'active' : '' }}">
                                            <a href="{{ $datas->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    @if ($datas->nextPageUrl())
                                        <li><a href="{{ $datas->nextPageUrl() }}" rel="next">Next &raquo;</a>
                                        </li>
                                    @endif
                                </ul>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
