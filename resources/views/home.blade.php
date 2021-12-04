<?php
    // return redirect(url('/')."/".$fileName);
?>

@extends('layouts.app')
@section('content')
    <!-- Data Table -->
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap.min.css" rel='stylesheet' type='text/css'>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap.min.js"></script>
    <!-- <link href="/jslib3.1/dataTables.bootstrap.min.css" rel='stylesheet' type='text/css'>
    <script src="/jslib3.1/jquery.dataTables.min.js"></script>
    <script src="/jslib3.1/dataTables.bootstrap.min.js"></script> -->
   
    <div style="margin-left: 30px;">   
            <ul class="nav nav-pills" style="color:blue;">
                <li><span class="glyphicon glyphicon-filter" style="color:blue;font-size:24px;"></span></li>
                <li class="{{$filter=='track'?'active':''}}"><a href="/home/track">TrackData</a></li>
                <li class="{{$filter=='lab'?'active':''}}"><a href="/home/lab">LaboratoryData</a></li>
                <li class="{{$filter=='today'?'active':''}}"><a href="/home/today">TodayData</a></li>
                <li class="{{$filter=='all'?'active':''}}"><a href="/home/all">AllData</a></li>
            </ul>
        <form class="form-horizontal" action="{{url('/export/'.$filter)}}" method="post" style="margin-top: 20px;"> 
        {{ csrf_field() }}
            <ul class="nav nav-pills" style="color:blue;float: right;">
                <li>
                    <div class="form-group has-success">
                        <label class="col-sm-3 control-label">From:</label>
                        <div class="col-sm-8">
                            <?php                                 
                                if(!isset($frmDate)) $frmDate = '';
                            ?> 
                            <input class="form-control input-sm" name="frmDate" type="date" value = "{{$frmDate}}">
                        </div>
                    </div>
                </li>
                <li>
                    <div class="form-group has-success">
                        <label class="col-sm-3 control-label">To:</label>
                        <div class="col-sm-9">
                            <?php                                 
                                if(!isset($toDate))  $toDate = '';
                            ?> 
                            <input class="form-control input-sm" name="toDate" type="date" value = "{{$toDate}}">
                        </div>
                    </div>
                </li>
                <li style="margin-left: 50px;">
                    <div class="form-group has-success">
                        <label class="col-sm-4 control-label">Location:</label>
                        <div class="col-sm-8">
                            <select class="form-control input-sm" name="Location">
                                <option></option>
                            @foreach($locations as $location)
                                <?php                                 
                                    if(isset($Location) && $Location == $location)  $sel = 'selected';
                                    else                                            $sel = '';
                                ?> 
                                <option {{$sel}} value="{{$location}}">{{$location}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </li>
                <li style="margin-left: 50px;">
                    <div class="form-group has-success">
                        <label class="col-sm-4 control-label">BatchNo:</label>
                        <div class="col-sm-8">
                            <select class="form-control input-sm" name="BatchNo">
                                <option></option>
                            @foreach($batchnos as $batchno)
                                <?php                                 
                                    if(isset($BatchNo) && $BatchNo == $batchno)     $sel = 'selected';
                                    else                                            $sel = '';
                                ?> 
                                <option {{$sel}} value="{{$batchno}}">{{$batchno}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </li>
                <li style="margin-left:50px;">
		            <div class="form-group">
                        <input type="submit" class="btn btn-success" value = "Export to Execl">
                    </div>
                </li>
                <li style="margin-left:50px;"></li>
            </ul>
        </form>
        <br><br><br>
        <hr style="border-width: 1px; border-top-color:green; margin-top: 0;">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                @foreach($fields as $key => $field)
                    <th>    
                        @if($key == 0)  {{'No'}}
                        @else           {{$field}}
                        @endif
                    </th>
                @endforeach
                </tr>
            </thead>
            <tbody>
            @foreach($results as $num => $record)
                <tr>
                @foreach($record as $key => $value)
                    <td>
                        @if($key == 'id')  {{$num+1}}
                        @elseif($key == 'Delete')
                            <form action="{{ url('/home/'.$filter)}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger">
                                    <input type='hidden' name='id' value="{{$record->id}}">
                                    <i class="fa fa-btn fa-trash"></i>Delete
                                </button>
                            </form>
                        @else           {{$value}}
                        @endif
                    </td>
                @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            } );
        </script>
    </div>
    @if(isset($isDown))
        <script>
            document.location.href = "/Lars.xlsx";
        </script>
    @endif
@endsection
