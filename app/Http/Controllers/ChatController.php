<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use Redis;
 
class ChatController extends Controller {
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index()
	{
		return view('home');
	}
	public function systemMessage()
	{
        
	}
}