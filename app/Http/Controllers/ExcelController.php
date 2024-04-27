<?php

namespace App\Http\Controllers;


use App\Exports\dataExport;
use App\Exports\nonDataExport;
use App\Models\ExcelData;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\dataImport;

class ExcelController extends Controller
{
	public function veriAl(Request $request)
	{
			if ($request->hasFile('dosya')) {
			if ($request->file('dosya')->getClientOriginalExtension() != 'xlsx') {
				return redirect('/admin')->with('error', 'Lütfen bir Excel dosyası yükleyin!');
			}
		} else {
			return redirect('/admin')->with('error', 'Dosya bulunamadı!');
		}

		$dosya = $request->file('dosya');

		Excel::import(new dataImport, $dosya);

		return redirect('/admin')->with('success', 'Excel dosyası başarıyla içe aktarıldı!');
	}

	public function veriCikart(Request $request)
	{
		set_time_limit(0);
		ini_set('memory_limit', '2048M');
		
        $sortBy = $request->input('sort_by', 'asc');
		$count = $request->input('count');
        
		return Excel::download(new dataExport($count,$sortBy), 'datas.xlsx');
	}
	
	public function nonVeriCikart(Request $request)
	{
		set_time_limit(0);
		ini_set('memory_limit', '2048M');
		
        $sortBy = $request->input('sort_by', 'asc');
		$count = $request->input('count');

    
		return Excel::download(new nonDataExport($count,$sortBy), 'nondatas.xlsx');
	}
}
