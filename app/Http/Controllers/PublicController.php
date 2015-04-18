<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PublicController extends Controller {

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function landing()
    {
        return view('landing');
    }
}
