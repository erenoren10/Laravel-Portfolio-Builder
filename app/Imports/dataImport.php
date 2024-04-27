<?php

namespace App\Imports;


use App\Models\ExcelData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;

use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class DataImport implements ToModel, WithHeadingRow/*, WithChunkReading,*/, WithBatchInserts
{


	private $nameCounts = [];

	/**
	 * @param array $row
	 *
	 * @return \Illuminate\Database\Eloquent\Model|null
	 */
	public function model(array $row)
	{
		$originalName = $row['name'];
        $name = $originalName;
        $count = 1;
    
        // Veritabanında aynı isimde kayıt var mı kontrol et
        $existingRecord = ExcelData::where('name', $originalName)->first();
        if ($existingRecord) {
            // Var ise, sayıyı artır ve ismi güncelle
            $count = ++$this->nameCounts[$originalName];
            $name = $originalName . '_' . $count;
        } else {
            // Yok ise, yeni bir isim oluştur ve sayıyı sıfırla
            $this->nameCounts[$originalName] = 1;
        }
    
        // Veritabanındaki aynı isimde kayıt var mı kontrol et
        $databaseRecord = ExcelData::where('name', $name)->first();
        if ($databaseRecord) {
            // Var ise, ismi daha da benzersiz hale getir
            $count = ++$this->nameCounts[$originalName];
            $name = $originalName . '_' . $count;
        }
    
        $slug = Str::slug($name);
        $domain = $slug . ".leyn.io";


	
		return new ExcelData([
			'query' => $row['query'], 
			'name' => $name,
			'site' => $row['site'],
			'type' => $row['type'],
			'subtypes' => $row['subtypes'],
			'category' => $row['category'],
			'phone' => $row['phone'],
			'full_adress' => $row['full_address'],
			'borough' => $row['borough'],
			'street' => $row['street'],
			'city' => $row['city'],
			'postal_code' => $row['postal_code'],
			'state' => $row['state'],
			'us_state' => $row['us_state'],
			'country' => $row['country'],
			'country_code' => $row['country_code'],
			'latitude' => $row['latitude'],
			'longitude' => $row['longitude'],
			'time_zone' => $row['time_zone'],
			'plus_code' => $row['plus_code'],
			'area_service' => $row['area_service'],
			'rating' => $row['rating'],
			'reviews' => $row['reviews'],
			'reviews_link' => $row['reviews_link'],
			'reviews_tags' => $row['reviews_tags'],
			'reviews_per_score' => $row['reviews_per_score'],
			'reviews_per_score_1' => $row['reviews_per_score_1'],
			'reviews_per_score_2' => $row['reviews_per_score_2'],
			'reviews_per_score_3' => $row['reviews_per_score_3'],
			'reviews_per_score_4' => $row['reviews_per_score_4'],
			'reviews_per_score_5' => $row['reviews_per_score_5'],
			'photos_count' => $row['photos_count'],
			'photo' => $row['photo'],
			'street_view' => $row['street_view'],
			'located_in' => $row['located_in'],
			'working_hours' => $row['working_hours'],
			'working_hours_old_format' => $row['working_hours_old_format'],
			'other_hours' => $row['other_hours'],
			'popular_times' => $row['popular_times'],
			'business_status' => $row['business_status'],
			'about' => $row['about'],
			'range' => $row['range'],
			'posts' => $row['posts'],
			'logo' => $row['logo'],
			'description' => $row['description'],
			'typical_time_spent' => $row['typical_time_spent'],
			'verified' => $row['verified'],
			'owner_id' => $row['owner_id'],
			'owner_title' => $row['owner_title'],
			'owner_link' => $row['owner_link'],
			'reservation_links' => $row['reservation_links'],
			'booking_appointment_link' => $row['booking_appointment_link'],
			'menu_link' => $row['menu_link'],
			'order_links' => $row['order_links'],
			'location_link' => $row['location_link'],
			'place_id' => $row['place_id'],
			'google_id' => $row['google_id'],
			'cid' => $row['cid'],
			'reviews_id' => $row['reviews_id'],
			'located_google_id' => $row['located_google_id'],
			'domain' => $domain,
		]);
	}

	/*public function chunkSize(): int
	{
		return 3000; // Parça boyutu
	}*/

	public function batchSize(): int
	{
		return 1000; // Her işlemde eklenen satır sayısı
	}
}


