<?php

namespace App\Http\Controllers;

use App\Mail\NewUserMail;
use App\Models\account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class accountController extends Controller
{
    public function submit (Request $req)
    {
        $account = new account();
        $account->fullName = $req->name;
        $account->userName = $req->username ;
        $account->birthDate = $req->date ;
        $account->phone = $req->phone ;
        $account->address = $req->address ;
        $account->password = $req->password ;
        $account->email = $req->email ;

        $account->save();
        return view ('form');
    }

    public function checkUserName (Request $r)
    {
        $username = $r->username;
        if (DB::table('accounts')->where('username', $username)->doesntExist())
        {
            $this->submit($r);
            $this->sendEmail($username);
            return view('message',['message'=>"Registraion successed"]);
        }
        else
        {
            return view('message',['message'=>"This user name already exists please try another one"]);
        }
    }
    public function sendEmail($username)
    {
        $data = [
            'username' => $username ,
        ];

        Mail::to('salma.moh.shalaby@gmail.com')->send(new NewUserMail($data));

        return redirect()->back();

    }
    public function sameDate(int $month, int $day)
    {

        $curl = curl_init();

        curl_setopt_array($curl, [
	    CURLOPT_URL => "https://online-movie-database.p.rapidapi.com/actors/list-born-today?month=".$month."&day=".$day,
	    CURLOPT_RETURNTRANSFER => true,
	    CURLOPT_FOLLOWLOCATION => true,
	    CURLOPT_ENCODING => "",
	    CURLOPT_MAXREDIRS => 10,
	    CURLOPT_TIMEOUT => 30,
	    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	    CURLOPT_CUSTOMREQUEST => "GET",
	    CURLOPT_HTTPHEADER => [
		    "X-RapidAPI-Host: online-movie-database.p.rapidapi.com",
		    "X-RapidAPI-Key: ceca4fe5cemsh5fb6d571c55839ep129e56jsndc33da3a75cc"
	        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $data = json_decode($response);

        foreach ($data as $n)
        {
            $n = substr($n,6,9);

            $curl = curl_init();

           curl_setopt_array($curl, [
           CURLOPT_URL => "https://online-movie-database.p.rapidapi.com/actors/get-bio?nconst=".$n,
           CURLOPT_RETURNTRANSFER => true,
           CURLOPT_FOLLOWLOCATION => true,
           CURLOPT_ENCODING => "",
           CURLOPT_MAXREDIRS => 10,
           CURLOPT_TIMEOUT => 30,
           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
           CURLOPT_CUSTOMREQUEST => "GET",
           CURLOPT_HTTPHEADER => [
               "X-RapidAPI-Host: online-movie-database.p.rapidapi.com",
               "X-RapidAPI-Key: ceca4fe5cemsh5fb6d571c55839ep129e56jsndc33da3a75cc"
              ],
          ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            $re = json_decode($response);
            echo($re-> name. "<br>");
            sleep(0.05);
        }
    }

    public function setArabic()
    {
        App::setLocale('ar');
        return redirect()->back();
    }

    public function setEnglish()
    {
        App::setLocale('en');
        return redirect()->back();
    }

    public function switchLanguage(Request $request,$lang)
    {
        $request->session()->put('locale', $lang);
        app()->setLocale($lang);
        return view('form');
    }
}


