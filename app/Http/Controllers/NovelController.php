<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Novel;
use App\Episode;
use Image;

class NovelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('novels.create');
    }

    public function edit($id)
    {
        $novel = Novel::find($id);
        return view('novels.edit', compact('novel'));
    }

    public function update(Request $request, $id)
    {
      if($request->hasFile('novelimage')){
        $novelimage =  $request->file('novelimage');
        $filename = time() . '.' . $novelimage->getClientOriginalExtension();
        Image::make($novelimage)->save( public_path('/uploads/novelimage/' . $filename ) );

          $this->validate($request, [
            'title'=>'required',
            'author'=>'required',
            'srsume'=>'required',
          ]);
          // store
          $novel = Novel::findOrFail($id);
          $novel->title = $request->input('title');
          $novel->novelimage = $filename;
          $novel->author = $request->input('author');
          $novel->srsume = $request->input('srsume');
          $novel->save();

          // redirect
          $input = $novel->id;
          return redirect()->route('mynovel', $input);
        }else {
          $this->validate($request, [
            'title'=>'required',
            'author'=>'required',
            'srsume'=>'required',
          ]);
          // store
          $novel = Novel::findOrFail($id);
          $novel->title = $request->input('title');
          $novel->author = $request->input('author');
          $novel->srsume = $request->input('srsume');
          $novel->save();

          // redirect
          $input = $novel->id;
          return redirect()->route('mynovel', $input);
        }

    }

    public function destroy($id)
     {
         // delete
         $novel = Novel::findOrFail($id);
         $novel->delete();

         // redirect
         return redirect()->route('mynovels');
     }

    public function store(Request $request)
    {
        if($request->hasFile('novelimage')){
          $novelimage =  $request->file('novelimage');
          $filename = time() . '.' . $novelimage->getClientOriginalExtension();
          Image::make($novelimage)->save( public_path('/uploads/novelimage/' . $filename ) );

          $request->validate([
                'title'=>'required',
                'author'=>'required',
                'srsume'=>'required',
            ]);

            $input = $request->all();
            $input['novelimage'] = $filename;
            $input['user_id'] = auth()->user()->id;

            Novel::create($input);

            return redirect()->route('mynovels');
        }else {
          $request->validate([
                'title'=>'required',
                'author'=>'required',
                'srsume'=>'required',
            ]);
            $input = $request->all();
            $input['user_id'] = auth()->user()->id;
            Novel::create($input);
            return redirect()->route('mynovels');
        }
    }

    public function mynovels()
    {
      $novels = Novel::all();
      return view('novels.index', compact('novels'));
    }

    public function mynovel($novelid)
    {
        $novel = Novel::find($novelid);
        $episodes = Episode::all();
        return view('novels.show', compact('novel'), compact('episodes'));
    }

    public function mynovelep($id)
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
      return view('novels.read', compact('episode', 'eps','novel_one','back','next'));
    }

}
