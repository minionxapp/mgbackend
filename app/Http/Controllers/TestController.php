<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        //Login
        $url_login ='https://mgbackend.herokuapp.com/api/login';
        // $url_login ='http://127.0.0.1:8000/api/login';

        $request = Request::create($url_login, 'POST');
        $request->headers->set('Accept', 'application/json');
        // $request->headers->set('Authorization', 'Bearer '.$token);
        $request->merge(['email' => 'mugi@gmail.com', 'password' => '1234qwerty']);
        $res = app()->handle($request);
        $profile_details = json_decode($res->getContent()); // convert to json object
        // return $profile_details;
        $token = $profile_details->access_token;
        return $token;

        $url_prog ='https://mgbackend.herokuapp.com/api/api/programs';
        // $url_prog ='http://127.0.0.1:8000/api/programs';
        $request2 = Request::create($url_prog, 'GET');
        $request2->headers->set('Accept', 'application/json');
        $request2->headers->set('Authorization', 'Bearer '.$token);
        $res2 = app()->handle($request2);
        $programs = json_decode($res2->getContent()); // convert to json object
        // dd($res2);
        return $programs;
    }
}
