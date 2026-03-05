<?php

namespace App\Http\Controllers\QR_CODE;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\QrCode;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
        $user = Auth::user();
        $name = $user->name;
        $email = $user->email;

        $national_id = $request->nationality_id;
        $link = "http://127.0.0.1:8000/show/$national_id";

        $writer = new PngWriter();
        // توليد QR
        $qrImage = QrCode::create('http://127.0.0.1:8000/en/qrcode')->setSize(300)->setMargin(10);

        $result = $writer->write($qrImage);


        $fileName = 'qqcode-' . uniqid() . '.png';
        $relativePath = 'Clint/' . $national_id . '/' . $fileName;

        // Ensure we save it safely into the custom 'QR' disk using Storage
        Storage::disk('QR')->put($relativePath, $result->getString());

        // إرسال الإيميل مع المرفق
        Mail::to($email)->send(new \App\Mail\SendQrMail(
            $relativePath, $national_id, $name
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
