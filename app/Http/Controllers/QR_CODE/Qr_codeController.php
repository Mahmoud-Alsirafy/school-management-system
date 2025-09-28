<?php

namespace App\Http\Controllers\QR_CODE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Qr_codeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.QR_Code.Generate');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function generate(Request $request)
    {

        // المستخدم
         $user = Auth::user()->name; 

        $national_id = $request->nationality_id;
        $link = "http://127.0.0.1:8000/show/$national_id";

        // توليد QR
        $qrImage = QrCode::format('png')->size(300)->errorCorrection('H')->generate($link);

        // فولدر العميل
        $folderPath = storage_path('app/QR/Clint/' . $national_id);
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0755, true);
        }

        // اسم الملف
        $fileName = 'qr_code.png';
        $filePath = $folderPath . '/' . $fileName;

        // حفظ الصورة
        file_put_contents($filePath, $qrImage);

        // إرسال الإيميل مع المرفق
        Mail::to("zeyadwael066@gmail.com")->send(new \App\Mail\SendQrMail(
            'QR/Clint/' . $national_id . '/' . $fileName,$national_id,$user
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
