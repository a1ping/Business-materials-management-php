<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
    * Show Task Dashboard
    */
Route::get('/*', function () {
    error_log("INFO: get /*");
    return view('login');
});

Route::get('/', function () {
    error_log("INFO: get /");
    session(['level' => '']);
    return view('login');
});
Route::post('/login', function (Request $request) {
    error_log("INFO: get /login");
    $user = DB::table('users')->where('name',$request->username)->get();
    if(count($user)){
        session(['level' => $user[0]->level]);
        if($user[0]->level == 'master')
            return redirect('/home');
        else if($user[0]->level == 'supplier')
            return redirect('/supplier');
    }else
        return view('login', [
            'msg'=>'Invalid user\'s name or password.', 
            'name'=>$request->username, 'psw'=>$request->password
        ]);
});

Route::get('/loginout', function () {
    error_log("INFO: get /loginout");
    return redirect('/');
});

Route::get('/home', function () {
    error_log("INFO: get /home");
    return redirect("/home/all");
});
Route::get('/home/{filter}', function ($filter) {
    error_log("INFO: get /home/$filter");
     $fields = ['id','BatchNo','Recorder','Location','DateTime','Comment','LatexTemperature','LatexPH','LatexViscosity','ProductSymbol','Quantity','Drum','TotalSolids','ChloroformTest','GellPoint','LatexMechanical','Delete'];
    if($filter=='lab'){
        array_splice($fields, 9, 6);
    }elseif($filter=='track'){
        array_splice($fields, 15, 1);
    }
    
    $results = DB::table('tasks')->select($fields)->where('Delete', 1);
    $results = $results->orderBy('DateTime', 'DEC');
    if($filter == 'today'){
        $results = $results->where('DateTime', 'LIKE', date('Y-m-d').'%');
    }elseif($filter == 'lab'){
        $results = $results->where('Location','laboratory');
    }elseif($filter == 'track'){
        $results = $results->where('Location','<>','laboratory');
    }
    $gets = $results->get(); $locations = []; $batchnos = [];
    foreach($gets as $get){ 
        $locations[] = $get->Location;//array_push($locations, $get['Location']);
        array_push($batchnos, $get->BatchNo);
    }
    $locations = array_unique($locations, SORT_STRING);
    $batchnos = array_unique($batchnos, SORT_STRING);
    $results = $results->get();
    return view('home', ['pg'=>'home', 'filter'=>$filter, 'fields'=>$fields, 'results'=>$results,
                'locations'=>$locations, 'batchnos'=>$batchnos]);
});
Route::delete('/home/{filter}', function (Request $request, $filter) {
    error_log("INFO: delete /home/$filter");
    DB::table('tasks')->where('id', $request->id)->update(['Delete'=>0]);
    return redirect("/home/$filter");
});

Route::post('/export/{filter}', 'ExlController@export');

Route::get('/laboratory', function () {
    error_log("INFO: get /laboratory");
    return view('laboratory', ['pg'=>'laboratory']);
});
Route::post('/laboratory', function (Request $request) {
    error_log("INFO: post /laboratory");
    $rst = DB::table('tasks')->updateOrInsert(
        // ['BatchNo'=>$request->BatchNo],
        [
        'BatchNo'=>$request->BatchNo, 'Location'=>$request->labLocation, 'DateTime'=>$request->labDateTime, 'Recorder'=>$request->labName,
        'LatexTemperature'=>$request->labTemperature, 'LatexPH'=>$request->labPH, 'LatexViscosity'=>$request->labViscosity,
        'LatexMechanical'=>$request->labMechanical, 'Comment'=>$request->labComment
    ]);
    if($rst)    $msg = "Inserting or Updating into database processed  successfully.";
    else    $msg = "Inserting or Updating into database did't process  successfully.";
    return view('laboratory', ['pg'=>'laboratory', 'msg'=>$msg]);
});

Route::get('/supplier', function () {
    error_log("INFO: get /supplier");
    return view('supplier', ['pg'=>'supplier']);
});
Route::post('/supplier', function (Request $request) {
    error_log("INFO: post /supplier");
    $rst = DB::table('tasks')->updateOrInsert(
        // ['BatchNo'=>$request->BatchNo],
        [
        'BatchNo'=>$request->BatchNo, 'Location'=>$request->supLocation, 'Recorder'=>$request->supName,
        'DateTime'=>$request->supDate, 'ProductSymbol'=>$request->supProduct, 'Quantity'=>$request->supQuantity,
        'Drum'=>$request->supDrum, 'LatexTemperature'=>$request->supPick, 'TotalSolids'=>$request->supSolide,
        'LatexViscosity'=>$request->supViscosity, 'LatexPH'=>$request->supPH, 'ChloroformTest'=>$request->supChloroform,
        'GellPoint'=>$request->supGell, 'Comment'=>$request->supComment
    ]);
    if($rst)    $msg = "Inserting or Updating into database processed  successfully.";
    else    $msg = "Inserting or Updating into database did't process  successfully.";
    return view('supplier', ['pg'=>'supplier', 'msg'=>$msg]);
});

/*********task sample *****************/
Route::get('/task', function () {
    error_log("INFO: get /");
    return view('tasks', [
        'tasks' => Task::orderBy('created_at', 'asc')->get()
    ]);
});
Route::post('/task', function (Request $request) {
    error_log("INFO: post /task");
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        error_log("ERROR: Add task failed.");
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/');
});

/**
    * Delete Task
    */
Route::delete('/task/{id}', function ($id) {
    error_log('INFO: delete /task/'.$id);
    Task::findOrFail($id)->delete();
    return redirect('/');
});
