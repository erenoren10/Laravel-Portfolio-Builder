<?php

// PostController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        // PostgreSQL'deki "excels" tablosundan verileri al
        $excels = DB::table('excels')->get();

        // Verileri view'e geçirerek sayfayı render et
        return view('excels.index', ['excels' => $excels]);
    }
}

?>