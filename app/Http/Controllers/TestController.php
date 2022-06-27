<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function index()
    {
        // //Login
        $url_login ='https://mgbackend.herokuapp.com/api/login';
        $url_prog  ='https://mgbackend.herokuapp.com/api/programs';
 
//get key (login)
$response = Http::withHeaders([
    // 'Authorization' => 'token' 
    'Accept'=> 'application/json'
])->post($url_login, [
    'email' => 'mugi@gmail.com',
    'password' => '1234qwerty'
]);

$rest = $response->body();
$xj = json_decode($rest);// decode($rest->getContent());
$token= $xj->access_token;

//get data (get)
$response2 = Http::withHeaders([
    'Authorization' => 'Bearer '.$token,
    'Accept'=> 'application/json'
])->get($url_prog);


return $token ." ***** ". $response2->body();


    }
}
