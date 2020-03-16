<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manga;
use App\MangaEpisode;
use App\PostEpisodemanga;
use Image;
use Auth;

class MangaController extends Controller
{
      public function __construct()
      {
          $this->middleware('auth');
      }

      public function edit($id)
      {
          $manga = Manga::find($id);
          return view('mangas.edit', compact('manga'));
      }

      public function update(Request $request, $id)
      {
        if($request->hasFile('mangaimage')){
          $mangaimage =  $request->file('mangaimage');
          $filename = time() . '.' . $mangaimage->getClientOriginalExtension();
          Image::make($mangaimage)->save( public_path('/uploads/mangaimage/' . $filename ) );

            $this->validate($request, [
              'title'=>'required',
              'author'=>'required',
              'resume'=>'required',
            ]);
            // store
            $manga = Manga::findOrFail($id);
            $manga->title = $request->input('title');
            $manga->mangaimage = $filename;
            $manga->author = $request->input('author');
            $manga->resume = $request->input('resume');
            $manga->save();

            // redirect
            $input = $manga->id;
            return redirect()->route('mangaDetails', $input);
          }else {
            $this->validate($request, [
              'title'=>'required',
              'author'=>'required',
              'resume'=>'required',
            ]);
            // store
            $manga = Manga::findOrFail($id);
            $manga->title = $request->input('title');
            $manga->author = $request->input('author');
            $manga->resume = $request->input('resume');
            $manga->save();

            // redirect
            $input = $manga->id;
            return redirect()->route('mangaDetails', $input);
          }
      }

      public function destroy($id)
       {
           // delete
           $manga = Manga::findOrFail($id);
           $manga->delete();

           // redirect
           return redirect()->route('mangasadmin');
       }

      public function create()
      {
          if (auth()->user()->admin == 1) {
            return view('mangas.create');
          }else {
            ;
            // $novels = Novel::all();
            return redirect()->route('home');
            // // return redirect()->route('login');
            // return redirect()->route('login');
            // // return view('login');
            // echo "string";
          }



      }

      public function store(Request $request)
      {
          if($request->hasFile('mangaimage')){
            $mangaimage =  $request->file('mangaimage');
            $filename = time() . '.' . $mangaimage->getClientOriginalExtension();
            Image::make($mangaimage)->save( public_path('/uploads/mangaimage/' . $filename ) );

            $request->validate([
                  'title'=>'required',
                  'author'=>'required',
                  'resume'=>'required',
              ]);

              $input = $request->all();
              $input['mangaimage'] = $filename;
              $input['user_id'] = auth()->user()->id;

              Manga::create($input);

              return redirect()->route('mangasadmin');
          }else {
            $request->validate([
                  'title'=>'required',
                  'author'=>'required',
                  'resume'=>'required',
              ]);
              $input = $request->all();
              $input['user_id'] = auth()->user()->id;
              Manga::create($input);
              return redirect()->route('mangasadmin');
          }
      }

      public function mangas()
      {
        $mangas = Manga::all();
        return view('mangas.index', compact('mangas'));
      }

      public function manga($id)
      {
          $manga = Manga::find($id);
          $episodes = PostEpisodemanga::all();
          return view('mangas.mangaDetails', compact('manga'), compact('episodes'));
      }

      public function readManga($id)
      {
        $episode = PostEpisodemanga::find($id);
        $images = MangaEpisode::all();
        $eplists = PostEpisodemanga::all();
        $m_id = $episode->manga_id;
        $count = 0;
        foreach($images as $image){
          if($episode->id == $image->post_episodemangas_id){
            $count++;
          }
        }
        $te = false;
        $next = 0;
        $back = 0;
        $b = 0;
        foreach($eplists as $eplist){
            if($eplist->manga_id == $m_id){
                if($te == false){
                    if ($episode->id == $eplist->id) {
                        $te = true;
                        $back = $b;
                      }else {
                        $b = $eplist->id;
                      }
                }else {
                    $next = $eplist->id;
                    $te = false;
                }
            }
        }

        // echo 'ID now: '.$episode->id.' back id :'.$back.' next id :'.$next;
        return view('mangas.read', compact('episode','images','eplists' , 'm_id','count','back','next'));
      }







}
