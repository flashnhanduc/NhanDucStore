<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function uploadImage(Request $request){
   
    $fileName = time() . '-' . $_FILES['file']['name'];
    $a = $request->file('file')->storeAs('images', $fileName);
    $url = '/storage/' . $a;
    
    return response()->json([
        'success' => true,
        'path' => $url
    ]);
    }
    public function uploadImages(Request $request){
        $files = $request->file('files');
    for ($i = 0; $i < count($files); $i++) {
        $fileName = time() . '-' . $files[$i]->getClientOriginalName();
        $a = $files[$i]->storeAs('images', $fileName);
        $url[] = '/storage/' . $a;
    }

    return response()->json([
        'success' => true,
        'paths' => $url
    ]);

    }
}
