<?php

namespace App\Http\Controllers;

use App\Models\Ward;
use Illuminate\Http\Request;

class WardsController extends Controller
{
   public function getWards(Request $request)
{
    $provinceCode = $request->province_code;
    // Lấy code và name, code là khóa chính của bảng wards
    $wards = Ward::where('province_code', $provinceCode)->get(['code', 'name']);
    return response()->json($wards);
}
}
