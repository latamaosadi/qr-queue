<?php

namespace App\Http\Controllers\API;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Mail\QueueNoticeMail;
use App\Profile;
use Carbon\Carbon;
use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpClient\HttpClient;

class ScannerController extends Controller
{
    public function scan(Request $request)
    {
        $url = $request->input('url');
        $client = new Client(HttpClient::create(['timeout' => 60]));
        $crawler = $client->request('GET', $url);
        $nameElement = $crawler->filter('h2.name')->first();
        $nama = $nameElement->text();
        $nodeValues = $crawler->filter('h4')->each(function ($node) {
            return $node->text();
        });
        $tanggalLahir = Carbon::createFromFormat('d/m/Y', $nodeValues[1]);
        $nik = str_replace(" ", "", $nodeValues[2]);
        $program = $nodeValues[3];
        $no_hp = $nodeValues[4];
        $email = $nodeValues[5];
        $alamat = $nodeValues[6];

        $profile = Profile::firstOrNew(
            ['nik' => $nik],
        );
        $profile->nama = $nama;
        $profile->no_hp = $no_hp;
        $profile->email = $email;
        $profile->alamat = $alamat;
        $profile->program = $program;
        $profile->tanggal_lahir = $tanggalLahir;
        $profile->save();

        $customer = new Customer();
        $customer->profile_id = $profile->id;
        $customer->url = $url;
        $customer->save();

        Mail::to($profile->email)->send(new QueueNoticeMail($profile->name, $customer->queue));

        return $customer;
    }
}
