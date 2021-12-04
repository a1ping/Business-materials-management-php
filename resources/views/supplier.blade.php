@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 align = 'center'>Supplier Data</h2>
        <form class="form-horizontal" action="{{ url('/supplier')}}" method="post">
        {{ csrf_field() }}
            <div class="form-group">
                <label class="col-sm-3 control-label">Supplier Name:</label>
                <div class="col-sm-8">
                    <input class="form-control input-sm" name="supName" type="text" required placeholder='Input String'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">BATCH NO:</label>
                <div class="col-sm-8">
                    <input class="form-control input-sm" name="BatchNo" type="text" required placeholder='Input String'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Location:</label>
                <div class="col-sm-8">
                    <input class="form-control input-sm" name="supLocation" type="text" required placeholder='Input String'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Production Date:</label>
                <div class="col-sm-8">
                    <input class="form-control input-sm" name="supDate" type="date" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Product Symbol:</label>
                <div class="col-sm-8">
                    <input class="form-control input-sm" name="supProduct" type="text" required placeholder='Input String'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Quantity (Liter):</label>
                <div class="col-sm-8">
                    <input class="form-control input-sm" name="supQuantity" type="number" required placeholder='Input Integer'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Drum (3/8, 4/8 etc):</label>
                <div class="col-sm-8">
                    <input class="form-control input-sm" name="supDrum" type="text" required placeholder='Input String'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Pick Up Temp Latex:</label>
                <div class="col-sm-8">
                    <input class="form-control input-sm" name="supPick" type="number" step=0.01 required placeholder='Input Float'>
                </div>
            </div>

            <hr style="border-width: 1px;border-top-color:green">
            
            <div class='container'>
              <div class="col-sm-7">
                <div class="form-group">
                    <label class="col-sm-5" style="color:blue;text-align:center">TEST</label>
                    <label class="col-sm-2" style="color:blue;text-align:center">RESULT</label>
                    <label class="col-sm-5" style="color:blue;text-align:left">SPECIFICATION</label>
                </div>
                <div class="form-group has-success">
                    <label class="col-sm-5 control-label" for="inputSuccess">Total Solids (std metheod %):</label>
                    <div class="col-sm-2">
                        <input class="form-control input-sm" name="supSolide" type="number" required placeholder='Input Integer'>
                    </div>
                    <div class="col-sm-5">50% +/-10%</div>
                </div>
                <div class="form-group has-success">
                    <label class="col-sm-5 control-label" for="inputSuccess">Viscosity Rotate SP-2@50rpm:</label>
                    <div class="col-sm-2">
                        <input class="form-control input-sm" name="supViscosity" type="number"required placeholder='Input Integer'>
                    </div>
                    <div class="col-sm-5">25 ~ 150 cps</div>
                </div>
                <div class="form-group has-success">
                    <label class="col-sm-5 control-label" for="inputSuccess">PH Value:</label>
                    <div class="col-sm-2">
                        <input class="form-control input-sm" name="supPH" type="number" step=0.01 required placeholder='Input Float'>
                    </div>
                    <div class="col-sm-5">8.6 ~ 9.1 cps</div>
                </div>
                <div class="form-group has-success">
                    <label class="col-sm-5 control-label" for="inputSuccess">Chloroform Test - Precure:</label>
                    <div class="col-sm-2">
                        <input class="form-control input-sm" name="supChloroform" type="number" step=0.01 max=0  required  placeholder='Input Negative float'>
                    </div>
                    <div class="col-sm-5">-3 ~ -4</div>
                </div>
                <div class="form-group has-success">
                    <label class="col-sm-5 control-label" for="inputSuccess">Gell Point:</label>
                    <div class="col-sm-2">
                        <input class="form-control input-sm" name="supGell" type="number"  required  placeholder='Input Integer'>
                    </div>
                    <div class="col-sm-5">30 ~ 36</div>
                </div>
              </div>
              <div class="col-sm-5">
                <div class="form-group">
                    <label class="col-sm-3" style="color:blue;text-align:center">Comment</label>
                </div>
                <div class="form-group has-success">
                    <div class="col-sm-12">
                        <textarea class="form-control" name="supComment" placeholder='Input Text' style="height:200px"></textarea>
                    </div>
                </div>
              </div>
            </div>
            <center>
                <p><h7 style="color:green">{{isset($msg)?$msg:''}}</h7></p>
                <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
            </center>
        </form>
    </div>
@endsection
