<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Illuminate\Support\Facades\DB;
use App\Emp;
class ExlController extends Controller {
    public function index(){
        $emp = Emp::paginate(5); 
        return view('employee', ['emp' => $emp]);
    }
	public function export(Request $request, $filter) {
		// $employees = Emp::all();
		error_log("INFO: post /export/$filter/$request->frmDate");
		$fields = ['id','BatchNo','Recorder','Location','DateTime','Comment','LatexTemperature','LatexPH','LatexViscosity','ProductSymbol','Quantity','Drum','TotalSolids','ChloroformTest','GellPoint','LatexMechanical','Delete'];
		if($filter=='lab'){
			array_splice($fields, 9, 6);
		}elseif($filter=='track'){
			array_splice($fields, 15, 1);
		}		
		$results = DB::table('tasks')->select($fields)->where('Delete', 1);
		$results = $results->orderBy('DateTime', 'DEC');

		if($filter == 'today')		$results = $results->where('DateTime', 'LIKE', date('Y-m-d').'%');
		elseif($filter == 'lab')	$results = $results->where('Location','laboratory');
		elseif($filter == 'track')	$results = $results->where('Location','<>','laboratory');
		$gets = $results->get(); $locations = []; $batchnos = [];
		foreach($gets as $get){ 
			$locations[] = $get->Location;//array_push($locations, $get['Location']);
			array_push($batchnos, $get->BatchNo);
		}
		$locations = array_unique($locations, SORT_STRING);
		$batchnos = array_unique($batchnos, SORT_STRING);
		
		if($request->Location != '') $results = $results->where('Location', $request->Location);
		if($request->BatchNo != '') $results = $results->where('BatchNo', $request->BatchNo);
		if($request->frmDate != '') $results = $results->where('DateTime', '>=', "$request->frmDate");
		if($request->toDate != '') $results = $results->where('DateTime', '<=', $request->toDate);
		$results = $results->get();

		$rows = 1;
		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
		foreach($fields as  $key => $field){
			$sheet->setCellValue(chr(65+$key).$rows, $field);
		}
		foreach($results as $result){
            $rows++;
			foreach($fields as $key => $field){
				$sheet->setCellValue(chr(65+$key).$rows, $result->$field.'');
			}		
		}	   
	    $fileName = "Lars.xlsx";
		$writer = new Xlsx($spreadsheet);
		$writer->save($fileName);
		header("Content-Type: application/vnd.ms-excel");
		return view('home', ['pg'=>'home', 'filter'=>$filter, 'fields'=>$fields, 'results'=>$results, 'isDown'=>1, 
					'toDate'=>$request->toDate, 'frmDate'=>$request->frmDate, 'Location'=>$request->Location, 'BatchNo'=>$request->BatchNo,
					'locations'=>$locations, 'batchnos'=>$batchnos]);
    }
}
