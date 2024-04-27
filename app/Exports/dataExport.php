<?php

namespace App\Exports;

use App\Models\ExcelData;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\MyNamespace\cPanelApi;

class DataExport implements FromCollection
{
    protected $count;

    public function __construct($count,$sort)
    {
        $this->count = $count;
        $this->sort = $sort;
    }

    public function collection()
    {
        
        $api = new cPanelApi("leyn.io","leyn", "NaNoTR2001.");
        $domains =  $api->listDomains();
        $data = json_decode($domains, true);
        $subDomains = $data['data']['sub_domains'];
        $filteredData = ExcelData::whereIn('domain', $subDomains)->orderBy('created_at', $this->sort )->take($this->count)->get();
    
        return $filteredData;
    }
}
