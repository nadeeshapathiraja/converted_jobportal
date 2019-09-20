<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers;
use App\User;
use Validator;
use App\Repositories\AuditRepository as Audit;

use Auth;
use Flash;
use Excel;

class ImportController extends Controller
{

 /**
 * @return \Illuminate\Http\RedirectResponse
 */
 public function index()
 {
   //...
 }

 /**
 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
 */
 public function excel()
 {
     $page_title = "Import Excel";
     $page_description = "Import & Read the Excel file";

     return view('import', compact('page_title', 'page_description'));
 }
 
 public function postExcel(Request $request)
 {
        
    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {        
        $path = $_FILES['file']['tmp_name'];
        $tag_data = '';
        $data = Excel::load($path, function($reader) {})->get();
        $data_arr = $data->toArray();    
        return   $data_arr;  
        foreach ($data_arr as $key => $value) {            
            $tag_data .= $value['email_list']  . ';';
        }        
        //return "'". substr($tag_data, 0, -1) . "'";
        return $tag_data;
    }

    /*
    $destination_path = storage_path('uploads');
    $_arr_excel_ext = array('xls', 'xlsx');
    if($request->hasFile('importExcel')){
        if (!in_array($file->getClientOriginalExtension(), $_arr_excel_ext)) {
            Flash::error("Sorry, please use .xls or .xlsx extension!");
            return redirect()->route('import.excel');
         }
            $path = $request->file('importExcel')->getRealPath();

            Excel::load($path, function($reader) {
                    $reader->each(function($sheet) {
                    // Loop through all rows
                    $sheet->each(function($row) {
                        echo $row.',';
                    });

                });
            })->get();
            dd($data);            

        }else{
            //not a valid file or no file
        }

        dd('END');     
 
     if (!$file->move($destination_path, $file->getClientOriginalName())) {
        Flash::error("Sorry, error on loading excel!");
        return redirect()->route('import.excel');
     }*/

     //use 'chunk' to read large excel data file          
 }
 
}