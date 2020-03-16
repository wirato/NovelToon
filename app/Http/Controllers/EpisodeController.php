<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Episode;
use App\Novel;

class EpisodeController extends Controller
{

      public function __construct()
      {
          $this->middleware('auth');
      }
     public function create()
     {

     }

     public function edit($id)
     {
         // $episode = Episode::find($id);
         // return view('novels.editEp', compact('$episode'));
         $episode = Episode::find($id);
         $novels = Novel::all();
         return view('novels.editEp', compact('episode') ,compact('novels'));
     }

     public function update(Request $request, $id)
     {
           $this->validate($request, [
             'ep'=>'required',
             'title'=>'required',
             'detail'=>'required',
           ]);
           // store
           $episode = Episode::findOrFail($id);
           $episode->ep = $request->input('ep');
           $episode->title = $request->input('title');
           $episode->detail = $request->input('detail');
           $episode->save();

           // redirect
           $input = $episode->novel_id;
           return redirect()->route('mynovel', $input);
     }

     public function destroy($id)
      {
          // delete
          $episode = Episode::findOrFail($id);
          $episode->delete();

          // redirect
          $input = $episode->novel_id;
          return redirect()->route('mynovel', $input);
      }

      public function store(Request $request)
      {
        $request->validate([
              'ep'=>'required',
              'title'=>'required',
              'detail'=>'required',
          ]);

          $input = $request->all();

          Episode::create($input);
          return redirect()->route('mynovel', $input['novel_id']);

      }


      public function mynovelep($novel_id)
      {
        $novel = Novel::find($novel_id);
        return view('novels.addep', compact('novel'));
      }
}
