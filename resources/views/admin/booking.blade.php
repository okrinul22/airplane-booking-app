@extends('layouts.app-admin')
@section('content')
    <div class="panel-heading">
        <div class="panel-title">Booking</div>
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
        <div class="row">
            <div class="col-sm-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Customer</th>
                            <th>Airplane</th>
                            <th>Schedule</th>
                            <th>Price</th>
                            <th>Payment Status</th>
                            <th>Register By</th>
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
                                    {{ $data->id_card }} <br />
                                    -
                                    {{ $data->name }}
                                    <br />
                                    <a class="btn" href="upload/<?php echo $data->id_card_upload; ?>" target="_blank">File</a>
                                </td>
                                <td>
                                    {{ $data->sch_air_plane->air_plane->air_plane_name }}
                                </td>
                                <td>
                                    {{ $data->sch_air_plane->air_plane->schedule }}
                                </td>
                                <td>
                                    {{ rupiah($data->sch_air_plane->sch_price) }}
                                    @php
                                        $matchCalculation += $data->sch_air_plane->sch_price;
                                    @endphp
                                </td>
                                <td>
                                    {{ $data->payment->status }}
                                    <br />
                                    <a class="btn" href="upload/<?php echo $data->payment->upload_proof; ?>" target="_blank">File</a>
                                </td>
                                <td>
                                    {{ $data->user_registered->name }}
                                    <br />
                                </td>
                                <td>
                                    <form action="process/booking/cancel.php" method="post" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $data->booking_id }}">
                                        <button type="submit" class="btn btn-xs btn-danger">Cancel</button>
                                    </form>
                                    <form action="process/booking/accept.php" method="post" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $data->booking_id }}">
                                        <button type="submit" class="btn btn-xs btn-success">Accepted</button>
                                    </form>

                                    <form action="process/booking/reject.php" method="post" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $data->booking_id }}">
                                        <button type="submit" class="btn btn-xs btn-warning">Rejected</button>
                                    </form>

                                </td>
                            </tr>
                            @php
                                $no++;
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Total</td>
                            <td colspan="6">
                                <?php echo rupiah($matchCalculation); ?>
                            </td>
                        </tr>
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
