@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 align = 'center'>Laboratory Data</h2>
        <form class="form-horizontal" action="{{ url('/laboratory')}}" method="post">
        {{ csrf_field() }}
            <div class="form-group">
                <label class="col-sm-3 control-label">Technician Name:</label>
                <div class="col-sm-8">
                    <input class="form-control input-sm" name="labName" type="text" required placeholder='Input String'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">BATCH NO:</label>
                <div class="col-sm-8">
                    <input class="form-control input-sm" name="BatchNo" type="text" required placeholder='Input String'>
                    <input class="form-control input-sm" name="labLocation" type="hidden" value='laboratory'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Date Time:</label>
                <div class="col-sm-8">
                    <input class="form-control input-sm" name="labDateTime" type="datetime-local" required>
                </div>
            </div>

            <hr style="border-width: 1px;border-top-color:green">

            <div class="form-group">
                <label class="col-sm-3" style="color:blue;text-align:center">TEST</label>
                <label class="col-sm-2" style="color:blue;text-align:center">RESULT</label>
                <label class="col-sm-4" style="color:blue;text-align:center">SPECIFICATION</label>
            </div>
            <div class="form-group has-success">
                <label class="col-sm-3 control-label" for="inputSuccess">Temperature Latex:</label>
                <div class="col-sm-2">
                    <input class="form-control input-sm" name="labTemperature" type="number" step=0.01 required placeholder='Input Float'>
                </div>
                <div class="col-sm-4"></div>
            </div>
            <div class="form-group has-success">
                <label class="col-sm-3 control-label" for="inputSuccess">PH Value:</label>
                <div class="col-sm-2">
                    <input class="form-control input-sm" name="labPH" type="number" step=0.01 required placeholder='Input Float'>
                </div>
                <div class="col-sm-4"></div>
            </div>
            <div class="form-group has-success">
                <label class="col-sm-3 control-label" for="inputSuccess">Viscosity:</label>
                <div class="col-sm-2">
                    <input class="form-control input-sm" name="labViscosity" type="number" step=0.01 required placeholder='Input Float'>
                </div>
                <div class="col-sm-4"></div>
            </div>
            <div class="form-group has-success">
                <label class="col-sm-3 control-label" for="inputSuccess">Mechanical Stability:</label>
                <div class="col-sm-2">
                    <select class="form-control input-sm" name="labMechanical"  required>
                        <option></option>
                        <option value='Yes'>Yes</option>
                        <option value='No'>No</option>
                    </select>
                </div>
                <div class="col-sm-4"></div>
            </div>
            <div class="form-group has-success">
                <label class="col-sm-3 control-label" for="inputSuccess">Comment:</label>
                <div class="col-sm-8">
                    <textarea class="form-control" name="labComment" placeholder='Input Text' style="height:100px"></textarea>
                </div>
            </div>
            <center>
                <p><h7 style="color:green">{{isset($msg)?$msg:''}}</h7></p>
                <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
            </center>
        </form>
    </div>
@endsection
