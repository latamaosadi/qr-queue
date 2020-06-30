<?php

namespace App\Http\Controllers\API;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Mail\QueueNoticeMail;
use App\Profile;
use Carbon\Carbon;
use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpClient\HttpClient;

class ScannerController extends Controller
{
    public function scan(Request $request)
    {
        $storage = Storage::disk('public');
        $url = $request->input('url');
        $client = new Client(HttpClient::create(['timeout' => 60]));
        $crawler = $client->request('GET', $url);

        // ambil gambar
        $avatarElement = $crawler->filter('div.img')->first();

        // ambil nama
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

        if (!Config::get('app', 'on_external_netwok')) {
            $matchedAttr = null;
            preg_match("/'([^']+)'/", $avatarElement->attr('style'), $matchedAttr);
            $avatar = file_get_contents("http://bpjstk.id{$matchedAttr[1]}");
            $storage->put("avatar/{$nik}.jpg", $avatar);
        }

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
