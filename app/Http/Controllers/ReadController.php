<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Novel;
use App\Episode;
use App\Manga;

class ReadController extends Controller
{
  public function noveldetails($novelid)
  {
      $novel = Novel::find($novelid);
      $episodes = Episode::all();
      return view('novelDetails', compact('novel'), compact('episodes'));
  }

  public function shownovels()
  {
    $novels = Novel::all();
    $mangas = Manga::all();
    $count = 0;
    $count2 = 0;

    return view('welcome', compact('novels','mangas','count','count2'));
  }

  public function allnovels()
  {
    $novels = Novel::all();
    return view('novels', compact('novels'));
  }


      public function readEp($id)
      {
        $episode = Episode::find($id);
        $novels = Novel::all();
        $eps = Episode::all();

        foreach($novels as $novel){
          if ($novel->id == $episode->novel_id) {
            $novel_one = $novel;
          }
        }

        $count = 0;
        foreach($eps as $ep){
          if($episode->novel_id == $ep->novel_id){

            $count++;
          }
        }
        $te = false;
        $next = 0;
        $back = 0;
        $b = 0;
        foreach($eps as $ep){
          if($episode->novel_id == $ep->novel_id){
            if($te == false){
              if($ep->ep == $episode->ep){
                $te = true;
                $back = $b;
              }else {
                $b = $ep->id;
              }
            }else {
                $next = $ep->id;
                $te = false;
            }
          }
        }

        // echo 'c '.$count.' ep now '.$episode->ep.' ID '.$episode->id.' back id :'.$back.' next id :'.$next;;
        return view('raadEpNovel', compact('episode', 'eps','novel_one','back','next'));
      }
}
