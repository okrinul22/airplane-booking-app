@extends('layouts.app')
@section('content')
    <div class="panel-heading">
        <div class="panel-title">Customer Form</div>
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
                <form id="" class="form-horizontal" action="/process/booking.php" method="post" role="form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="pull-left"
                        style="background-color: #2b19e56b;
                    display: flex;
                    justify-content: center;
                    flex-direction: column;
                    align-items: center;
                    height: 100px;
                    padding: 20px;
                    border-radius: 10px;
                    padding-top: 30px;">
                        <p class="" style="color:white">
                            Airline :
                            <?php echo $datas->air_plane->air_plane_name; ?>
                        </p>

                    </div>
                    <div class="pull-right"
                        style="background-color: #41a37d6b;
                    display: flex;
                    justify-content: center;
                    flex-direction: column;
                    align-items: center;
                    height: 100px;
                    padding: 20px;
                    border-radius: 10px;
                    padding-top: 30px;">
                        <p style="color:#761c1c">
                            Schedule : <?php echo $datas->schedule; ?>
                        </p>
                        <p style="color:#626372">
                            Price : <?php echo rupiah($datas->sch_price); ?>
                        </p>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="thumbnail" style="margin-top: 15px;padding:20px;">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-4">ID Card</label>
                                            <div class="col-sm-8">
                                                <input type="hidden" name="sch_airplane_id" class="form-control"
                                                    value="<?php echo $_GET['id']; ?>">
                                                <input type="number" name="id_card" class="form-control"
                                                    value="{{ old('id_card') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-4">Full Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ old('name') }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-4">ID Card Upload</label>
                                            <div class="col-sm-8">
                                                <input type="file" name="id_card_upload" class="form-control"
                                                    accept="image/*">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-4">Payment Proof</label>
                                            <div class="col-sm-8">
                                                <input type="file" name="upload_proof" class="form-control"
                                                    accept="image/*">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 controls">
                                                <a class="btn btn-default" href="index.php">Cancel</a>
                                                <input type="submit" name="submit" class="btn btn-success"
                                                    value="Submit" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection
