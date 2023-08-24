<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Notif extends Controller
{
    public function sendWhatsApp(Request $request)
    {
        
        $otp = mt_rand(100000, 999999);
        $apiKey = "b5991fddbad1729718b2fc7f86cff354c8ffe9bb";
        $recipient = "083820073252"; // atau $recipient = "Group Chat Name";
        $message = "JANGAN MEMBERITAHU KODE RAHASIA INI KE SIAPAPUN. WASPADA TERHADAP KASUS PENIPUAN! Kode Verifikasi untuk daftar di website : ".$otp;

        $url = 'https://starsender.online/api/sendText?message=' . rawurlencode($message) . '&tujuan=' . rawurlencode($recipient . '@s.whatsapp.net');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'apikey: ' . $apiKey
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

}
