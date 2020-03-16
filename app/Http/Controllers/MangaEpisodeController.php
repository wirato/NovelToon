<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use App\Manga;
use App\MangaEpisode;
use App\PostEpisodemanga;
use Image;

class MangaEpisodeController extends Controller
{
    public function addMangaEp($id)
    {
      $manga = Manga::find($id);
      return view('mangas.addep', compact('manga'));
    }

    public function update(Request $request, $id)
    {
          $this->validate($request, [
            'manga_id' => 'required',
            'manga_title' => 'required',
            'ep' => 'required',
            'title' => 'required',
          ]);
          // store
          $post = PostEpisodemanga::findOrFail($id);
          $post->manga_id = $request->input('manga_id');
          $post->manga_title = $request->input('manga_title');
          $post->ep = $request->input('ep');
          $post->title = $request->input('title');
          $post->save();

          // redirect
          $input = $post->manga_id;
          return redirect()->route('mangaDetails', $input);
    }

    public function destroy($id)
     {
         // delete
         $post = PostEpisodemanga::findOrFail($id);
         $post->delete();

         // redirect
         $input = $post->manga_id;
       	return redirect()->route('mangaDetails', $input);
     }

    public function store(Request $request)
    {
        $request->validate([
          'manga_id' => 'required',
          'manga_title' => 'required',
          'ep' => 'required',
          'title' => 'required',
          'images' => 'required'
          ]);

        $post = new PostEpisodemanga();
        $post->manga_id = $request->manga_id;
        $post->manga_title = $request->manga_title;
        $post->ep = $request->ep;
      	$post->title = $request->title;

      	$post->save();

        $page = 1;

      	foreach ($request->file('images') as $image) {

          $name = time() . '_' . $image->getClientOriginalName();
          Image::make($image)->save( public_path('/uploads/mangaimage/epimage/' .$name ) );

      		$mangaEp = new MangaEpisode;

          $mangaEp->post_episodemangas_id = $post->id;
          $mangaEp->page = $page;
      		$mangaEp->image = $name;
      		$mangaEp->save();
          $page = $page+1;

      	}
        $input = $request->manga_id;
      	return redirect()->route('mangaDetails', $input);
      }

      public function mangaDetail($id)
      {
        $manga = Manga::find($id);
        $episodes = PostEpisodemanga::all();
        return view('mangaDetails', compact('manga'), compact('episodes'));
          echo "string";
      }

      public function readMangaEp($id)
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
        return view('raadManga', compact('episode','images','eplists' , 'm_id','count','back','next'));
      }

      public function mangas()
      {
        $mangas = Manga::all();
        return view('mangas', compact('mangas'));
      }

}
