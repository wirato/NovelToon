<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Novel;
use App\Manga;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $username = auth()->user()->name;
      // echo '<script language="javascript">';
      // echo 'alert("'.$username.': ได้ทำการเข้าสู่ระบบเรียบร้อยแล้ว")';
      // echo '</script>';
      $novels = Novel::all();
      $mangas = Manga::all();
      $count = 0;
      $count2 = 0;

      return view('welcome', compact('novels','mangas','count','count2'));
    }
}
