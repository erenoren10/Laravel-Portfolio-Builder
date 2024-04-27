<?php

namespace App\Http\Controllers;

use App\Models\ExcelData;
use App\Models\Count;
use Illuminate\Http\Request;
use App\MyNamespace\cPanelApi;

class DomainController extends Controller
{
    public function index(){

        $countRow = ExcelData::count(); // Tüm satırların sayısını alır


        return view('admin.index',compact('countRow'));
    }
    public function domainsPage(){

   
        $api = new cPanelApi("leyn.io","leyn", "NaNoTR2001.");
        $domains =  $api->listDomains();

        $data = json_decode($domains, true);
        $subDomains = $data['data']['sub_domains'];
        

        return view('admin.domains',compact('subDomains'));
    }

    public function nondomainsPage(Request $request){
        
        
        $records_per_minute = Count::get()->first();
        $exceldatas = ExcelData::get()->take($records_per_minute->records_per_minute);
        $api = new cPanelApi("leyn.io","leyn", "NaNoTR2001.");
        foreach($exceldatas as $data){
            $slug = $data->domain;
            $result = $api->createSubdomain($slug, "public_html/public/detay");
        }
        $perPage = $request->input('perPage', session('perPage', 100));
        $domains =  $api->listDomains();
        $data = json_decode($domains, true);
        $subDomains = $data['data']['sub_domains'];
        $records = ExcelData::whereNotIn('domain', $subDomains)->simplePaginate($perPage);
        $counts = ExcelData::whereNotIn('domain', $subDomains)->count();
        
        $request->session()->put('perPage', $perPage);
       
        
        return view('admin.nondomains', compact('records', 'counts', 'records_per_minute'))->with('success', $records_per_minute->records_per_minute." Subdomain oluşturuldu.");
    }
    
    public function searchdomainsPage(Request $request){
        
        $records_per_minute = Count::get()->first();
        $searchText = $request->input('search');
        $perPage = $request->input('perPage', session('perPage', 100));

        $api = new cPanelApi("leyn.io", "leyn", "NaNoTR2001.");
        $domains = $api->listDomains();
        $data = json_decode($domains, true);
        $subDomains = $data['data']['sub_domains'];

        $query = ExcelData::whereNotIn('domain', $subDomains);

        // Eğer bir arama metni varsa, bu metni kullanarak veritabanında arama yap
        if ($searchText) {
            $query->where('domain', 'LIKE', '%' . $searchText . '%');
            // İlgili kolon adını, arama yapmak istediğiniz kolon adıyla değiştirin
        }

        $records = $query->simplePaginate($perPage);
        $counts = ExcelData::whereNotIn('domain', $subDomains)->count();
        $request->session()->put('perPage', $perPage);

        return view('admin.nondomains', compact('records', 'searchText','counts','records_per_minute'));
    }
    
    public function updateRecords(Request $request){

        $dataCount = $request->input('dataCount');
        
        Count::where('id', 1)->update(['records_per_minute' => $dataCount]);

        return redirect()->route('admin.nondomains')->with('success', 'İşlem başarıyla tamamlandı.');
    }





}
