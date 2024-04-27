<?php

namespace App\Http\Controllers;

use App\Models\ExcelData;
use App\MyNamespace\cPanelApi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WhmController extends Controller
{
    public function delSubdomain(Request $request)
    { 
        $requestSubdomain = $request->input('subdomain');



        //cPanel hesap bilgileri
        $cpanelUsername = "leyn";
        $cpanelPassword = "NaNoTR2001.";
        $whmHostname = "135.181.67.116"; // WHM sunucu adı veya IP adresi
        $cpanelDomain = "leyn.io"; // Ana domain
        
        // Silinecek subdomain
        $subdomain = "$requestSubdomain";
        
        // WHM API bağlantı URL'si
        $whmApiUrl = "https://" . $whmHostname . ":2087/json-api/cpanel";
        
        // cURL ile WHM API çağrısını yap
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $cpanelUsername . ":" . $cpanelPassword);
        curl_setopt($curl, CURLOPT_URL, $whmApiUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, [
            'cpanel_jsonapi_user' => $cpanelUsername,
            'cpanel_jsonapi_module' => 'SubDomain',
            'cpanel_jsonapi_func' => 'delsubdomain',
            'cpanel_jsonapi_apiversion' => '2',
            'domain' => $cpanelDomain,
            'subdomain' => $subdomain,
        ]);
        
        $response = curl_exec($curl);
        curl_close($curl);
        
        // API yanıtını işleme
        $result = json_decode($response, true);
        dd($result);
        if ($result['metadata']['result'] == 0) {
            // Hata durumu
            echo "Subdomain silme başarısız: " . $result['data']['reason'] . "\n";
        } else {
            // Başarı durumu
            echo "Subdomain başarıyla silindi.\n";
        }


        /*
        // cPanel hesap bilgileri
        $cpanelUsername = "kupononline";
        $cpanelPassword = "NaNoTR2001.";
        $cpanelDomain = "kupononline.com"; // Ana alan adı

        // Kaldırılacak subdomain
        $subdomain = $requestSubdomain;

        // cPanel API bağlantı URL'si
        $cpanelUrl = "https://kupononline.com:2083/cpsess" . session_id() . "/json-api/cpanel";

        // cURL ile cPanel API çağrısını yap
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERPWD, $cpanelUsername . ":" . $cpanelPassword);
        curl_setopt($curl, CURLOPT_URL, $cpanelUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, [
            'cpanel_jsonapi_module' => 'SubDomain',
            'cpanel_jsonapi_func' => 'delsubdomain',
            'cpanel_jsonapi_apiversion' => '2',
            'cpanel_jsonapi_user' => $cpanelUsername,
            'cpanel_jsonapi_pass' => $cpanelPassword,
            'domain' => $cpanelDomain,
            'subdomain' => $subdomain,
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        // API yanıtını işleme
        $result = json_decode($response, true);

        if ($result['cpanelresult']['error'] != null) {
            // Hata durumu
            echo "Subdomain kaldırma başarısız: " . $result['cpanelresult']['error'] . "\n";
        } else {
            // Başarı durumu
            echo "Subdomain başarıyla kaldırıldı.\n";
        }
*/
    }


    public function addSubdomain(Request $request)
    {
        
        ini_set('memory_limit', '4096M');
        $selectedDomains = $request->input('selectedDomains');
        // $selectedDomains boşsa hata mesajı döndür
        if (empty($selectedDomains)) {
            return redirect('/admin/nondomains')->with('error', 'Hiç seçilen domain yok!');
        }

        $chunks = array_chunk($selectedDomains, 50);
        
        foreach ($chunks as $datas) {
            foreach ($datas as $data) {
                $slug = $data;
        
                $api = new cPanelApi("leyn.io","leyn", "NaNoTR2001.");
                $result = $api->createSubdomain($slug, "public_html/public/detay");
    
                if ($result === false) {
                    dd(error_log('Failed to create subdomain for ' . $slug));
                }
            }
        }


        return redirect('/admin/nondomains')->with('success', 'Subdomianler oluşturuldu!');

    }
}
